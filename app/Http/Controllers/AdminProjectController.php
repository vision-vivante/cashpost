<?php

namespace App\Http\Controllers;

use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectUser;
use DB;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\UserProfile;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Session;
use Mail;
use Carbon;


class AdminProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show all projects'])->only('all_projects');
        $this->middleware(['permission:show running projects'])->only('running_projects');
        $this->middleware(['permission:show open projects'])->only('open_projects');
        $this->middleware(['permission:show cancelled projects'])->only('cancelled_projects');

    }
    //Admin can see all projects in admin panel
    public function all_projects(Request $request)
    {
       
        $type =null;
        $sort_search = null;
        $client_id = null;
        if ($request->search != null || $request->user_id != null || $request->type != null) {
                $projects= Project::select('projects.*','projects.client_user_id');

            if ($request->search != null){
                $sort_search = $request->search;
                $projects =$projects->where('projects.name', 'like','%'.$sort_search.'%');
            }
            if ($request->has('user_id') && $request->user_id != null) {
                $client_id = $request->user_id;
                $projects = $projects->where('projects.client_user_id', $client_id);
            }

            if($request->type != null){   
                $type=$request->type;
                $projects= $projects->join('project_users', 'projects.id', '=', 'project_users.project_id');
                if($type=="completed"){

                    $projects->where('project_users.submitted','!=',null);
                    $projects->where('project_users.closed','!=',null);  
                    $projects->where('project_users.incomplete',null);
                }elseif($type=="in-progress"){
                    $projects->where('project_users.submitted',null);
                    $projects->where('project_users.incomplete',null);
                    $projects->where('project_users.disputed',null);
                    $projects->where('project_users.closed',null);
                }elseif($type=="in-submitted"){
                    $projects->where('project_users.submitted','!=',null);
                    $projects->where('project_users.incomplete',null);
                    $projects->where('project_users.disputed',null);
                    $projects->where('project_users.closed',null);
                }elseif($type=="in-completed"){
                    $projects->where('project_users.submitted','!=',null);
                    $projects->where('project_users.incomplete','!=',null);
                }elseif($type=="disputed"){
                    $projects->where('project_users.incomplete',null);
                    $projects->where('project_users.submitted','!=',null);
                    $projects->where('project_users.disputed','!=',null);
                    $projects->where('project_users.closed',null);
                }
            }
            $projects = $projects->withTrashed()->paginate(12);
        }
        else {
            $projects = Project::withTrashed()->latest()->paginate(12);
        }


        return view('admin.default.project.projects.index',compact('projects','type','sort_search','client_id'));
    }

    //Admin can see all running projects in admin panel
    public function running_projects(Request $request)
    {
        $sort_search = null;
        $client_id = null;
        $projects =ProjectUser::join('projects','project_users.project_id', '=', 'projects.id')->select('projects.*','project_users.id','project_users.user_id','project_users.submitted','project_users.closed');
        $projects->where('project_users.closed', null);
        $projects->where('project_users.incomplete', null);
        $projects->where('projects.closed', 0);
        if ($request->has('user_id') && $request->user_id != null) {
            $projects->where('projects.client_user_id', $request->user_id);
            $client_id = $request->user_id;
        }
        if ($request->search != null){
            $projects->where('projects.name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
        //$projects->where('projects.cancel_status', 0);
        $projects->orderBy('projects.created_at', 'desc');
        $projects=$projects->paginate(12);

        return view('admin.default.project.projects.running_projects', compact('projects', 'sort_search', 'client_id'));
    }

    //Admin can see all open projects in admin panel
    public function open_projects(Request $request)
    {
        $col_name = null;
        $query = null;
        $sort_search = null;
        $client_id = null;

        if ($request->search != null || $request->type != null) {
            if ($request->has('user_id') && $request->user_id != null) {
                $products = Project::where('client_user_id', $request->user_id);
                $client_id = $request->user_id;
            }
            if ($request->search != null){
                $projects = Project::where('name', 'like', '%'.$request->search.'%');
                $sort_search = $request->search;
            }
            if ($request->type != null){
                $var = explode(",", $request->type);
                $col_name = $var[0];
                $query = $var[1];
                $projects = Project::orderBy($col_name, $query);
            }
            $projects = $projects->biddable()->open()->notcancel()->paginate(12);
        }
        else {
            $projects = Project::biddable()->open()->notcancel()->latest()->paginate(12);
        }
        return view('admin.default.project.projects.open_projects', compact('projects', 'col_name', 'query', 'sort_search', 'client_id'));
    }

    //Admin can see all cancelled projects in admin panel
    public function cancelled_projects(Request $request)
    {
        $col_name = null;
        $query = null;
        $sort_search = null;
        $client_id = null;

        if ($request->search != null || $request->type != null) {
            if ($request->has('user_id') && $request->user_id != null) {
                $products = Project::where('client_user_id', $request->user_id);
                $client_id = $request->user_id;
            }
            if ($request->search != null){
                $projects = Project::where('name', 'like', '%'.$request->search.'%');
                $sort_search = $request->search;
            }
            if ($request->type != null){
                $var = explode(",", $request->type);
                $col_name = $var[0];
                $query = $var[1];
                $projects = Project::orderBy($col_name, $query);
            }
            $projects = $projects->biddable()->open()->notcancel()->paginate(12);
        }
        else {
            $projects = Project::where('cancel_status', '1')->latest()->paginate(12);
        }

        return view('admin.default.project.projects.cancelled_projects', compact('projects', 'col_name', 'query', 'sort_search', 'client_id'));
    }

    public function project_approval(Request $request)
    {
        $project = Project::findOrFail($request->id);
        $project->project_approval = $request->status;
        if($project->save()){
            return 1;
        }
        else {
            return 0;
        }
    }
    public function get_admin_all_project($project_id){
        $projects= ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('project_users.project_id', $project_id)->where('project_users.closed','!=',null)->get();
    }
    public function get_dispute_resolve_modal(Request $request){
        $projectuser_id=$request->projectuser_id;
        if($request->sender_id){
            $users['client']=get_userdata($request->sender_id);
        }if($request->receiver_id){
            $users['freelancer']=get_userdata($request->receiver_id);
        }if($request->project_id){
            $project=Project::where('id',$request->project_id)->first();
        }
        return view('admin.default.partials.dispute_resolve_modal', compact('users','project','projectuser_id'));
    }

    public function store(Request $request){
        if($request->faviour_by_user_id && $request->projectuser_id){
            $projectuser=ProjectUser::find($request->projectuser_id);
            if($projectuser){
                $projectuser->resolved=now();
                $projectuser->faviour_by_user_id=$request->faviour_by_user_id;
                $user_data=get_userdata($request->faviour_by_user_id);
                if($user_data->user_type="client"){
                    $projectuser->incomplete=now();
                    wallet_escrows_transfer($projectuser->project_id,$projectuser->user_id,$request->faviour_by_user_id);
                }else{
                    $stripe = new StripePaymentController;
                    $transfer = json_encode($stripe->transfer($projectuser));
                    if($transfer->transfer_data->id){
                        //wallet_escrows_transfer($project_id,$projectuser->user_id,$request->faviour_by_user_id);
                        $projectuser->commission_fee=$transfer->commission_fee;
                    }
                }
                $projectuser->closed=now();
                $projectuser->save();
            }
            NotificationUtility::set_notification(
                "Dispute campaign issue resolved",
                "Dispute campaign issue resolved ",
                '','',$request->faviour_by_user_id,
                ''
            );
            EmailUtility::send_email(
                "Dispute campaign issue resolved",
                "Dispute campaign issue resolved ". Auth::user()->name,
                get_email_by_user_id($request->faviour_by_user_id),
            );
            flash(translate('Dispute campaign issue resolved successfully'))->success();
            $response = array('status' => true,'msg' =>'Dispute campaign issue resolved successfully'); 
            return response()->json($response);
        }else{
            $response = array('status' => false,'msg' =>'Please Try Again'); 
            return response()->json($response);
        }
    }
     /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
     
    public function showclientregsiterform(){
        return view('admin.default.client.clients.client_register');
    }
    public function admin_register_client(Request $request){


        $password = Str::random(10);
        //$admin_email=get_setting('admin_email');
        $validator=Validator::make($request->all(), [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'company_name' => ['required', 'string'],
                'address' => ['required', 'string'],
                'email' => ['required','email','unique:users','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'], 
            ]
        );
        if ($validator->fails()) {
            return redirect('admin/brand/create')->withErrors($validator)->withInput();
        }
        $first_name=$request->first_name;
        $last_name=$request->last_name;
        $email=$request->email;
        $company_name=$request->company_name;
        $new_address=$request->address;
        $user = User::create([
            'name' => $first_name.' '.$last_name,
            'email' => $email,
            'user_name' =>Str::slug($first_name, '-').date('Ymd-his'),
            'password' => Hash::make($password)
        ]);
       
        if($user->id){
            $user->user_type = 'client';
            $address = new Address;
            $address->street=$new_address;
            $user->verification_code = encrypt($user->id);
            $user->email_verified_at = Carbon::now();
            $user->address()->save($address);
            $user->save();
            $user_profile = new UserProfile;
            $user_profile->user_id = $user->id;
            $user_profile->company_name = $company_name;
            $user_profile->save();
        }
        Mail::send('emails/admin_client_register', [
            'name' => $first_name .' '. $last_name,
            'subject' => 'Admin register new client',
            'email' => $email, 
            'company_name' => $company_name,
            // 'email_logo' => email_logo(1),
            'address' => $new_address,
            'password' => $password,
        ],
        function ($message) use ($request) {
            $message->from(get_setting('admin_email'));
            $message->to($request->get('email'));
            $message->subject('New user register');
        });
        flash(translate('New client added successfully'))->success();
        return back()->with('success', 'New client added successfully');
    }
    /* campaign active and disable */
    function active_project_action($id){
        $project = Project::withTrashed()->findOrFail($id);
        if($project->deleted_at){
            $project->deleted_at = null;
            $project->save();
            flash(translate('campaign has been enable successfully'))->success();
        }
        else{
            $project->deleted_at = now();
            $project->save();
            flash(translate('campaign has been disable successfully'))->success();
        }
        return back();
    }
}
