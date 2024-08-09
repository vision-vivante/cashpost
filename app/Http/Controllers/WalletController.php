<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WalletEscrow;
use App\Models\ProjectUser;
use Auth;
use session;
use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show wallet history'])->only('admin_index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->Project_wallet_transactions();
        //$wallets_escrow = '';
        if(isClient()){
            $wallets = WalletEscrow::join('projects', 'wallet_escrows.project_id', '=', 'projects.id')->select('wallet_escrows.*','projects.client_user_id','projects.name')->where('projects.client_user_id',Auth::user()->id)->paginate(10);
            // $wallets = Wallet::where('user_id', Auth::user()->id)->latest()->paginate(10);
        }elseif (isFreelancer()) {
            $wallets = WalletEscrow::join('projects', 'wallet_escrows.project_id', '=', 'projects.id')->select('wallet_escrows.*','projects.client_user_id','projects.name')->where('wallet_escrows.receiver_id',Auth::user()->id)->where('wallet_escrows.send_to_user','!=',null)->paginate(10);
        }
        return view('frontend.default.user.wallet.index', compact('wallets'));
    }

    public function admin_index()
    {
        $wallets = Wallet::latest()->paginate(10);
        return view('admin.default.wallet_recharge_history.index', compact('wallets'));
    }
    

    public function rechage(Request $request)
    {
        $data['amount'] = round($request->amount);
        $data['amount'] = $data['amount'] + round($request->service_fee);
        $data['payment_method'] = $request->payment_option;
        $data['payment_type'] = 'wallet_payment';
        $data['prev_url'] = url()->previous();
        $data['commission_fee'] = round($request->service_fee);
        
        $request->session()->put('payment_data', $data);
        
        if($request->payment_option == 'paypal'){
            $paypal = new PayPalController;
            return $paypal->getCheckout();
        }
        elseif ($request->payment_option == 'stripe') {
            $stripe = new StripePaymentController;
            return $stripe->index();
        }
        elseif ($request->payment_option == 'sslcommerz') {
            $sslcommerz = new PublicSslCommerzPaymentController;
            return $sslcommerz->index($request);
        }
        elseif ($request->payment_option == 'paystack') {
            $paystack = new PaystackController;
            return $paystack->redirectToGateway($request);
        }
        elseif ($request->payment_option == 'instamojo') {
            $instamojo = new InstamojoController;
            return $instamojo->pay($request);
        }
        elseif ($request->payment_option == 'paytm') {
            $paytm = new PaytmController;
            return $paytm->index();
        }
    }

    public function wallet_payment_done($payment_data, $payment_details)
    {
        $user = Auth::user();
        $user_profile = $user->profile;
        $user_profile->balance = ($user_profile->balance + $payment_data['amount']) - $payment_data['commission_fee'];
        $user_profile->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $payment_data['amount'];
        $wallet->payment_method = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->type = "Recharge";
        $wallet->commission_fee = $payment_data['commission_fee'];
        $wallet->save();
        $prev_url = Session::get('payment_data')['prev_url'];
        Session::forget('payment_data');
        Session::forget('payment_type');

        flash(translate('Payment completed'))->success();
        return redirect($prev_url);
    }

}
