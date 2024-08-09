<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Role;
use App\Models\Address;
use App\Models\UserRole;
use App\Models\UserProfile;
use App\Models\UserSocialProfile;
use App\Upload;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Session;
use Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard?byresigter=0071';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
         
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if(!Auth::check()){
            return view('frontend.default.user_signup');
        }else{
            return redirect('/');
        }
    }
    public function showinfluencerRegistrationForm()
    {
        if(!Auth::check()) {
            $max_date=Carbon::now()->subYears(18)->format('m-d-Y');
            return view('frontend.default.influencer_user_sign',compact('max_date'));
        }else{
            return redirect('/');
        }
    }
    public function showinbrandRegistrationForm()
    {
        if(!Auth::check()){
            return view('frontend.default.brand_user_sign');
        }else{
            return redirect('/');
        }
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)

    {  
        if (in_array('freelancer', $data['user_types'])) {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                //'user_avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }else{
            return Validator::make($data, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'user_avatar' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'user_avatar' =>'The brand logo field is required.',
            ]
            );
        }
    }
    public function custom_validator(Request $request,$step)
    {  
        if (in_array('freelancer', $request['user_types'])){
            if($step=="1"){
                $validator=Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required','email','unique:users','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                ]);
                if ($validator->fails()) {
                   return response()->json(['success'=> $validator->errors()->all(), 'status'=> false]);
                }
            }elseif ($step==2){
                $validator= Validator::make($request->all(), [
                    'user_avatar' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'user_avatar.required' => 'Please add a profile picture',
                    'user_avatar.image' => 'The profile picture must be an image.',
                    'user_avatar.mimes' => 'The profile picture must be a file of type: jpeg, png, jpg, gif, svg.'
                ]);
                if ($validator->fails()) {
                  return response()->json(['success'=> $validator->errors()->all(), 'status'=> false]);
                }

            }
            elseif ($step==3){
                $validator= Validator::make($request->all(), [
                    'date_of_birth' => ['required', 'string', 'max:255'],
                    'gender' => ['required', 'string'],
                    'country_id' => ['required', 'string'],
                    'city_id' => ['required', 'string'],
                    'city_name' => ['required', 'string'],
                    'address' => ['required', 'string'],
                    'zipcode' => ['required'],
                ]);
                if ($validator->fails()) {
                   return response()->json(['success'=> $validator->errors()->all(), 'status'=> false]);
                }
            }
        }elseif(in_array('client', $request['user_types'])){
            if($step=="1"){
                $validator=Validator::make($request->all(), [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'email' => ['required','email','unique:users','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'], 
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                    'user_avatar' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]
                );
                if ($validator->fails()) {
                   return response()->json(['success'=> $validator->errors()->all(), 'status'=> false]);
                }
                return response()->json(['status' => true,'data'=> '']);
            }
        }
    }

    public function upload(Request $request ,$user_id){

        $type = array(
            "jpg"=>"image",
            "jpeg"=>"image",
            "png"=>"image",
            "svg"=>"image",
            "webp"=>"image",
            "gif"=>"image",
            "mp4"=>"video",
            "mpg"=>"video",
            "mpeg"=>"video",
            "webm"=>"video",
            "ogg"=>"video",
            "avi"=>"video",
            "mov"=>"video",
            "flv"=>"video",
            "swf"=>"video",
            "mkv"=>"video",
            "wmv"=>"video",
            "wma"=>"audio",
            "aac"=>"audio",
            "wav"=>"audio",
            "mp3"=>"audio",
            "zip"=>"archive",
            "rar"=>"archive",
            "7z"=>"archive",
            "doc"=>"document",
            "txt"=>"document",
            "docx"=>"document",
            "pdf"=>"document",
            "csv"=>"document",
            "xml"=>"document",
            "ods"=>"document",
            "xlr"=>"document",
            "xls"=>"document",
            "xlsx"=>"document"
        );

        if($request->hasFile('user_avatar')){
            $upload = new Upload;
            $upload->file_original_name = null;

            $arr = explode('.', $request->file('user_avatar')->getClientOriginalName());

            for($i=0; $i < count($arr)-1; $i++){
                if($i == 0){
                    $upload->file_original_name .= $arr[$i];
                }
                else{
                    $upload->file_original_name .= ".".$arr[$i];
                }
            }

            $upload->file_name = $request->file('user_avatar')->store('uploads/all');
            $upload->user_id = $user_id;
            $upload->extension = $request->file('user_avatar')->getClientOriginalExtension();
            if(isset($type[$upload->extension])){
                $upload->type = $type[$upload->extension];
            }
            else{
                $upload->type = "others";
            }
            $upload->file_size = $request->file('user_avatar')->getSize();
            $upload->save();
            return $upload->id;
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {  
        $request=request();
        $fileName='';
        if (in_array('freelancer', $data['user_types'])) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'user_name' =>Str::slug($data['name'], '-').date('Ymd-his'),
                'password' => Hash::make($data['password'])
            ]);
            $user->user_type = 'freelancer';
        }
        else if(in_array('client', $data['user_types'])) {
            $user = User::create([
                'name' => $data['first_name'].' '.$data['last_name'],
                'email' => $data['email'],
                'user_name' =>Str::slug($data['first_name'], '-').date('Ymd-his'),
                'password' => Hash::make($data['password'])
            ]);
            $user->user_type = 'client';
        }
        $user->save();
        if($user->id){
            $user->photo=$this->upload($request,$user->id);
            $user->save();
            send_email_verification_email($user->email);
            $address = new Address;
            if(in_array('freelancer', $data['user_types'])){
                $address->country_id=(isset($data['country_id'])) ?  $data['country_id'] : '';
                $address->state_id=(isset($data['city_id'])) ?  $data['city_id'] : '';
                $address->street=(isset($data['address'])) ?  $data['address'] : '';
                $address->city_name=(isset($data['city_name'])) ?  $data['city_name'] : '';
                $address->postal_code=(isset($data['zipcode'])) ?  $data['zipcode'] : '';

            }
            $user->address()->save($address);
            $user_profile = new UserProfile;
            $user_social_profiles = new UserSocialProfile;
            $user_profile->user_id = $user->id;        
            $user_profile->gender =(isset($data['gender'])) ?  $data['gender'] : '';
            $user_profile->ethnicity =(isset($data['ethnicity'])) ? $data['ethnicity']: '';
            $user_profile->nationality =(isset($data['religion'])) ? $data['religion']: '';
            $user_profile->company_name = (isset($data['company_name'])) ? $data['company_name'] : '';
            $user_profile->date_of_birth = (isset($data['date_of_birth'])) ? $data['date_of_birth'] : '';
            $user_profile->interested_category_id = (isset($data['user_cate_id'])) ? implode(',', $data['user_cate_id']) : '';

            $user_social_profiles->user_id = $user->id;                
            $user_social_profiles->facebook_url =(isset($data['facebook_url'])) ? $data['facebook_url'] : '';
            $user_social_profiles->twitter_url =(isset($data['twitter_url'])) ? $data['twitter_url'] : '';
            $user_social_profiles->google_url =(isset($data['google_url'])) ? $data['google_url'] : '';
            $user_social_profiles->linkedin_url =(isset($data['linkedin_url'])) ? $data['linkedin_url'] : '';
            $user_social_profiles->tiktok_url = (isset($data['tiktok_url'])) ? $data['tiktok_url'] : ''; 
            $user_social_profiles->youtube_url =(isset($data['youtube_url'])) ? $data['youtube_url'] : '';
            $user_social_profiles->instagram_url =(isset($data['instagram_url'])) ? $data['instagram_url'] : ''; 
            if(isset($data['facebook_url'])){
                $user_social_profiles->facebook_follower = get_facebook_follower((isset($data['facebook_follower'])) ? $data['facebook_follower'] : ''); 
            }  
            if(isset($data['twitter_url'])){                            
                $user_social_profiles->twitter_follower = get_social_follower((isset($data['twitter_follower'])) ? $data['twitter_follower'] : '');  
            }
            if(isset($data['google_url'])){              
                $user_social_profiles->google_follower = get_social_follower((isset($data['google_follower'])) ? $data['google_follower'] : '');
            }
            if(isset($data['linkedin_url'])){  
                $user_social_profiles->linkedin_follower = get_social_follower((isset($data['linkedin_follower'])) ? $data['linkedin_follower'] : ''); 
            }
            if(isset($data['tiktok_url'])){
                $user_social_profiles->tiktok_follower = get_social_follower((isset($data['tiktok_follower'])) ? $data['tiktok_follower'] : ''); 
            }
            if(isset($data['youtube_url'])){
                $user_social_profiles->youtube_follower = get_social_follower((isset($data['youtube_follower'])) ? $data['youtube_follower'] : ''); 
            }
            if(isset($data['instagram_url'])){
                $user_social_profiles->instagram_follower = get_social_follower((isset($data['instagram_follower'])) ? $data['instagram_follower'] : ''); 
            }               
            $user_profile->save();
            $user_social_profiles->save();  
        }            
        return $user;
    }

}
