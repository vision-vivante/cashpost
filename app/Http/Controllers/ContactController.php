<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Page;
use Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        //
    }
    public function contactPost(Request $request){
        $admin_email=get_setting('admin_email');
        $validator= Validator::make($request->all(), [
            'first_name' =>['required', 'string', 'max:255'],
            'last_name' =>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return redirect('contact-us')
                        ->withErrors($validator)
                        ->withInput();
        }

       
        Mail::send('emails/contact_email', [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'subject' => 'Your Website Contact Form',
            'email' => $request->get('email'), 
            'phone_number' => $request->get('phone_number'),
            'company_name' => $request->get('company_name'),
            'help' => $request->get('help'),
            'user_message' => $request->get('message'),
        ],
        function ($message) use ($request) {
            $message->from($request->get('email'));
            //$message->to('manojvisionvivante@gmail.com');
            $message->to(get_setting('admin_email'));
            $message->subject('User Enquiry');
        });
        return back()->with('success', 'Thanks for contacting us. We will get back to you soon.');
    }

    public function test_mail_send(){
        $request['email']="lalitvisionvivante@gmail.com";
        Mail::send('emails/test_email', [
            'first_name' => 'lalit',
            'last_name' => 'lalit',
            'subject' => 'Your Website Contact Form',
            'email' => 'surajbansalvision@gmail.com', 
        ],
        function ($message) use ($request) {
            $message->from('surajbansalvision@gmail.com');
            $message->to('surajbansalvision@gmail.com');
            $message->subject('Bigsaver');
        });
    }
}
