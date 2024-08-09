<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Auth;
use Hash;
use App\User;
use App\Models\Package;
use App\Models\Project;
use App\Models\ChatThread;
use App\Models\UserProfile;
use App\Models\SystemConfiguration;
use App\Models\SubscribeForm;
use App\Models\Faqs;
use App\Models\Address;
use Carbon;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use App\Models\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $faqs=Faqs::where('type','home')->get();
        return view('frontend.default.index',compact('faqs'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function brand()
    {
        $faqs=Faqs::where('type','brand')->get();
        return view('frontend.default.brand',compact('faqs'));
    }
    public function verification_email($email){
        $user=User::where('email', $email)->first();
        if($user){
            send_email_verification_email($email);
        }
        return back()->with('message',"Email verification sent");
    }
    //Admin login
    public function admin_login()
    {
        if(Auth::check() && (auth()->user()->user_type == "admin" || auth()->user()->user_type == "staff")){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    //User login
    public function login()
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('frontend.default.user_login');
    }

    public function admin_dashboard()
    {
        return view('admin.default.dashboard');
    }


    //Redirect user-based dashboard
    public function dashboard()
    {
        $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
        $invitation_projects=getInvitationProject(Auth::user()->id);
        $invitation_count=getInvitationCount();
        if(isFreelancer()){
            return view('frontend.default.user.freelancer.dashboard',compact('invitation_projects','invitation_count'));
        }
        elseif(isClient()){

            // $completed_project= Project::where('client_user_id', Auth::user()->id)
            // ->closed()
            // ->latest()
            // ->paginate(10); 

            $completed_project = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed','!=',null)->paginate(10);

            $running_project = DB::table('project_users')->select('projects.*');
            $running_project->join('projects', 'project_users.project_id', '=', 'projects.id');
            $running_project->where('projects.client_user_id', Auth::user()->id);
            $running_project->where('project_users.closed',null);
            $running_project->where('projects.closed', 0);
            $running_project->orderBy('projects.created_at', 'desc');
            $running_project=$running_project->paginate(10); 
           
            return view('frontend.default.user.client.dashboard',compact('completed_project','running_project'));
        }
        else {
            abort(404);
        }
    }

    //Show details info of specific project
    public function project_details($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->first();

        if($project){
            if(isClient()){
                return view('frontend.default.client-project-single', compact('project'));     
            }elseif(isFreelancer()){
                return view('frontend.default.project-single', compact('project'));
            }
            else{
                return view('frontend.default.client-project-single', compact('project')); 
            }
        }else{
            abort(404);
        }
    }

    //Show details info of specific project
    public function private_project_details($slug)
    {
        $project = Project::where('slug', $slug)->first();
        if ($project != null) {
            $id = $project->id;
            $user = Auth::user()->id;
            $chat_thread = ChatThread::where(function ($query) use ($id){
                                $query->where('project_id', '=', $id);
                            })->where(function ($query) use ($user){
                                $query->where('sender_user_id', '=', $user)
                                      ->orWhere('receiver_user_id', '=', $user);
                            })->first();
        }
        return view('frontend.default.private_project_single', compact('project', 'chat_thread'));
    }

    //Show all project list to user
    // public function all_projects(Request $request)
    // {
    //     $projects = Project::biddable()->notcancel()->where('private', '0')->latest();
    //
    //     $keyword = null;
    //     if($request->has('keyword')){
    //         $keyword = $request->keyword;
    //         $projects = $projects->where('name', 'like', '%'.$keyword.'%');
    //     }
    //     $total = count($projects->get());
    //     $projects = $projects->paginate(8);
    //     return view('frontend.default.projects-listing', compact('projects', 'keyword', 'total'));
    // }

    //Show specific client details to user
    public function my_influencers_details($username)
    {
        $client = User::where('user_name', $username)->first();
        $user_profile=UserProfile::where('user_id', $client->id)->first();
        $address = Address::where('addressable_id', $client->id)->first();
        $influencer_users=User::where('user_type','freelancer')->where('users.id','!=',$client->id)->inRandomOrder() 
            ->join('user_profiles','user_profiles.user_id','=','users.id')
            ->join('user_social_profiles','user_social_profiles.user_id','=','users.id')
            ->paginate(6);
        return view('frontend.default.client-single', compact('client','user_profile','address', 'influencer_users'));
    }

    //Show all client's list to user
    public function client_list()
    {
        $clients = UserProfile::where('user_role_id', '3')->paginate(8);
        $total_clients = UserProfile::where('user_role_id', '3')->get();
        return view('frontend.default.clients-listing', compact('clients', 'total_clients'));
    }

    //Show all freelancer's list to user
    public function freelancer_list()
    {
        $freelancers = UserProfile::where('user_role_id', '2')->paginate(8);
        $total_freelancers = UserProfile::where('user_role_id', '2')->get();
        return view('frontend.default.freelancers-listing', compact('freelancers', 'total_freelancers'));
    }

    //Show specific freelancer details to user
    public function freelancer_details($username)
    {
        $freelancer = User::where('user_name', $username)->first();
        return view('frontend.default.freelancer-single', compact('freelancer'));
    }

    //check if username exists
    public function user_name_check(Request $request)
    {
        $user_name = User::where('user_name', '=', Str::slug($request->username, '-'))->first();
        if ($user_name != null) {
            $response = "<span style='color: red; font-size: 8pt'>User name already Exist.</span>";
            return $response;
        }
        else {
            $response = "<span style='color: green; font-size: 8pt'>Available.</span>";
            return $response;
        }
    }

    public function send_email_verification_request(Request $request){
        return send_email_verification_email();
        //return send_email_verification_email('lalitvisionvivante@gmail.com');
    }

    public function verification_confirmation($code){
        $user = User::where('verification_code', $code)->first();
        if($user != null){
            $user->email_verified_at = Carbon::now();
            $user->save();
            welcome_email($user);
            flash('Your email has been verified successfully')->success();
        }
        else {
            flash('Sorry, we could not verifiy you. Please try again')->error();
           
        }

        return redirect()->route('user.login');
    }

    public function create_permission()
    {
        Permission::create(['name' => 'show running projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'show all projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'show open projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'show cancelled projects', 'guard_name' => 'web']);
        Permission::create(['name' => 'show project cancel requests', 'guard_name' => 'web']);
        Permission::create(['name' => 'show project category', 'guard_name' => 'web']);
        Permission::create(['name' => 'show verification requests', 'guard_name' => 'web']);
        Permission::create(['name' => 'show user chats', 'guard_name' => 'web']);
        Permission::create(['name' => 'show all freelancers', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer packages', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer skills', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer badges', 'guard_name' => 'web']);
        Permission::create(['name' => 'show all clients', 'guard_name' => 'web']);
        Permission::create(['name' => 'show client packages', 'guard_name' => 'web']);
        Permission::create(['name' => 'show client badges', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancers reviews', 'guard_name' => 'web']);
        Permission::create(['name' => 'show client reviews', 'guard_name' => 'web']);
        Permission::create(['name' => 'show active tickets', 'guard_name' => 'web']);
        Permission::create(['name' => 'show my tickets', 'guard_name' => 'web']);
        Permission::create(['name' => 'show solved tickets', 'guard_name' => 'web']);
        Permission::create(['name' => 'show support settings category', 'guard_name' => 'web']);
        Permission::create(['name' => 'show default assigned agent', 'guard_name' => 'web']);
        Permission::create(['name' => 'show project payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show package payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show service payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer withdraw requests', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer payouts', 'guard_name' => 'web']);
        Permission::create(['name' => 'show header', 'guard_name' => 'web']);
        Permission::create(['name' => 'show footer', 'guard_name' => 'web']);
        Permission::create(['name' => 'show pages', 'guard_name' => 'web']);
        Permission::create(['name' => 'show apperance', 'guard_name' => 'web']);
        Permission::create(['name' => 'show all staffs', 'guard_name' => 'web']);
        Permission::create(['name' => 'show employee roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'show general setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show activation setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show system languages setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show system currency setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show email setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show payment gateways setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show third party api setting', 'guard_name' => 'web']);
        Permission::create(['name' => 'show freelancer payment', 'guard_name' => 'web']);
        Permission::create(['name' => 'show manual payment methods', 'guard_name' => 'web']);
        Permission::create(['name' => 'show offline project payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show offline package payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show offline service payments', 'guard_name' => 'web']);
        Permission::create(['name' => 'show addon manager', 'guard_name' => 'web']);
        Permission::create(['name' => 'create new client package', 'guard_name' => 'web']);
        Permission::create(['name' => 'create new freelancer package', 'guard_name' => 'web']);
        Permission::create(['name' => 'show dashboard', 'guard_name' => 'web']);
        Permission::create(['name' => 'show create staff', 'guard_name' => 'web']);
        Permission::create(['name' => 'show create roles', 'guard_name' => 'web']);
    }
    public function subscribe_form(Request $request){
        $validator=  Validator::make($request->all(), [
            'email' => 'required|email|unique:subscribe_form,email',
        ]);
        if ($validator->fails()) {
           return response()->json(['message'=> $validator->errors()->all(), 'status'=> false]);
        }
        if($request->email){
            $SubscribeForm = new SubscribeForm;
            $SubscribeForm->email=$request->email;
            $SubscribeForm->save();
            return response()->json(['message'=> 'Email subscribe successfully ', 'status'=> true]);
        }else{
            return response()->json(['message'=> 'Please enter valid email ID', 'status'=> false]);
        }
    }

}
