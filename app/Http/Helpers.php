<?php
use App\User;
use App\Models\Currency;
use App\Models\SystemConfiguration;
use App\Models\Role;
use App\Mail\EmailManager;
use App\Models\ChatThread;
use App\Models\Translation;
use App\Models\Project;
use App\Models\ProjectBid;
use App\Models\ProjectUser;
use App\Models\HireInvitation;
use App\Models\UserSocialProfile;
use App\Models\WalletEscrow;
use App\Models\UserProfile;
use App\Models\City;
use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;

if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

function saveJSONFile($code, $data)
{
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
}

function openJSONFile($code)
{
    $jsonString = [];
    if (File::exists(base_path('resources/lang/' . $code . '.json'))) {
        $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}


//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        if (SystemConfiguration::where('type', 'symbol_format')->first()->value == 1) {
            return currency_symbol() . number_format($price, SystemConfiguration::where('type', 'no_of_decimals')->first()->value);
        }
        return number_format($price, SystemConfiguration::where('type', 'no_of_decimals')->first()->value) . currency_symbol();
    }
}

//formats price to home default price with convertion
if (!function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}

//converts currency to home default currency
if (!function_exists('convert_price')) {
    function convert_price($price)
    {
        $business_settings = SystemConfiguration::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        $price = floatval($price) * floatval($currency->exchange_rate);
        return $price;
    }
}

if (!function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $code = Currency::findOrFail(SystemConfiguration::where('type', 'system_default_currency')->first()->value)->code;
        $currency = Currency::where('code', $code)->first();
        return $currency->symbol;
    }
}

function currency_code(){
    $code = Currency::findOrFail(SystemConfiguration::where('type', 'system_default_currency')->first()->value)->code;
    return $code;
}

function formatBytes($bytes)
{
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);


    return round($bytes) . ' ' . $units[$pow];
}

if (!function_exists('formatRating')) {
    function formatRating($avg)
    {
        if ($avg == null) {
            return number_format(0, 2);
        }
        return number_format($avg, 2);
    }
}

if (!function_exists('renderStarRating')) {
    function renderStarRating($rating, $maxRating = 5)
    {
        $fullStar = "<i class='las la-star active'></i>";
        $halfStar = "<i class='las la-star half'></i>";
        $emptyStar = "<i class = 'las la-star'></i>";
        $rating = $rating <= $maxRating ? $rating : $maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating) - $fullStarCount;
        $emptyStarCount = $maxRating - $fullStarCount - $halfStarCount;

        $html = str_repeat($fullStar, $fullStarCount);
        $html .= str_repeat($halfStar, $halfStarCount);
        $html .= str_repeat($emptyStar, $emptyStarCount);
        echo $html;
    }
}

if (!function_exists('getAverageRating')) {
    function getAverageRating($id)
    {
        try {
            return \App\Models\UserProfile::where('user_id', $id)->first()->rating;
        } catch (\Exception $e) {
            return 0;
        }
    }
}

if (!function_exists('getNumberOfReview')) {
    function getNumberOfReview($id)
    {
        return count(\App\Models\Review::where('published', 1)->where('reviewed_user_id', $id)->get());
    }
}

