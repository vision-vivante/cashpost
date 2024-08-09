<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MilestonePaymentController;
use App\Http\Controllers\PackagePaymentController;
use App\Http\Controllers\WalletController;
use App\Models\UserProfile;

use App\Models\SystemConfiguration;
use Session;
use Stripe;
use Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

use Redirect;
class StripePaymentController extends Controller
{
    /**
     * Stripe initialize method.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Session::get('payment_data'));
        return view('frontend.default.stripe.stripe');
    }

    public function create_checkout_session(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                    'currency' => \App\Models\Currency::findOrFail(\App\Models\SystemConfiguration::where('type', 'system_default_currency')->first()->value)->code,
                    'product_data' => [
                        'name' => "Payment"
                    ],
                    'unit_amount' => round($request->session()->get('payment_data')['amount'] * 100),
                    ],
                    'quantity' => 1,
                    ]
                ],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
        ]);

        return response()->json(['id' => $session->id, 'status' => 200]);
    }

    public function success(Request $request) {
        try{
            $payment = ["status" => "Success"];
            
            if (Session::get('payment_data')['payment_type'] == 'milestone_payment') {
                $milestone_payment = new MilestonePaymentController;
                return $milestone_payment->milestone_payment_done(Session::get('payment_data'), json_encode($payment));
            } 
            elseif (Session::get('payment_data')['payment_type'] == 'package_payment') {
                $package_payment = new PackagePaymentController;
                return $package_payment->package_payment_done(Session::get('payment_data'), json_encode($payment));
            }
            elseif (Session::get('payment_data')['payment_type'] == 'service_payment') {
                $package_payment = new ServicePaymentController;
                return $package_payment->service_package_payment_done(Session::get('payment_data'), json_encode($payment));
            }
            elseif (Session::get('payment_data')['payment_type'] == 'wallet_payment') {
                return (new WalletController)->wallet_payment_done(Session::get('payment_data'), json_encode($payment));
            }

        }
        catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->route('dashboard');
        }
    }

    public function cancel(Request $request){
        flash(translate('Payment is cancelled'))->error();
        return redirect()->route('dashboard');
    }
    public function delBankAccount(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiVersion('2020-08-27');

        $user = Auth::user();
        $user_profile = $user->profile;

        $user_profile->stripe_account = '';
        $user_profile->save();

        return Redirect::back();
    }
    public function StripeBankAccount(Request $request){  
        $max_date=Carbon::now()->subYears(18)->format('m-d-Y');
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiVersion('2020-08-27');
        $user = Auth::user();
        $user_profile = $user->profile;
        $account_data = array(
            'account_holder_name'=>'',
            'routing_number'=>'',
            'city'=>'',
            'state'=>'',
            'address'=>'',
            'postal_code'=>'',
            'email'=>'',
            'first_name'=>'',
            'last_name'=>'',
            'phone'=>'',
            'gender'=>'',
            'dob'=>'',
            'ssn'=>'',
        );
        if(!empty($user_profile->stripe_account)){
            $account = \Stripe\Account::retrieve($user_profile->stripe_account); 
            // dd($account);
            
            
                $account_data['account_holder_name']=$account->external_accounts->data[0]->account_holder_name;
                $account_data['routing_number']=$account->external_accounts->data[0]->routing_number;
                $account_data['city']=$account->individual->address->city;
                $account_data['address']=$account->individual->address->line1;
                $account_data['postal_code']=$account->individual->address->postal_code;
                $account_data['email']=$account->individual->email;
                $account_data['first_name']=$account->individual->first_name;
                $account_data['last_name']=$account->individual->last_name;
                $account_data['phone']=$account->individual->phone;
                $account_data['gender']=$account->individual->gender;
                $account_data['dob']=$account->individual->dob->day.'-'.$account->individual->dob->month.'-'.$account->individual->dob->year;
            
        }
        // $account_data = (object)$account_data;
        // dd($account_data);
        return view('frontend.default.user.stripe',compact('account_data','user_profile','max_date')); 
    }
    public function StripeAccount(Request $request){             
        
        $validator=  Validator::make($request->all(), [
            'account_holder_name' => ['required'],
            'account_number' => ['required'],
            'routing_number' => ['required'],
            'ssn' => ['required'],
            'city' => ["required"],
            'state' => ["required"],
            'address' => ["required"],
            'postal_code' => ['required'],
            'dob' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'phone' => ['required'],
            'front_image' => ['required'],
            'back_image' => ['required'],

        ]);
        if ($validator->fails()) {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiVersion('2020-08-27');
        $user = Auth::user();
        $user_profile = $user->profile;
        
        try {
            // first create bank token
            $bankToken = \Stripe\Token::create([
                'bank_account' => [
                    'country' => 'US',
                    'currency' => 'USD',
                    'account_holder_type' => 'individual',
                    'account_holder_name' => $request->account_holder_name,
                    'routing_number' => $request->routing_number,
                    'account_number' => $request->account_number
                ]
            ]); 
            // second create stripe account
            $stripeAccount = \Stripe\Account::create([
                "type" => "custom",
                "country" => "US",
                "email" => Auth::user()->email,   
                "business_type" => "individual",
                'business_profile'=>[
                        'url' => env('APP_URL'),
                        'mcc' => 7311,
                        'support_address' =>[
                            'city' => $request->city,
                            'state' => $request->state,
                            'line1' => $request->address,
                            'postal_code' => $request->postal_code,            
                        ],
                    ],
                "requested_capabilities" => ['card_payments', 'transfers'],
                "individual" => [
                    'address' => [
                        'city' => $request->city,
                        'state' => $request->state,
                        'line1' => $request->address,
                        'postal_code' => $request->postal_code,            
                    ],
                    'dob'=>[
                        "day" => date('d',strtotime($request->dob)),
                        "month" => date('m',strtotime($request->dob)),
                        "year" => date('Y',strtotime($request->dob))
                    ],
                    "email" => Auth::user()->email,
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "gender" => $request->gender,
                    "phone"=> $request->phone,
                    "ssn_last_4" => substr($request->ssn,-4),
                    "id_number" => $request->ssn
                ]     
            ]);
            // third link the bank account with the stripe account
            $bankAccount = \Stripe\Account::createExternalAccount(
            $stripeAccount->id,['external_account' => $bankToken->id]
            );
            
            
        
            // Fourth stripe account update for tos acceptance
            \Stripe\Account::update(
                $stripeAccount->id,[
                'tos_acceptance' => [
                    'date' => time(),
                    'ip' => $_SERVER['REMOTE_ADDR'] // Assumes you're not using a proxy
                    ],
                ]
            );
            $front_image_name = $this->front_handle_upload($request);   
            $back_image_name = $this->back_handle_upload($request);   
        
            $identity = fopen($front_image_name, 'r');
            $identity_data=\Stripe\File::create([
                    'file' => $identity,
                    'purpose' => 'identity_document',
                    ],
                    [
                    'stripe_account' =>$stripeAccount->id,
                    ]
            );
            $identity_back = fopen($back_image_name, 'r');

            $identity_back_data=\Stripe\File::create([
                    'file' => $identity_back,
                    'purpose' => 'identity_document',
                    ],
                    [
                    'stripe_account' =>$stripeAccount->id,
                    ]
            );            
            \Stripe\Account::update(
                $stripeAccount->id,
                [
                    'individual' => [
                        'verification' => [
                            'document'=>[
                                'front'=>$identity_data->id,
                                'back'=>$identity_back_data->id
                            ],
                            'additional_document' => [
                                'front'=>$identity_data->id,
                                'back'=>$identity_back_data->id
                            ],
                        ],
                    ]
                ]
            );                
            $user = Auth::user();
            $user_profile = $user->profile;
            $user_profile->stripe_account = $stripeAccount->id;
            $user_profile->save();    
            // dd($stripeAccount);
        } catch (\Exception $e) {                
            switch ($e->getError()->code) {
                case 'routing_number_invalid':
                    $validator->getMessageBag()->add('routing_number', $e->getError()->message);
                    break;
                case 'account_number_invalid':
                    $validator->getMessageBag()->add('account_number', $e->getError()->message);
                    break;  
                case 'postal_code_invalid':
                    $validator->getMessageBag()->add('postal_code', $e->getError()->message);
                    break;        
                default:
                    // $validator->getMessageBag()->add('account_number', $e->getError()->message);
                    break;
            }
            switch ($e->getError()->param) {
                case 'individual[phone]':
                    $validator->getMessageBag()->add('phone', $e->getError()->message);
                    break;  
                case 'individual[id_number]':
                    $validator->getMessageBag()->add('phone', $e->getError()->message);
                    break;  
                case 'individual[address][state]':
                    $validator->getMessageBag()->add('state', $e->getError()->message);
                    break;                        
                default:
                    dd($e);
                    // $validator->getMessageBag()->add('account_number', $e->getError()->message);
                    break;
            }
        }  
        return Redirect::back()
                ->withErrors($validator)
                ->withInput();
      
    }
    
   
    public function front_handle_upload($request){        
        if($files=$request->file('front_image')){  
            $name=$files->getClientOriginalName();  
            $files->move('public/uploads/stripe',$name);              
        }  
        return 'public/uploads/stripe/'.$name;
    }
    public function back_handle_upload($request){
        if($files=$request->file('back_image')){  
            $name=$files->getClientOriginalName();  
            $files->move('public/uploads/stripe',$name);              
        }  
        return 'public/uploads/stripe/'.$name;
    }
    public function transfer($active_project){
        $ref = $active_project->project_id.'-'.$active_project->user_id;
        $amount = $active_project->hired_at;

        $account = UserProfile::where('user_id', $active_project->user_id)->first()->stripe_account;

        // return array($ref,$amount,$account);
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Stripe::setApiVersion('2020-08-27');
            $check_balnace = \Stripe\Balance::retrieve();
            
            // echo '<pre>';
            // print_r($check_balnace);
            
            $com = get_setting('set_commission');
            $amount = $amount - (($amount*$com)/100);
        try{
            $transfer = \Stripe\Transfer::create([
                "amount" => ($amount *100),
                "currency" => "USD",
                "destination" => $account,
                "transfer_group" => $ref,
            
            ]);
            
            return json_encode(array('transfer_data'=>$transfer,'commission_fee'=>($amount*$com)/100));
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
