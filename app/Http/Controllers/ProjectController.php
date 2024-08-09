<?php

namespace App\Http\Controllers;

use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Models\Role;
use App\Models\Skill;
use App\Models\Project;
use App\Models\ProjectBid;
use App\Models\ChatThread;
use App\Models\ProjectUser;
use App\Models\UserProfile;
use App\Models\HireInvitation;
use App\Models\ProjectCategory;
use App\Models\MilestonePayment;
use App\Models\Badge;
use App\Models\UserBadge;
use App\Models\WalletEscrow;
use App\Upload;
use Response;
use Illuminate\Support\Str;
use DB;
use Mail;
use Redirect;
use Carbon\Carbon;
use App\Utility\SettingsUtility;
use App\Rules\ReCaptcha;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
        // $projects = Project::where('client_user_id', Auth::user()->id)->latest()->paginate(10);
        // return view('frontend.default.user.client.projects.list', compact('projects'));
    }

    public function my_open_project()
    {
        $projects = Project::where('client_user_id', Auth::user()->id)->open()->biddable()->notcancel()->project_user()->latest()->paginate(10);
        return view('frontend.default.user.client.projects.my_open_projects', compact('projects'));
    }

    public function my_running_project(Request $request)
    {   $items=$request->items ?? 10;
        $sort_search=null;
        $project_slug=$request->project ?? null;
        if($request->search != null){
            if($request->search!= null){
                $sort_search=$request->search;
            }
        }
        if (isClient()) {
            
            $data = $this->client_counts();

            $running_projects = DB::table('project_users')->select('project_users.*','projects.deleted_at as project_banned',);
            $running_projects->join('projects', 'project_users.project_id', '=', 'projects.id');
            $running_projects->where('projects.client_user_id', Auth::user()->id);
            $running_projects->where('project_users.closed', null);
            $running_projects->where('projects.name', 'like', '%'.$sort_search.'%');
            $running_projects->where('projects.closed', 0);
            if($project_slug!=null){
                $project = Project::where('slug', $project_slug)->first();
                if($project){
                    $running_projects->where('projects.id', $project->id);
                    $running_projects->where('project_users.project_id', $project->id);
                }
            }
            $running_projects->orderBy('projects.created_at', 'desc');
            $running_projects=$running_projects->paginate($items);
            return view('frontend.default.user.client.projects.my_running_project', compact('running_projects','items','sort_search','data'));
        }
        elseif (isFreelancer()) {
            $data = $this->freelancer_counts();
            $running_projects = DB::table('project_users')->select('project_users.*','projects.id','projects.client_user_id');
            $running_projects->where('project_users.user_id', Auth::user()->id);
            $running_projects->where('project_users.closed', null);
            $running_projects->where('projects.name', 'like', '%'.$sort_search.'%');
            $running_projects->join('projects', 'project_users.project_id', '=', 'projects.id');
            $running_projects->where('projects.closed', 0);
            if($project_slug!=null){
                $project = Project::where('slug', $project_slug)->first();
                if($project){
                    $running_projects->where('projects.id', $project->id);
                    $running_projects->where('project_users.project_id', $project->id);
                }
            }
            $running_projects->where('projects.cancel_status', 0);
            $running_projects->orderBy('projects.created_at', 'desc');
            $running_projects=$running_projects->paginate($items);
            return view('frontend.default.user.freelancer.projects.my_running_project', compact('running_projects','items','sort_search','data'));
        }
    }

    public function bidded_projects(Request $request)
    {

        $items=$request->items ?? 10;
        $sort_search=null;
        if (isClient()) {            
            $data = $this->client_counts();

            $bidded_projects = ProjectBid::where('bid_by_user_id', Auth::user()->id)->paginate(10);
            $total_bidded_projects = ProjectBid::where('bid_by_user_id', Auth::user()->id)->get();
            return view('frontend.default.user.freelancer.projects.bidded', compact('bidded_projects', 'total_bidded_projects','data'));
        }
        elseif (isFreelancer()) {
            $data = $this->freelancer_counts();
            
            $projectids = DB::table('project_users')->where('user_id',Auth::user()->id)->pluck('project_id');
            if($request->search != null){
                if($request->search!= null){
                    $sort_search=$request->search;
                }
                $bidded_projects = DB::table('project_bids')
                   ->where('bid_by_user_id', Auth::user()->id)
                   ->orderBy('project_bids.created_at', 'desc')
                   ->where('name', 'like', '%'.$sort_search.'%')
                   ->join('projects.', 'projects.id', '=', 'project_bids.project_id')
                   ->whereNotIn('project_bids.project_id',$projectids)
                   ->paginate($items);
            }else{
                $bidded_projects = DB::table('project_bids')
                   ->where('bid_by_user_id', Auth::user()->id)
                   ->orderBy('project_bids.created_at', 'desc')
                   ->join('projects', 'projects.id', '=', 'project_bids.project_id')
                   ->whereNotIn('project_bids.project_id',$projectids)
                   ->paginate($items);
            }
            $total_bidded_projects = ProjectBid::where('bid_by_user_id', Auth::user()->id)->get();
            return view('frontend.default.user.freelancer.projects.bidded', compact('bidded_projects', 'total_bidded_projects','items','sort_search','data'));
        }
    }

    public function my_cancelled_project()
    {
        if (isClient()) {
            $projects = Project::where('client_user_id', Auth::user()->id)->where('cancel_status', '1')->latest()->paginate(10);
            return view('frontend.default.user.client.projects.my_cancelled_project', compact('projects'));
        }
        elseif (isFreelancer()) {
            $cancelled_projects = DB::table('projects')
                    ->orderBy('projects.created_at', 'desc')
                    ->join('project_users', 'projects.id', '=', 'project_users.project_id')
                    ->where('projects.cancel_status', 1)
                    ->where('project_users.user_id', Auth::user()->id)
                    ->select('projects.id')
                    ->distinct()
                    ->paginate(10);

            return view('frontend.default.user.freelancer.projects.my_cancelled_project', compact('cancelled_projects'));
        }

    }
    public function my_completed_project(Request $request)
    {
        $items=$request->items ?? 10;
        $sort_search=null;
        if($request->search!= null){
            $sort_search=$request->search;
        }
        if (isClient()) {
            $data = $this->client_counts();
            $completed_projects = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed','!=',null)->where('projects.name', 'like', '%'.$sort_search.'%')->withTrashed()->paginate($items);
             /*->where('project_users.incomplete',null)*/

            return view('frontend.default.user.client.projects.my_completed_project', compact('completed_projects','items','sort_search','data'));
        }



        elseif (isFreelancer()) {
            $data = $this->freelancer_counts();
            //dd($data);
            $completed_projects = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed','!=',null)
            ->withTrashed()->paginate($items);
            return view('frontend.default.user.freelancer.projects.my_completed_project', compact('completed_projects','items','sort_search','data'));
        }
    }
    public function my_all_project(Request $request){
        $items=$request->items ?? 10;
        $sort_search=null;
        if($request->search != null){
            $sort_search=$request->search;
        }
        if (isClient()) {
            $data = $this->client_counts();
            $all_projects = DB::table('projects')
                ->where('name', 'like', '%'.$sort_search.'%')
                ->where('projects.client_user_id', Auth::user()->id)
                ->where('projects.deleted_at', Null)
                ->orderBy('projects.created_at', 'desc')
                ->distinct()
                ->whereNull('projects.deleted_at')
                ->paginate($items);
                
            return view('frontend.default.user.client.projects.my_all_projects', compact('all_projects','items','sort_search','data'));
        }
        elseif (isFreelancer()) {
            $data = $this->freelancer_counts();
            $bids = DB::table('projects')  
                ->select('projects.id','projects.slug','projects.name','projects.client_user_id','projects.deleted_at','project_bids.project_id','project_bids.bid_by_user_id as influencer_id','project_bids.amount','project_bids.message','project_bids.status','project_bids.created_at')
                ->addSelect(DB::raw("'bid' as type"))           
                ->rightJoin('project_bids', 'projects.id', '=', 'project_bids.project_id')        
                ->where('project_bids.bid_by_user_id', Auth::user()->id);
                $bids=$bids->where('projects.name', 'like', '%'.$sort_search.'%');

            $invites = DB::table('projects')              
                ->select('projects.id','projects.slug','projects.name','projects.client_user_id','projects.deleted_at','hire_invitations.project_id','hire_invitations.sent_to_user_id as influencer_id','hire_invitations.price as amount','hire_invitations.message','hire_invitations.status','hire_invitations.created_at')
                ->addSelect(DB::raw("'invite' as type"))     
                ->rightJoin('hire_invitations', 'projects.id', '=', 'hire_invitations.project_id')->where('hire_invitations.status','!=','accepted')
                ->where('hire_invitations.sent_to_user_id', Auth::user()->id);
                $invites=$invites->where('projects.name', 'like', '%'.$sort_search.'%');
                $mergeTbl = $bids->unionAll($invites);
                $all_projects = DB::table(DB::raw("({$mergeTbl->toSql()}) AS mg"))->mergeBindings($mergeTbl)->paginate($items);
            return view('frontend.default.user.freelancer.projects.my_all_projects',compact('all_projects','items','sort_search','data'));
        }
    }
    public function find_my_all_project(Request $request)
    {
        $sort_search = null;
        $col_name = 'created_at';
        $query = 'desc';
        $category_ids=ProjectInterestedSocial();
        $projectIds = ProjectUser::pluck('project_id')->toArray();
        if($request->search != null || $request->type != null){
            if($request->search!= null){
                $sort_search=$request->search;
            }
            if ($request->type != null){
                $var = explode(",", $request->type);
                $col_name = $var[0];
                $query = $var[1]; 
            }
            $find_all_project = DB::table('projects')
                ->whereIn('projects.project_category_id', $category_ids )
                ->where('name', 'like', '%'.$sort_search.'%')
                ->whereNotIn('projects.id',$projectIds)
                ->where('projects.deleted_at',null)
                ->orderBy($col_name, $query)
                ->paginate(10);
        }else{
            $find_all_project = DB::table('projects')
                ->whereIn('projects.project_category_id', $category_ids )
                ->whereNotIn('projects.id',$projectIds)
                ->where('projects.deleted_at',null)
                ->latest()
                ->paginate(10);
        }
        return view('frontend.default.user.freelancer.projects.my_find_project', compact('find_all_project','col_name','query','sort_search'));
    }
    /*find influencer*/
    public function find_influencers(Request $request){
        $items=$request->items ?? 10;
        $sort_search=null;
        $col_name = null;
        $field = null;
        $gender = null;
        $ethnicity = null;
        $religion = null;
        $follower = null;
        $age = 0;
        $state_id = null;
        $project_slug=$request->project ??  null;
        $min_age=18;
        if(isClient()){
            if($request->search != null || $request->type != null || $request->gender !=null || $request->ethnicity != null || $request->religion != null || $request->min_age !=null || $request->max_age !=null || $request->follower != null || $request->fb != null){

                if($request->search!= null){
                    $sort_search=$request->search;
                }
                if ($request->type != null){
                    $var = explode(",", $request->type);
                    $col_name = $var[0];
                    
                    if($col_name=="facebook"){
                        $field='facebook_url';
                        $follower_field='facebook_follower';
                    }elseif($col_name=="twitter"){
                        $field='twitter_url';
                        $follower_field='twitter_follower';
                    }elseif($col_name=="instagram"){
                        $field='instagram_url';
                        $follower_field='instagram_follower';
                    }elseif($col_name=="youtube"){
                        $field='youtube_url';
                        $follower_field='youtube_follower';
                    }elseif($col_name=="tiktok"){
                        $field='tiktok_url';
                        $follower_field='tiktok_follower';
                    }elseif($col_name=="linkedin"){
                        $field='linkedin_url';
                        $follower_field='linkedin_follower';
                    }else{
                      $field=null;
                      $follower_field=null;
                    }
                }
                
                $users=User::select('users.*','user_profiles.date_of_birth')
                ->where('users.user_type','freelancer')
                ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                ->whereNotNull('user_profiles.stripe_account')
                ->join('user_social_profiles','user_social_profiles.user_id','=','users.id');

                
                if($sort_search!=null){
                   $users->where('users.name', 'like', '%'.$sort_search.'%'); 
                }
                if($request->gender !=null){
                    $gender=$request->gender;
                    $users->where('user_profiles.gender',$gender); 
                }
                if($request->ethnicity != null){
                    $ethnicity=$request->ethnicity;
                    $users->where('user_profiles.ethnicity',$ethnicity); 
                }
                if($request->religion != null){
                    $religion=$request->religion;
                    $users->where('user_profiles.nationality',$religion); 
                }if($request->state_id){
                    $state_id=$request->state_id;

                    $users->leftjoin('addresses','addresses.addressable_id','=','users.id');
                    $users->where('addresses.state_id',$state_id); 

                }if($request->min_age || $request->max_age){
                    $min_age=$request->min_age;
                    $min=$this->reverse_birthday($min_age);
                    $users->wheredate(DB::raw("(STR_TO_DATE(user_profiles.date_of_birth,'%m-%d-%Y'))"),'<=',$min);
                    $max_age=$request->max_age;
                    if($max_age < 65){
                        $max=$this->reverse_birthday($max_age);
                        $users->wheredate(DB::raw("(STR_TO_DATE(user_profiles.date_of_birth,'%m-%d-%Y'))"),'>=',$max);
                    }
                }
                if($project_slug!=null){
                    $project=Project::where('slug',$project_slug)->first();
                    $project_user_id=HireInvitation::where('project_id',$project->id)->where('status','!=','pending')->pluck('sent_to_user_id');
                    $users->whereNotIn('users.id',$project_user_id);
                }
                if(!empty($field) && $request->follower){
                    $follower=$request->follower;
                    $users->where('user_social_profiles.'.$field,'!=',null)->where('user_social_profiles.'.$follower_field,$follower);
                }elseif(!empty($field) && $request->fb){
                    $follower=$request->fb;
                    $users->where('user_social_profiles.'.$field,'!=',null)->where('user_social_profiles.'.$follower_field,$follower);
                }else{
                    if(!empty($field)){
                        $users->where('user_social_profiles.'.$field,'!=','');
                    }
                }
                $users=$users->paginate($items);
                
            }else{

                // $users=User::select('users.*','user_profiles.date_of_birth')->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')->where('user_type','freelancer')->whereNotNull('user_profiles.stripe_account');

                $users=User::select('users.*','user_profiles.date_of_birth')
                ->where('users.user_type','freelancer')
                ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                ->whereNotNull('user_profiles.stripe_account')
                ->join('user_social_profiles','user_social_profiles.user_id','=','users.id');
                if($min_age){
                    $min=$this->reverse_birthday($min_age);
                    $users->wheredate(DB::raw("(STR_TO_DATE(user_profiles.date_of_birth,'%m-%d-%Y'))"),'<=',$min);
                }
                if($project_slug!=null){
                    $project=Project::where('slug',$project_slug)->first();
                    $project_user_id=HireInvitation::where('project_id',$project->id)->pluck('sent_to_user_id');
                    $users->whereNotIn('users.id',$project_user_id);
                }
                $users=$users->paginate($items);
            }
             //dd($users);
            return view('frontend.default.user.client.projects.my_find_Influencer', compact('users','sort_search','col_name','project_slug','gender','ethnicity','religion','age','state_id','follower'));
        }
    }
    public function reverse_birthday( $years ){
        return date('Y-m-d', strtotime($years . ' years ago'));
    }
    public function project_bids(Request $request) 
    {   
        
        $data = $this->client_counts();
        // $data['applied'] = $data['applied'] - $data['completed'] - $data['inprogress'];
        $items= $request->items ?? 10;
        $project_slug=$request->project ?? null;
        $sort_search=  $request->search ??  null;
        $bid_users = DB::table('projects')
        ->select('projects.*','projects.deleted_at as banned_project','project_bids.*');
        $bid_users->where('projects.client_user_id',Auth::user()->id);
        $bid_users->leftjoin('project_bids','projects.id', 'project_bids.project_id');
        if($project_slug!=null){
            $project = Project::withTrashed()->where('slug', $project_slug)->first();
            $bid_users->where('projects.id', $project->id);
            $bid_users->where('project_bids.project_id', $project->id);
        }
        $bid_users->where('name', 'like','%'.$sort_search.'%');
        $bid_users->where('project_bids.status', 0);
        $bid_users=$bid_users->paginate($items);
        
        return view('frontend.default.user.client.projects.bids',compact('bid_users','items','sort_search','data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProjectCategory::all();
        $skills = Skill::all();
        $client_package = Auth::user()->userPackage;
        return view('frontend.default.user.client.projects.create', compact('categories','skills', 'client_package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty($request->category_id==5) || !empty($request->category_id==3)){
            $campaignfile=array("required_if:content_type,2",'mimes:webp,mp4,mov,mkv,webm,3gp|max:1024000');
        }else{
            $campaignfile=array("required_if:content_type,2",'mimes:jpeg,jpg,png,svg,webp,mp4,mov,mkv,webm,3gp|max:1024000');
        }
        $validator=  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'content_type' => ['required', 'string', 'max:255'],
            'extra_url' => ["required_if:content_type,1"],
            'campaign_file' => $campaignfile,
            'description' => ['required'],
        ],
        [
            'extra_url.required_if' => 'Enter the link you want shared.',
            'campaign_file.required_if' => 'Please upload the content you want shared.',
        ]);
        if ($validator->fails()) {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        if(!empty($request->extra_url)){
            $validator=  Validator::make($request->all(), [
                'extra_url' => ['regex:/^(((http|ftp|https):\/{2})+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS'],
            ]);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $uploadAble = true;
        if($uploadAble){
            $project = new Project;
            $project->name = $request->name;
            $project->type = 'Long Term';
            $project->multi_hires = 1;
            $project->price = (isset($request->price)) ? $request->price : '0' ;
            $project->project_category_id = $request->category_id;
            $project->excerpt = (isset($request->excerpt)) ?  $request->excerpt : '';
            $project->skills = json_encode(array());
            $project->description = $request->description;
            $project->attachment = $request->attachments;
            $project->end_date = (isset($request->end_date)) ? $request->end_date : '' ;
            $project->content_type = (isset($request->content_type)) ? $request->content_type : "";
            if($project->content_type==1){
                $project->extra_url = (isset($request->extra_url)) ? $request->extra_url : " ";
            }else{
                $project->extra_url=$this->upload($request,Auth::user()->id);
            }
            $project->client_user_id = Auth::user()->id;
            $project->slug = Str::slug($request->name, '-').date('Ymd-his');
            $project->save();
             $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
            //to admin
            NotificationUtility::set_notification(
                "project_created_by_client",
                "A new Project has been created by ",
                route('project.details',['slug'=>$project->slug],false),
                0,
                Auth::user()->id,
                'admin'
            );
            EmailUtility::send_email(
                "A new Project has been created",
                "A new Project has been created by ". $user_profile->company_name,
                system_email(),
                route('project.details',['slug'=>$project->slug])
            );

            flash('Campaign has been created successfully')->success();
            return redirect()->route('projects.all_project')->with('status', 'Profile updated!');
        }
        else {
            flash('Sorry! Campaign creating limit has been reached.')->warning();
            return back();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd(decrypt($id));
        $project = Project::findOrFail(decrypt($id));
        $categories = ProjectCategory::all();
        $skills = Skill::all();
        if ($project->closed == '0') {
            return view('frontend.default.user.client.projects.edit',compact('categories','skills','project'));
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {  
        //dd($request->file('campaign_file')->getClientOriginalExtension());
        $validator=  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'content_type' => ['required', 'string', 'max:255'],
            'extra_url' => ["required_if:content_type,1"],
            'description' => ['required'],
        ],
        [
            'extra_url.required_if' => 'Enter the link you want shared.',
        ]
        );
        if ($validator->fails()) {
            return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
        }
        if(!empty($request->extra_url) && $request->content_type==1){
            $validator=  Validator::make($request->all(), [
                   'extra_url' => ['regex:/^(((http|ftp|https):\/{2})+(([0-9a-z_-]+\.)+(aero|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|ac|ad|ae|af|ag|ai|al|am|an|ao|aq|ar|as|at|au|aw|ax|az|ba|bb|bd|be|bf|bg|bh|bi|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|cr|cu|cv|cx|cy|cz|cz|de|dj|dk|dm|do|dz|ec|ee|eg|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gg|gh|gi|gl|gm|gn|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|im|in|io|iq|ir|is|it|je|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mk|ml|mn|mn|mo|mp|mr|ms|mt|mu|mv|mw|mx|my|mz|na|nc|ne|nf|ng|ni|nl|no|np|nr|nu|nz|nom|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|ps|pt|pw|py|qa|re|ra|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tl|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw|arpa)(:[0-9]+)?((\/([~0-9a-zA-Z\#\+\%@\.\/_-]+))?(\?[0-9a-zA-Z\+\%@\/&\[\];=_-]+)?)?))\b/imuS'],
                ]);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        if($request->content_type==2 && $request->file('campaign_file')){
            if(!empty($request->category_id==5) || !empty($request->category_id==3)){
                $campaignfile=array("required_if:content_type,2",'mimes:webp,mp4,mov,mkv,webm,3gp|max:1024000');
            }else{
                $campaignfile=array("required_if:content_type,2",'mimes:jpeg,jpg,png,svg,webp,mp4,mov,mkv,webm,3gp|max:1024000');
            }            
            $validator=  Validator::make($request->all(), [
                'campaign_file' => $campaignfile,
                ],
                [
                    'campaign_file.required_if' => 'Please upload the content you want shared.',
                ]);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        $project = Project::findOrFail($id);
        $project->name = $request->name;
        $project->type = 'Long Term';
        $project->multi_hires = 1;
        $project->price = (isset($request->price)) ? $request->price : '0'; ;
        $project->project_category_id = $request->category_id;
        $project->excerpt = (isset($request->excerpt)) ?  $request->excerpt : '';
        $project->skills = json_encode(array());
        $project->description = $request->description;
        $project->attachment = $request->attachment;
        $project->client_user_id = Auth::user()->id;
        $project->end_date = (isset($request->end_date)) ? $request->end_date : '';
        $project->content_type = (isset($request->content_type)) ? $request->content_type : "0";
        if($project->content_type==1){
            $project->extra_url = (isset($request->extra_url)) ? $request->extra_url : " ";
        }else{
            if($request->file('campaign_file')){
                $project->extra_url=$this->upload($request,Auth::user()->id);
            }
        }
        if ($project->slug == null) {
            $project->slug = Str::slug($request->name, '-').date('Ymd-his');
        }
        if ($project->save()) {
            flash('Campaign has been updated successfully')->success();
            return redirect()->route('projects.all_project');
        }
        else {
            flash('Sorry! Something went wrong.')->error();
            return back();
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
        );

        if($request->hasFile('campaign_file')){
            if(is_numeric($request->file_value)){
                $upload_id=$request->file_value;
                $upload=Upload::find($upload_id);
                $file=public_path($upload->file_name);
                unlink($file);
                $upload->file_name = $request->file('campaign_file')->store('uploads/all');
                $upload->user_id = $user_id;
                $upload->extension = $request->file('campaign_file')->getClientOriginalExtension();

                if(isset($type[$upload->extension])){
                    $upload->type = $type[$upload->extension];
                }
                else{
                    $upload->type = "others";
                }
                $upload->file_size = $request->file('campaign_file')->getSize();
                $upload->save();
                return $upload_id;
            }else{
                $upload = new Upload;
                $upload->file_original_name = null;
                
                $arr = explode('.', $request->file('campaign_file')->getClientOriginalName());
                
                for($i=0; $i < count($arr)-1; $i++){
                    if($i == 0){
                        $upload->file_original_name .= $arr[$i];
                    }
                    else{
                        $upload->file_original_name .= ".".$arr[$i];
                    }
                }

                $upload->file_name = $request->file('campaign_file')->store('uploads/all');
                $upload->user_id = $user_id;
                $upload->extension = $request->file('campaign_file')->getClientOriginalExtension();

                if(isset($type[$upload->extension])){
                    $upload->type = $type[$upload->extension];
                }
                else{
                    $upload->type = "others";
                }
                $upload->file_size = $request->file('campaign_file')->getSize();
                $upload->save();
                return $upload->id;
            }
        }
    }

    public function project_submit(Request $request)
    {   
        if(@fopen($request->url,'r')){
            $project_id = $request->project_id;
            $active_project = ProjectUser::where('project_id',$project_id)->where('user_id',Auth::user()->id)->first();
            $project = Project::withTrashed()->findOrFail($project_id);
            if($active_project){
                $active_project->submitted = now();
                $active_project->social_url=$request->url;
                $active_project->save();

                 $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
                NotificationUtility::set_notification(
                    "project_submitted_by_user",
                    "A Project has been submitted for completion by ",
                    route('projects.my_running_project'),
                    $project->client_user_id,
                    Auth::user()->id,
                    'client'
                );           
                EmailUtility::send_email(
                    "A Project has been submitted for completion",
                    "A Project has been submitted for completion By ".$user_profile->company_name,
                    get_email_by_user_id($project->client_user_id),
                    route('projects.my_running_project')
                );
                flash(translate('Campaign has been submitted successfully'))->success();
                $response = array('status' => true);
                return response()->json($response);

            }else{
                $response = array('status' => true); 
                return response()->json($response);

            }
        }else{
            $response=array('status'=>false,'msg'=>'Please enter a valid URL');
            return response()->json($response);
        }
    }
    public function project_complete(Request $request)
    {   
        $project_slug = $request->project_id;
        $user_id = $request->user_id;
        $project = Project::where('slug', $project_slug)->first();
        
        if($project){

            $active_project = ProjectUser::where('project_id', $project->id)->where('user_id',$user_id)->first();
            if($active_project){

                $stripe = new StripePaymentController;
                $transfer = json_decode($stripe->transfer($active_project));
                if($transfer && $transfer->transfer_data->id){

                $active_project->closed = now();
                ///$active_project->commission_fee = $transfer->commission_fee;
                wallet_escrows_transfer($project->id,$user_id,$user_id,$transfer->commission_fee);
                $active_project->save();
                $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
                NotificationUtility::set_notification(
                    "project_submitted_by_user",
                    "A Project has been marked as completed by ",
                    route('projects.all_project'),
                    $project->client_user_id,
                    Auth::user()->id,
                    'freelancer'
                );           
                EmailUtility::send_email(
                    "A Project has been marked as completed",
                    "A Project has been marked as completed ". $user_profile->company_name,
                    get_email_by_user_id($user_id),
                    route('projects.all_project')
                );
                }
            }
            return back();

        }else{
            return back();

        }
    }
    public function project_cancel($id)
    {
        $active_project = ProjectUser::where('project_id', $id)->first();
        $project = Project::findOrFail($id);
        if ($active_project == null)
        {
            $project->cancel_status = '1';
            $project->cancel_by_user_id = Auth::user()->id;
            $project->save();
            if ($project->private == '1') {
                Project::destroy($project->id);
            }
            flash(translate('Project has been cancelled successfully'))->success();
            return redirect()->back();
        }
        elseif ($active_project != null) {
            return view('frontend.default.user.projects.project_cancel_request', compact('project'));
        }
        else
        {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail(decrypt($id));
        foreach ($project->projectBids as $key => $bid) {
            $bid->delete();
        }

        foreach ($project->reviews as $key =>$review) {
            $review->delete();
        }
        /*foreach ($project->project_user as $key =>$project_user_val) {
            $project_user_val->delete();
        }*/
    

        $invites = HireInvitation::where('project_id', $project->id)->get();
        if ($invites != null) {
            foreach ($invites as $key =>$invite) {
                $invite->delete();
            }
        }

        $milestone_payments = MilestonePayment::where('project_id', $project->id)->get();
        if ($milestone_payments != null) {
            foreach ($milestone_payments as $key =>$milestone_payment) {
                $milestone_payment->delete();
            }
        }

        $project_users = ProjectUser::where('project_id', $project->id)->get();
        if ($project_users != null) {
            foreach ($project_users as $key =>$project_user) {
                $project_user->delete();
            }
        }
        if(Project::destroy(decrypt($id))){
            flash(translate('Campaign has been deleted successfully'))->success();
            return redirect()->route('projects.all_project');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
   

    public function get_bid_modal(Request $request)
    {
        $project = Project::withTrashed()->findOrFail($request->id);
        return view('frontend.default.partials.bid_for_project_modal', compact('project'));
    }
    public function get_hire_project_modal(Request $request)
    {  
        if(isClient()){
            $freelancer_id=$request->id;
            $project_slug=$request->project_slug ?? null;
            if(!empty($project_slug)){
                $project = Project::where('slug', $project_slug)->first();
                $project_id=$project->id;
            }
            $client_id=Auth::user()->id;
            $social_category_ids=ProjectInterestedSocial($freelancer_id);
            $existing_chat_thread = ChatThread::where('sender_user_id', $client_id)->where('receiver_user_id', $freelancer_id)->pluck('project_id')->toArray();

            $reinvite_exclude_ids =HireInvitation::where('sent_by_user_id',Auth::user()->id)->where('sent_to_user_id',$freelancer_id)->where(function($query){
                $query->where('status','pending');
                $query->Orwhere('status','accepted');
            })->pluck('project_id');
            if($project_slug){
                $assign_project_id =ProjectUser::where('project_id',$project_id)->where('user_id',$freelancer_id)->pluck('project_id');
            }
            else{
                $assign_project_id =ProjectUser::where('user_id',$freelancer_id)->pluck('project_id');
            }
            
            $projects = Project::whereIn('projects.project_category_id',$social_category_ids);
            $projects->where('client_user_id',$client_id);
            $projects->where("projects.cancel_status",0);
           
            if(count($reinvite_exclude_ids)){
                $projects->whereNotIn('projects.id',$reinvite_exclude_ids);
            }
            if(count($assign_project_id)){
                $projects->whereNotIn('projects.id',$assign_project_id);
            }
           /* if($existing_chat_thread!=null){
                $exists_ids=$existing_chat_thread;
                $projects->whereNotIn('projects.id',$exists_ids);
            }*/
            $projects=$projects->get();
            return view('frontend.default.partials.hire_for_project_modal', compact('projects','freelancer_id','project_slug'));
        }
    }
    public function project_hire_done($id)
    {
        $project = Project::findOrFail($id);
        $project->biddable = 0;
        $project->save();
        flash('Hiring for this project is closed')->success();
        return back();

    }
    public function project_done($id)
    {
        $project = Project::findOrFail($id);

        if(MilestonePayment::where('project_id', $project->id)->where('paid_status', 1)->sum('amount') >= $project->project_user->hired_at){
            
            // $project->closed = 1;
            // $project->save();
            try {
                $this->check_for_client_project_badge($project->client_user_id);
                $this->check_for_freelancer_project_badge($project->project_user->user_id);
            } catch (\Exception $e) {

            }
            $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
            //to freelancer
            NotificationUtility::set_notification(
                "project_completed_by_client",
                "A Project has been marked as completed by ",
                route('project.details',['slug'=>$project->slug],false),
                $project->client_user_id,
                Auth::user()->id,
                'freelancer'
            );
            EmailUtility::send_email(
                "A Project has been marked as completed",
                "A Project has been marked as completed by ". $user_profile->company_name,
                get_email_by_user_id($project->project_user->user_id),
                route('project.details',['slug'=>$project->slug])
            );
        }
        else {
            flash('Please complete the payments to end this project')->warning();
        }

        return back();
    }

    public function check_for_client_project_badge($user_id){
        $badges = Badge::where('type','project_badge')->where('role_id', 'client')->orderBy('value', 'desc')->get();
        foreach ($badges as $key => $badge) {
            if(Project::where('client_user_id', $user_id)->where('closed', 1)->count() >= $badge->value){
                $user_badge = UserBadge::where('user_id', $user_id)->where('type', 'project_badge')->first();
                if($user_badge == null){
                    $user_badge = new UserBadge;
                }
                $user_badge->user_id = $user_id;
                $user_badge->type = 'project_badge';
                $user_badge->badge_id = $badge->id;
                $user_badge->save();

                break;
            }
        }
    }

    public function check_for_freelancer_project_badge($user_id){
        $badges = Badge::where('type','project_badge')->where('role_id', 'freelancer')->orderBy('value', 'desc')->get();
        $total = 0;
        foreach (ProjectUser::where('user_id', $user_id)->get() as $key => $project_user) {
            if($project_user->project != null){
                if($project_user->project->closed){
                    $total++;
                }
            }
        }
        foreach ($badges as $key => $badge) {
            if($total >= $badge->value){
                $user_badge = UserBadge::where('user_id', $user_id)->where('type', 'project_badge')->first();
                if($user_badge == null){
                    $user_badge = new UserBadge;
                }
                $user_badge->user_id = $user_id;
                $user_badge->type = 'project_badge';
                $user_badge->badge_id = $badge->id;
                $user_badge->save();

                break;
            }
        }
    }
    public function Project_Mark_Incomplete(){
        $reply_timing=get_setting('project_cancel_hours');
        $running_projects = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->select('project_users.*','projects.client_user_id');
        $running_projects->where('project_users.closed', null);
        $running_projects->where('project_users.submitted', null);
        $running_projects->where('projects.closed', 0);
        $running_projects=$running_projects->get();
        if($running_projects){
            foreach($running_projects as $key => $running_project){
                $project_id=$running_project->project_id;
                $user_id=$running_project->user_id;
                $client_user_id=$running_project->client_user_id;
                $now = Carbon::now();
                $created_at = Carbon::parse($running_project->created_at);
                $diffHours = $created_at->diffInHours($now); 
                if($reply_timing < $diffHours){
                    $mark_incomplete_date = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                    $project_users=ProjectUser::where('id',$running_project->id)->where('project_id',$project_id)->where('user_id',$user_id)->update(['closed'=>$mark_incomplete_date,'incomplete'=>$mark_incomplete_date]);
                    //$active_project = ProjectUser::where('project_id', $project_id)->where('user_id',$user_id)->first();
                    wallet_escrows_transfer($project_id,$user_id,$client_user_id);
                    $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
                    NotificationUtility::set_notification(
                            "A Project has been marked as incompleted",
                            "A Project has been marked as incompleted ",
                            route('projects.all_project'),
                            $user_id,
                            Auth::user()->id,
                            'freelancer'
                        );           
                    EmailUtility::send_email(
                        "A Project has been marked as incompleted",
                        "A Project has been marked as incompleted ". $user_profile->company_name,
                        get_email_by_user_id($user_id),
                        route('projects.all_project')
                    );

                }
            }
        }
    }
    public function Project_Mark_Complete(){
        $set_disute_time=get_setting('set_disute_time');
        $complete_projects = DB::table('project_users')->select('project_users.*');
        $complete_projects->join('projects', 'project_users.project_id', '=', 'projects.id');
        $complete_projects->where('project_users.closed', null);
        $complete_projects->where('project_users.submitted','!=',null);
        $complete_projects->where('projects.closed', 0);
        $complete_projects=$complete_projects->get();
        if($complete_projects){
            foreach($complete_projects as $key => $complete_project){
                $project_id=$complete_project->project_id;
                $user_id=$complete_project->user_id;
                $now = Carbon::now();
                $disputed_date = Carbon::parse($complete_project->disputed);
                $diffHours = $disputed_date->diffInHours($now); 
                if($set_disute_time < $diffHours){
                    $mark_complete_date = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                    $project_users=ProjectUser::where('id',$complete_project->id)->where('project_id',$project_id)->where('user_id',$user_id)->update(['closed'=>$mark_complete_date]);

                    $active_project = ProjectUser::where('project_id', $project_id)->where('user_id',$user_id)->first();
                    if($active_project){
                        $stripe = new StripePaymentController;
                        $transfer = json_decode($stripe->transfer($active_project));
                        if($transfer->transfer_data->id){

                            $active_project->closed = now();

                            //$active_project->commission_fee = $transfer->commission_fee;
                            $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
                            $active_project->save();
                            wallet_escrows_transfer($project_id,$user_id,$user_id,$transfer->commission_fee);
                            NotificationUtility::set_notification(
                                "project_submitted_by_user",
                                "A Project has been marked as completed by ",
                                route('projects.all_project'),
                                $user_id,
                                Auth::user()->id,
                                'freelancer'
                            );           
                            EmailUtility::send_email(
                                "A Project has been marked as completed",
                                "A Project has been marked as completed ". $user_profile->company_name,
                                get_email_by_user_id($user_id),
                                route('projects.all_project')
                            );
                        }
                    }
                }
            }
        }
    }

    public function get_disputed_project_modal(Request $request){
        $project_id = $request->project_id;
        $receiver_id = $request->receiver_user_id;
        $admin_email = SettingsUtility::admin_email();
        $admin_id = $admin_email->id;
        $active_project = ProjectUser::where('project_id', $project_id)->where('user_id',$receiver_id)->where('submitted','!=',null)->first();
        if($active_project){
            $project = Project::findOrFail($project_id);
            $active_project->disputed = now();
            $active_project->disputed_by = Auth::user()->id;
            $active_project->save();

            $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
            NotificationUtility::set_notification(
                "project_submitted_by_user",
                "A Project has been disputed for completion by ",
                route('projects.my_running_project'),
                $project->client_user_id,
                Auth::user()->id,
                'client'
            );
            EmailUtility::send_email(
                "A Project has been disputed for submitted",
                "A Project has been disputed for submitted By ". $user_profile->company_name,
                get_email_by_user_id($project->client_user_id),
                route('projects.my_running_project')
            );

             NotificationUtility::set_notification(
                "project_submitted_by_user",
                "A Project has been disputed for completion by ",
                route('projects.my_running_project'),
                $receiver_id,
                Auth::user()->id,
                'freelancer'
            ); 
            EmailUtility::send_email(
                "A Project has been disputed for submitted",
                "A Project has been disputed for submitted By ". $user_profile->company_name,
                get_email_by_user_id($receiver_id),
                route('projects.my_running_project')
            );
            EmailUtility::send_email(
                "A Project has been disputed for submitted",
                "A Project has been disputed for submitted By ".$user_profile->company_name,
                //"manojvisionvivante@gmail.com"
                //get_email_by_user_id($admin_id)
                "disputes@cashpost.net"
             );
            return back();
        }else{
            return back();

        }
    }

    private function client_counts(){
        $data = array();
        $data['all'] = Project::where('client_user_id', Auth::user()->id)->count();
        $data['applied'] = ProjectBid::join('projects', 'project_bids.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('status',0)->count();
        $data['invitations'] = HireInvitation::join('projects', 'hire_invitations.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('status','pending')->count();
        $data['inprogress'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed',null)->count();
        $data['completed'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count();
        return $data;
    }
    private function freelancer_counts(){        
        $data = array();
        $projectids = DB::table('project_users')->where('user_id',Auth::user()->id)->pluck('project_id');
            
        $data['applied'] = ProjectBid::where('bid_by_user_id', Auth::user()->id)->whereNotIn('project_bids.project_id',$projectids)->count();
        $data['invitations'] = HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status','!=','accepted')->withTrashed()->count();
        $data['inprogress'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed',null)->count();
        $data['completed'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count();        
        $data['all'] =  $data['applied'] + $data['invitations'] + $data['inprogress'] + $data['completed'];
        
        return $data;

    }
    public function submit_proof_for_project_modal(Request $request){
         if(isFreelancer()){
            $project_id=$request->project_id ?? null;
            if(!empty($project_id)){
                $project = Project::withTrashed()->findOrFail($project_id);
                return view('frontend.default.partials.submit_proof_modal', compact('project'));
            }else{
               return  back();
            }
        }
    }
    public function dispute_for_project_modal(Request $request){
        if(isClient()){
            $project_id=$request->project_id ?? null;
            $receiver_id=$request->receiver_user_id ?? null;
            if($receiver_id && $project_id){
                $project = ProjectUser::where('project_id', $project_id)->where('user_id',$receiver_id)->where('submitted','!=',null)->first();
                return view('frontend.default.partials.dispute_modal', compact('project'));
            }else{
                return back();
            }
        }
    }
    public function campaign_create_request(Request $request){

       
        $errors=[];
        $data=[];

        if(empty($request->first_name)){
            $errors['firstname']="First Name is required.";
        }
        if(empty($request->last_name)){
            $errors['lastname']="Last Name is required.";
        } 
        if(empty($request->company_name)){
            $errors['company_name']="Company Name is required.";
        }
        if(empty($request->address)){
            $errors['address']="Address is required.";
        }
        if(empty($request->phone_no)){
            $errors['phone_no']="Please enter valid phone number.";
        }
        if(empty($request->message)){
            $errors['message']="Message is required.";
        }

        if(empty($request->r_captcha)){
            $errors['r_captcha']="Please verify you are a human.";
        }
    
        if(empty($request->email)){
            $errors['email']="Email is required.";
        }else{
            if(valid_email($request->email)==false){
                $errors['email']="Please enter valid Email ID.";
            } 
        }

       
        if(empty($errors)){

            if(!empty($request->r_captcha)){

                $request->validate([

                    'r_captcha' => ['required', new ReCaptcha]

                ]);
            }

            $firstname=$request->first_name;
            $lastname=$request->last_name;
            $address=$request->address;
            $email=$request->email;
            $company_name=$request->company_name;
            $phone_no=$request->phone_no;
            $messages=$request->message;
            // EmailUtility::send_email(
            //     "A Client create new campaign details",
            //     "A Campaign create client detail". $firstname.' '.$lastname,
            //     "lalitvisionvivante@gmail.com",
            // );
            //dd($request);
            Mail::send('emails/admin_campaign_request', [
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'subject' => 'CashPost Brand Registration Request',
                'email' => $request->get('email'),
                'phone_no' => $request->get('phone_no'),
                'company_name' => $request->get('company_name'),
                'address' => $request->get('address'),
                'messages' => $request->get('message'),
            ],
            function ($message) use ($request) {
                $message->from($request->get('email'));
                $message->to("brandinfo@cashpost.net");
                // $message->to("manojvisionvivante@gmail.com");
                $message->subject('CashPost Brand Registration Request');
            });
            $response['status']=true;
            $response['message']="success";
            $response['mail_sent']="true";
        }else{
            $response['status']=false;
            $response['errors']=$errors;
        }
         return response()->json($response);
        //return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
        exit;
    }

}