if (!function_exists('getUserRole')) {
    function getUserRole()
    {
        try {
            return auth()->user()->user_type;
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('isClient')) {
    function isClient()
    {
        return getUserRole() == "client" ? 1 : 0;
    }
}

if (!function_exists('isFreelancer')) {
    function isFreelancer()
    {
        return getUserRole() == "freelancer" ? 1 : 0;
    }
}

function translate($key, $lang = null){
    if($lang == null){
        $lang = App::getLocale();
    }

    $translation_def = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->where('lang_key', $key)->first();
    if($translation_def == null){
        $translation_def = new Translation;
        $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
        $translation_def->lang_key = $key;
        $translation_def->lang_value = $key;
        $translation_def->save();
    }

    //Check for session lang
    $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
    if($translation_locale != null){
        return $translation_locale->lang_value;
    }
    else {
        return $translation_def->lang_value;
    }
}
function getUserSocialService($id){
    $UserSocial =\App\Models\UserSocialProfile::Where('user_id',$id)->get();
    return $UserSocial;  
}
function getUserProfile($id){
    $UserProfile =\App\Models\UserProfile::Where('user_id',$id)->first();  
    return  $UserProfile;
}
function getAllCampaign(){
    $data = array();
    if(isClient()){
        $data['bids'] = ProjectBid::join('projects', 'project_bids.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('status',0)->count();
        $data['inprogress'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed',null)->count();

        $data['completed'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count();
    }elseif(isFreelancer()){
        $data['invitations'] = HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status','!=','accepted')->count();
        $data['inprogress'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed',null)->count();
        $data['completed'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count(); 
    }
    return $data;
}
function getCompletedProjectsByFreelancer($id)
{
    return DB::table('projects')
        ->join('project_users', 'projects.id', '=', 'project_users.project_id')
        ->where('project_users.user_id', $id)
        ->where('projects.closed', 1)
        ->select('projects.id')
        ->distinct();
}
function getCancelledProjectsByFreelancer($project_id){
    $cancelled= DB::table('projects')
        ->orderBy('projects.created_at', 'desc')
        ->join('project_users', 'projects.id', '=', 'project_users.project_id')
        ->where('projects.id', $project_id)
        ->where('projects.cancel_status', 1)
        ->where('project_users.user_id', Auth::user()->id)
        ->select('projects.id')
        ->distinct();                      
    return  $cancelled->count();
}

function getInvitationProject($id){
    $invitation_projects=array();
    $projectids = DB::table('hire_invitations')
                ->where('sent_to_user_id',$id)
                ->where('status','pending')->pluck('project_id');
    if(!$projectids->isEmpty()){
        $invitation_projects=DB::table('projects')
            ->where('projects.id', $projectids)
            ->latest()
            ->take(10)
            ->get();
    }
    return $invitation_projects;
}
function getInvitationCount(){
    $invitation_projects=0;
    $projectids = DB::table('hire_invitations')
                ->where('sent_to_user_id',Auth::user()->id)
                ->where('status','pending')->pluck('project_id');
    if(!$projectids->isEmpty()){
        $invitation_projects=DB::table('projects')
            ->where('projects.id', $projectids)->get();
        $invitation_projects=$invitation_projects->count();
    }
    return $invitation_projects;

}
function getInvitationforProjectCount($project_id){
    $invitation_project_count=0;
    $invitation_project_count = DB::table('hire_invitations');
    if(isClient()){
        $invitation_project_count->where('sent_by_user_id',Auth::user()->id);
    }elseif(isFreelancer()){
        $invitation_project_count->where('sent_to_user_id',Auth::user()->id);
    }
    $invitation_project_count->where('project_id',$project_id);
    $invitation_project_count->where('status','pending');
    $invitation_project_count=$invitation_project_count->count();
    return $invitation_project_count;
}
//return file path with public
if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

//return file uploaded via uploader
if (!function_exists('custom_asset')) {
    function custom_asset($id)
    {
        if (\App\Upload::find($id) != null) {
            return my_asset(\App\Upload::find($id)->file_name);
        }
        return null;
    }
}

function ProjectCategory($id){
    $data=\App\Models\ProjectCategory::find($id);
    return $data;
}
function user_profile_pic($id){
    $profile_pic='';
    $data =\App\User::find($id);
    if($data !=null){
        $profile_pic=$data->photo;
    }
    return $profile_pic;
}

if (!function_exists('system_email')) {
    function system_email()
    {
        return \App\User::first()->email;
    }
}

if (!function_exists('get_email_by_user_id')) {
    function get_email_by_user_id($id)
    {
        $email = "";
        $user = \App\User::find($id);
        if ($user != null) {
            $email = $user->email;
        }
        return $email;
    }
}
if (!function_exists('get_userdata')) {
    function get_userdata($id)
    {
        $user= "";
        $user = \App\User::withTrashed()->find($id);
        if ($user!= null) {
            return $user;
        }
        return '';
    }
}
/*Wallet payment type*/
function admin_transaction_type($payment){
    $type='';
    if(isset($payment->payment_method)){
        $type="Wallet-recharge";
    }else{
        if($payment->send_to_user !=null){
           $send_to_user=get_userdata($payment->send_to_user);
            if(isset($send_to_user->user_type) && $send_to_user->user_type=="client"){
                $type="Refunded";
            }else{
                $type="Transferred";
            }
        }else{
            $type="Wallet-escrows";
        }
    }
    return $type;
}

if (!function_exists('email_footer_text')) {
    function email_footer_text()
    {
        return env('APP_NAME')." © 2022 All rights reserved";
    }
}

/*Logo  email  */
if (!function_exists('email_logo')) {
    function email_logo($args='')
    {
        if(empty($args)){
            return custom_asset(App\Models\SystemConfiguration::where('type', 'header_logo')->first()->value);
        }else{
            return custom_asset(App\Models\SystemConfiguration::where('type', 'other_header_logo')->first()->value);
        }
    }
}

if (!function_exists('send_email_verification_email')) {
    function send_email_verification_email($email='')
    {
        if(!empty($email)){
            $user=User::where('email', $email)->first();
        }else{
            $user = Auth::user();
        }
        $user->verification_code = encrypt($user->id);
        $user->save();

        $array['view'] = 'emails.verification';
        $array['logo'] = email_logo('other');
        $array['subject'] = translate('CashPost - Account Verification');
        $array['from'] = env('MAIL_USERNAME');
        $array['name'] = $user->name;
        //$array['content'] = 'Please click the button below to verify your email address.';
        $array['link'] = route('email.verification.confirmation', $user->verification_code);
        try {
            Mail::to($user->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        flash('Verification email has been sent. Please check your email.')->success();
        return back();
    }
}
function welcome_email($user){
    $array['view'] = 'emails.welcome_email';
    $array['subject'] = translate('Welcome Email');
    $array['from'] = env('MAIL_USERNAME');
    $array['content'] = 'we’re glad you’re here! Following are your account details.';
    $array['name'] = $user->name;
    $array['username'] = $user->user_name;
    $array['email'] = $user->email;
    try {
        Mail::to($user->email)->queue(new EmailManager($array));
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}
function timezones(){
    $timezones = Array(
        '(GMT-12:00) International Date Line West' => 'Pacific/Kwajalein',
        '(GMT-11:00) Midway Island' => 'Pacific/Midway',
        '(GMT-11:00) Samoa' => 'Pacific/Apia',
        '(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
        '(GMT-09:00) Alaska' => 'America/Anchorage',
        '(GMT-08:00) Pacific Time (US & Canada)' => 'America/Los_Angeles',
        '(GMT-08:00) Tijuana' => 'America/Tijuana',
        '(GMT-07:00) Arizona' => 'America/Phoenix',
        '(GMT-07:00) Mountain Time (US & Canada)' => 'America/Denver',
        '(GMT-07:00) Chihuahua' => 'America/Chihuahua',
        '(GMT-07:00) La Paz' => 'America/Chihuahua',
        '(GMT-07:00) Mazatlan' => 'America/Mazatlan',
        '(GMT-06:00) Central Time (US & Canada)' => 'America/Chicago',
        '(GMT-06:00) Central America' => 'America/Managua',
        '(GMT-06:00) Guadalajara' => 'America/Mexico_City',
        '(GMT-06:00) Mexico City' => 'America/Mexico_City',
        '(GMT-06:00) Monterrey' => 'America/Monterrey',
        '(GMT-06:00) Saskatchewan' => 'America/Regina',
        '(GMT-05:00) Eastern Time (US & Canada)' => 'America/New_York',
        '(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
        '(GMT-05:00) Bogota' => 'America/Bogota',
        '(GMT-05:00) Lima' => 'America/Lima',
        '(GMT-05:00) Quito' => 'America/Bogota',
        '(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
        '(GMT-04:00) Caracas' => 'America/Caracas',
        '(GMT-04:00) La Paz' => 'America/La_Paz',
        '(GMT-04:00) Santiago' => 'America/Santiago',
        '(GMT-03:30) Newfoundland' => 'America/St_Johns',
        '(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
        '(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
        '(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
        '(GMT-03:00) Greenland' => 'America/Godthab',
        '(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
        '(GMT-01:00) Azores' => 'Atlantic/Azores',
        '(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
        '(GMT) Casablanca' => 'Africa/Casablanca',
        '(GMT) Dublin' => 'Europe/London',
        '(GMT) Edinburgh' => 'Europe/London',
        '(GMT) Lisbon' => 'Europe/Lisbon',
        '(GMT) London' => 'Europe/London',
        '(GMT) UTC' => 'UTC',
        '(GMT) Monrovia' => 'Africa/Monrovia',
        '(GMT+01:00) Amsterdam' => 'Europe/Amsterdam',
        '(GMT+01:00) Belgrade' => 'Europe/Belgrade',
        '(GMT+01:00) Berlin' => 'Europe/Berlin',
        '(GMT+01:00) Bern' => 'Europe/Berlin',
        '(GMT+01:00) Bratislava' => 'Europe/Bratislava',
        '(GMT+01:00) Brussels' => 'Europe/Brussels',
        '(GMT+01:00) Budapest' => 'Europe/Budapest',
        '(GMT+01:00) Copenhagen' => 'Europe/Copenhagen',
        '(GMT+01:00) Ljubljana' => 'Europe/Ljubljana',
        '(GMT+01:00) Madrid' => 'Europe/Madrid',
        '(GMT+01:00) Paris' => 'Europe/Paris',
        '(GMT+01:00) Prague' => 'Europe/Prague',
        '(GMT+01:00) Rome' => 'Europe/Rome',
        '(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
        '(GMT+01:00) Skopje' => 'Europe/Skopje',
        '(GMT+01:00) Stockholm' => 'Europe/Stockholm',
        '(GMT+01:00) Vienna' => 'Europe/Vienna',
        '(GMT+01:00) Warsaw' => 'Europe/Warsaw',
        '(GMT+01:00) West Central Africa' => 'Africa/Lagos',
        '(GMT+01:00) Zagreb' => 'Europe/Zagreb',
        '(GMT+02:00) Athens' => 'Europe/Athens',
        '(GMT+02:00) Bucharest' => 'Europe/Bucharest',
        '(GMT+02:00) Cairo' => 'Africa/Cairo',
        '(GMT+02:00) Harare' => 'Africa/Harare',
        '(GMT+02:00) Helsinki' => 'Europe/Helsinki',
        '(GMT+02:00) Istanbul' => 'Europe/Istanbul',
        '(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
        '(GMT+02:00) Kyev' => 'Europe/Kiev',
        '(GMT+02:00) Minsk' => 'Europe/Minsk',
        '(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
        '(GMT+02:00) Riga' => 'Europe/Riga',
        '(GMT+02:00) Sofia' => 'Europe/Sofia',
        '(GMT+02:00) Tallinn' => 'Europe/Tallinn',
        '(GMT+02:00) Vilnius' => 'Europe/Vilnius',
        '(GMT+03:00) Baghdad' => 'Asia/Baghdad',
        '(GMT+03:00) Kuwait' => 'Asia/Kuwait',
        '(GMT+03:00) Moscow' => 'Europe/Moscow',
        '(GMT+03:00) Nairobi' => 'Africa/Nairobi',
        '(GMT+03:00) Riyadh' => 'Asia/Riyadh',
        '(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
        '(GMT+03:00) Volgograd' => 'Europe/Volgograd',
        '(GMT+03:30) Tehran' => 'Asia/Tehran',
        '(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
        '(GMT+04:00) Baku' => 'Asia/Baku',
        '(GMT+04:00) Muscat' => 'Asia/Muscat',
        '(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
        '(GMT+04:00) Yerevan' => 'Asia/Yerevan',
        '(GMT+04:30) Kabul' => 'Asia/Kabul',
        '(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
        '(GMT+05:00) Islamabad' => 'Asia/Karachi',
        '(GMT+05:00) Karachi' => 'Asia/Karachi',
        '(GMT+05:00) Tashkent' => 'Asia/Tashkent',
        '(GMT+05:30) Chennai' => 'Asia/Kolkata',
        '(GMT+05:30) Kolkata' => 'Asia/Kolkata',
        '(GMT+05:30) Mumbai' => 'Asia/Kolkata',
        '(GMT+05:30) New Delhi' => 'Asia/Kolkata',
        '(GMT+05:45) Kathmandu' => 'Asia/Kathmandu',
        '(GMT+06:00) Almaty' => 'Asia/Almaty',
        '(GMT+06:00) Astana' => 'Asia/Dhaka',
        '(GMT+06:00) Dhaka' => 'Asia/Dhaka',
        '(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
        '(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
        '(GMT+06:30) Rangoon' => 'Asia/Rangoon',
        '(GMT+07:00) Bangkok' => 'Asia/Bangkok',
        '(GMT+07:00) Hanoi' => 'Asia/Bangkok',
        '(GMT+07:00) Jakarta' => 'Asia/Jakarta',
        '(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
        '(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
        '(GMT+08:00) Chongqing' => 'Asia/Chongqing',
        '(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
        '(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
        '(GMT+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
        '(GMT+08:00) Perth' => 'Australia/Perth',
        '(GMT+08:00) Singapore' => 'Asia/Singapore',
        '(GMT+08:00) Taipei' => 'Asia/Taipei',
        '(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
        '(GMT+08:00) Urumqi' => 'Asia/Urumqi',
        '(GMT+09:00) Osaka' => 'Asia/Tokyo',
        '(GMT+09:00) Sapporo' => 'Asia/Tokyo',
        '(GMT+09:00) Seoul' => 'Asia/Seoul',
        '(GMT+09:00) Tokyo' => 'Asia/Tokyo',
        '(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
        '(GMT+09:30) Adelaide' => 'Australia/Adelaide',
        '(GMT+09:30) Darwin' => 'Australia/Darwin',
        '(GMT+10:00) Brisbane' => 'Australia/Brisbane',
        '(GMT+10:00) Canberra' => 'Australia/Sydney',
        '(GMT+10:00) Guam' => 'Pacific/Guam',
        '(GMT+10:00) Hobart' => 'Australia/Hobart',
        '(GMT+10:00) Melbourne' => 'Australia/Melbourne',
        '(GMT+10:00) Port Moresby' => 'Pacific/Port_Moresby',
        '(GMT+10:00) Sydney' => 'Australia/Sydney',
        '(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
        '(GMT+11:00) Magadan' => 'Asia/Magadan',
        '(GMT+11:00) New Caledonia' => 'Asia/Magadan',
        '(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
        '(GMT+12:00) Auckland' => 'Pacific/Auckland',
        '(GMT+12:00) Fiji' => 'Pacific/Fiji',
        '(GMT+12:00) Kamchatka' => 'Asia/Kamchatka',
        '(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
        '(GMT+12:00) Wellington' => 'Pacific/Auckland',
        '(GMT+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
    );

    return $timezones;
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
    }
}

if (!function_exists('chat_threads')) {
    function chat_threads()
    {
        $data  = array();
        if (Auth::check()) {
            foreach (ChatThread::where('sender_user_id', Auth::user()->id)->orWhere('receiver_user_id', Auth::user()->id)->get() as $key => $chat_thread) {
                if(count($chat_thread->chats()->where('sender_user_id', '!=', Auth::user()->id)->where('seen', 0)->get()) > 0){
                    $data[] = $chat_thread->id;
                }
            }
        }

        return $data;
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = "")
    {
        $setting =  \App\Utility\SettingsUtility::get_settings_value($key) ;
        return $setting == "" ? $default : $setting;
    }
}

function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
          return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb = array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}
function get_brand_name($id){
    $brand_name =\App\Models\UserProfile::Where('user_id',$id)->first();
    if(!empty($brand_name)){
        return isset($brand_name->company_name) ? $brand_name->company_name : '';
    }
}
function getInviteUser($id){
    $getInviteUser =\App\User::where('id',$id)->first();
    
    return isset($getInviteUser->name) ? $getInviteUser->name : '';
}
function getProcessProject($project,$user_id=''){
    if(isClient()){
        $project_id=$project->id;
        $cancel_status=$project->cancel_status;
        $close_status=$project->closed;
        if($close_status==0 && \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id',$user_id)->where('closed',null)->where('incomplete',null)->first() != null){
            return  true;
        }
        return null;
    
    }elseif(isFreelancer()){
        $close_status=$project->closed;
        $ProjectUser=\App\Models\ProjectUser::where('project_id', $project->id)->where('user_id', Auth::user()->id)->where('closed',null)->where('incomplete',null)->first();
        if($ProjectUser!=null){
            return true;
        }
        return null;
    }else{
        $close_status=$project->closed;
        $ProjectUser=\App\Models\ProjectUser::where('project_id', $project->id)->where('user_id', $user_id)->where('closed',null)->where('incomplete',null)->first();
        if($ProjectUser!=null){
            return true;
        }
        return null;
    }
  
}
function getCompletedProjects($project,$user_id=0)
{
    if(isClient()){
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id', $user_id)->where('closed','!=',null)->where('incomplete',null)->first() != null){
            return  true;
        }
        return null;
    }elseif(isFreelancer()){
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id',Auth::user()->id)->where('closed','!=',null)->where('incomplete',null)->first() != null){
            return  true;
        }
        return null;    

    }else{
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id',$user_id)->where('closed','!=',null)->where('incomplete',null)->first() != null){
            return  true;
        }
        return null;
    }
}
function getmarkincomplete($project,$user_id=0){
    if(isClient()){
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id', $user_id)->where('closed','!=',null)->where('incomplete','!=',null)->first() != null){
            return  true;
        }
        return null;
    }elseif(isFreelancer()){
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id',Auth::user()->id)->where('closed','!=',null)->where('incomplete','!=',null)->first() != null){
            return  true;
        }
        return null;    
    }else{
        $project_id=$project->id;
        $closed_status=$project->closed;
        $project_user= \App\Models\ProjectUser::where('project_id', $project->id);
        if($closed_status==1 || \App\Models\ProjectUser::where('project_id', $project->id)->where('user_id',$user_id)->where('closed','!=',null)->where('incomplete','!=',null)->first() != null){
            return  true;
        }
        return null;  
    }
}
function getProjectInvite($project){
    if(isClient()){
        $HireInvitation= \App\Models\HireInvitation::where('sent_by_user_id', Auth::user()->id)->where('status', '=','pending')->where('project_id',$project->id)->get();
        if($HireInvitation){
            return '<span class="applied-text"">Created</span>';
        }

    }elseif(isFreelancer()){
        $bid=\App\Models\ProjectBid::where('project_id', $project->id)->first();
         if($bid){
            return '<span class="applied-text"">Applied</span>';
        }
        $HireInvitation= \App\Models\HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status', '=','pending')->where('project_id',$project->id)->get();
        if($HireInvitation){
            return '<span class="invited-text">Invited</span>';
        }
    }
}
function get_all_projects($project,$user_id=''){
    if(getmarkincomplete($project,$user_id) != null){
        return '<span class="in-completed">Incomplete</span>';
    }else if(getCompletedProjects($project,$user_id) != null){
        return '<span class="completed-text">Completed</span>';
    }else if(getProcessProject($project,$user_id)!= null){
       return '<span class="progress-text"">In-progress</span>';
    }else{
        return getProjectInvite($project);
    }
}
function get_facebook_follower($value=''){
    if($value==1){
        return "1-100";
    }else if($value==2){
        return "100-2500";
    }else if($value==3){
        return "2500-50000";
    }else{
        return '';
    }
}
function user_age($dateOfBirth=''){
    $years='';
    if($dateOfBirth){
        $dateOfBirth=str_replace('-','/',$dateOfBirth);
        $dateOfBirth = date("Y-m-d", strtotime($dateOfBirth));
        $years=\Carbon\Carbon::parse($dateOfBirth)->diff(\Carbon\Carbon::now())->format('%y years old');
    }
    return $years;
}
function get_social_follower($value=''){
    if($value==1){
        return "1-100";
    }else if($value==2){
        return "100-2500";
    }else if($value==3){
        return "2500-10k";
    }else if($value==4){
        return "10k+";
    }else{
        return '';
    }
}

function get_provide_service($user_interest_ids,$seleted_tags){
    $inner_data='';
    if($user_interest_ids){
        if($seleted_tags=='span'){
            $tag='<span class="green-type-btn">';
            $tagclose='</span>';
        }elseif($seleted_tags=='div'){
            $tag='<div class="skin-detail"><span>';
            $tagclose='</span></div>';
        }else{
            $tag='<li>';
            $tagclose='</li>';
        }
        $user_interest_ids=explode(',', $user_interest_ids);
        foreach($user_interest_ids as $key => $interest_id){
            if($interest_id==1){
                $inner_data.=$tag.'Funny Videos'.$tagclose;
            }if($interest_id==2){
                $inner_data.=$tag.'Memes'.$tagclose;
            }if($interest_id==3){
                $inner_data.=$tag.'Youtube'.$tagclose;
            }if($interest_id==4){
                $inner_data.=$tag.'Netflix'.$tagclose;
            }if($interest_id==5){
                $inner_data.=$tag.'Gaming'.$tagclose;
            }if($interest_id==6){
                $inner_data.=$tag.'Beauty'.$tagclose;
            }if($interest_id==7){
                $inner_data.=$tag.'Sports'.$tagclose;
            }if($interest_id==8){
                $inner_data.=$tag.'College'.$tagclose;
            }if($interest_id==9){
                $inner_data.=$tag.'Technology'.$tagclose;
            }if($interest_id==10){
                $inner_data.=$tag.'Beer/Alcohol'.$tagclose;
            }if($interest_id==11){
                $inner_data.=$tag.'Healthcare'.$tagclose;
            }if($interest_id==12){
                $inner_data.=$tag.'Rap Music'.$tagclose;
            }if($interest_id==13){
                $inner_data.=$tag.'Pop Music'.$tagclose;
            }if($interest_id==14){
                $inner_data.=$tag.'Rock Music'.$tagclose;
            }if($interest_id==15){
                $inner_data.=$tag.'Country Music'.$tagclose;
            }
        }
    }
    return $inner_data;
}
function ProjectGetBids($slug){
    $project = Project::where('slug', $slug)->first();
    $bid_users = DB::table('projects');
    $bid_users->join('project_bids','projects.id', 'project_bids.project_id');
    if($project!=null){
        $bid_users->where('projects.id', $project->id);
        $bid_users->where('project_bids.project_id', $project->id);
    }
    $bid_users->where('projects.closed', 0);
    $bid_users->where('project_bids.status', 0);
    $bid_users=$bid_users->get();
    return $bid_users->count();
}
function ProjectGetHired($slug){
    $project = Project::where('slug', $slug)->withTrashed()->first();
    $project_hired = Project::withTrashed()->where('id', $project->id)->where('client_user_id',Auth::user()->id)->open()->latest()->first();
    if(!empty($project_hired)){
        if(isset($project_hired->project_user)){
            return count($project_hired->project_user);
        }
    }
    return 0;
}

/*Interested Social Platform */
function ProjectInterestedSocial($freelancer_id=''){
    if($freelancer_id){
       $user_id=$freelancer_id;
    }else{
        $user_id=Auth::user()->id;
    }
    $category_ids=array();
    $SocialProfile=UserSocialProfile::where('user_id',$user_id)->first();
    if($SocialProfile){
        if($SocialProfile->facebook_url!=null && !empty($SocialProfile->facebook_url)){
            $category_ids[]=1;
        }
        if($SocialProfile->instagram_url!=null && !empty($SocialProfile->instagram_url)){
            $category_ids[]=2;
        }
        if($SocialProfile->tiktok_url!=null && !empty($SocialProfile->tiktok_url)){
            $category_ids[]=3;
        }
        if($SocialProfile->twitter_url!=null && !empty($SocialProfile->twitter_url) ){
            $category_ids[]=4;
        } 
        if($SocialProfile->youtube_url!=null && !empty($SocialProfile->youtube_url)){
            $category_ids[]=5;
        }
    }
    return $category_ids;
}

/*escrows Wallet ammount*/
function wallet_escrows_transfer($project_id,$receiver_id,$transfer_user_id,$commission_fee=''){
    $WalletEscrow=WalletEscrow::where('project_id',$project_id)->where('receiver_id',$receiver_id)->where('send_to_user',null)->first();
    if($WalletEscrow){
        $amount=$WalletEscrow->amount;
        $userprofile=UserProfile::where('user_id',$transfer_user_id)->first();
        $userprofile->balance += $amount;
        $userprofile->save();
        if(empty($commission_fee)){
            $commission_fee=0;
        }
        EmailUtility::send_email(
            "Amount transfer influencer account",
            "Amount has been transfer by". Auth::user()->name,
            get_email_by_user_id($transfer_user_id),
        );
        WalletEscrow::where('project_id',$project_id)->where('receiver_id',$receiver_id)->update(['send_to_user'=>$transfer_user_id,'commission_fee'=>$commission_fee]);
        return  back();
    }
}
function payment_status($id=''){
    if($id){
        $user=User::findOrFail($id);
        // $user=User::withTrashed('id',$id)->first();
        if($user->user_type=='client'){
            return "Refunded";
        }elseif($user->user_type=='freelancer'){
            return "Transferred";
        }
    }else{
         return "Escrow";
    }
}
function get_submitted_disbute($project_id,$receiver_user_id){
    return ProjectUser::where('project_id',$project_id)->where('user_id',$receiver_user_id)->first();
}
function get_admin_all_project($project_id){
    $projects= ProjectUser::where('project_users.project_id', $project_id)->select('project_users.*')->get();
    return $projects;
}
function get_bid_data($project_id,$bid_by_user_id){
    $projectbid=ProjectBid::where('project_id', $project_id)->where('bid_by_user_id',$bid_by_user_id)->first();
    if($projectbid){
        return $projectbid;
    }
    return '';
}
function get_admin_chat_threads($sender_user_id,$receiver_user_id,$project_id){
    if($sender_user_id && $receiver_user_id && $project_id){
        $chat_threads= ChatThread::where('project_id',$project_id)->where('sender_user_id',$sender_user_id)->where('receiver_user_id', $receiver_user_id)->first();
        if($chat_threads){
            return $chat_threads->id;
        }
    }
}
function get_all_campaign_actions($project_user){
    $project_id=$project_user->project_id ? $project_user->project_id : '';
    $user_details=get_userdata($project_user->user_id);
    $name=(isset($user_details->name)) ? $user_details->name : '';
    $project=Project::find($project_id);
    if($project->closed==1){
        $status="<span class='completed-text'>Closed</span>";
    }else{
        $project_status=get_submitted_disbute($project->id,$project_user->user_id);
        if(empty($project_status->closed) && empty($project_status->dispute) &&  empty($project_status->disputed) && empty($project_status->submitted)){
          $status="<span class='in-progress'>In-progress</span>";
        }elseif(empty($project_status->closed) && empty($project_status->incomplete) &&  empty($project_status->disputed) && empty($project_status->submitted)){
           $status="<span class='in-progress'>In-progress</span>";
        }
        elseif(!empty($project_status->submitted) && empty($project_status->closed) && empty($project_status->incomplete) && empty($project_status->disputed)){
          $status="<span class='in-submitted'>Submitted</span>";
        }
        elseif(empty($project_status->closed) && !empty($project_status->incomplete) &&  empty($project_status->disputed) && empty($project_status->submitted)){
          $status="<span class='in-completed'>In-Completed</span>";
        }
        elseif(empty($project_status->closed) && empty($project_status->incomplete) &&  !empty($project_status->disputed) && !empty($project_status->submitted) && empty($project_status->resolved) &&  empty($project_status->faviour_by_user_id)){
            $status="<span class='in-disputed'>In-Disputed</span>";
        }
        elseif(!empty($project_status->closed) && empty($project_status->incomplete) &&  !empty($project_status->disputed) && !empty($project_status->submitted) && !empty($project_status->resolved) && !empty($project_status->faviour_by_user_id)){
            $selected_user=get_userdata($project_status->faviour_by_user_id);
            if($selected_user->user_type=="client"){
                $status='<span class="in-completed">In-Completed</span>';
            }else{
                $status="<span class='completed-text'>Completed</span>";
            }
        }
        elseif(!empty($project_status->closed) && empty($project_status->incomplete) &&  empty($project_status->disputed) && !empty($project_status->submitted) && empty($project_status->resolved) ){
            $status="<span class='completed-text'>Completed</span>";
        }
    }
    return $status;
}
function get_admin_email(){
    $email = "";
    $admin_user = \App\User::where('user_type','admin')->first();
    if ($admin_user != null) {
        $email = $admin_user->email;
    }
    return $email;
}
function valid_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function CheckFirstMessageClient($id){
    $ChatThread=App\Models\ChatThread::where('receiver_user_id',Auth::user()->id)->where('project_id',$id)->first();
    if($ChatThread){
        $chat_thread = ChatThread::findOrFail($ChatThread->id);
        $firstchats = $chat_thread->chats()->where('sender_user_id', $chat_thread->sender_user_id)->first(); 
        if($firstchats){
           return true;
        }
    }
    return false;
}
function get_city_by_country($country_id)
{
    $cities = City::where('country_id', $country_id)->get();
    return $cities;
}
function get_states($state_id){
    if($state_id){
        $cities = City::where('id', $state_id)->first();
        return (isset($cities->name)) ? $cities->name : '';
    }
    return null;
}
?>