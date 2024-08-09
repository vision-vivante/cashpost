<?php

namespace App\Http\Controllers;

use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProjectCategory;
use App\Models\HireInvitation;
use App\Models\UserProfile;
use App\Models\ProjectUser;
use App\Models\ChatThread;
use App\Models\ProjectBid;
use App\Models\Project;
use App\Models\WalletEscrow;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use App\User;
use Session;
use Auth;
use DB;
class HireController extends Controller
{
    //private project freelancer
    public function private_projects(Request $request)
    {
        $items=$request->items ?? 8;
        $sort_search=null;
        if($request->search!= null){
            $sort_search=$request->search;
        }
        if (isClient()) {
            $data['all'] = Project::where('client_user_id', Auth::user()->id)->count();
            $data['applied'] = ProjectBid::join('projects', 'project_bids.project_id', '=', 'projects.id')->where('status',0)->where('projects.client_user_id', Auth::user()->id)->count();
            $data['invitations'] = HireInvitation::join('projects', 'hire_invitations.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('status','pending')->withTrashed()->count();
            $data['inprogress'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed',null)->count();
            $data['completed'] = ProjectUser::join('projects', 'project_users.project_id', '=', 'projects.id')->where('projects.client_user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count();

            $status='<span class="invited">Invited';
            $private_projects=DB::table('hire_invitations');
            $private_projects->where('sent_by_user_id',Auth::user()->id);
            $private_projects->where('status','pending');
            $private_projects->join('projects','hire_invitations.project_id','=','projects.id');
            //$private_projects->where('projects.deleted_at', null);
            if($sort_search!=null){
                $private_projects->where('projects.name', 'like', '%'.$sort_search.'%');
            }
            $private_projects->orderBy('hire_invitations.created_at', 'desc');
            $private_projects=$private_projects->paginate($items);
            return view('frontend.default.user.client.projects.private', compact('private_projects','items','sort_search','status','data'));

        }elseif(isFreelancer()){

         //    $data['applied'] = ProjectBid::join('projects', 'project_bids.project_id', '=', 'projects.id')->where('status',0)->where('projects.client_user_id', Auth::user()->id)->count();

         //    $data['invitations'] = HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status','!=','accepted')->withTrashed()->count();

             
         //    $data['inprogress'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed',null)->count();
         //    $data['completed'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed',null)->count();
            
         //    $data['all'] =  $data['applied'] + $data['invitations'] + $data['inprogress'] + $data['completed'];
         // // dd($data);

        $data = array();
        $projectids = DB::table('project_users')->where('user_id',Auth::user()->id)->pluck('project_id');
            
        $data['applied'] = ProjectBid::where('bid_by_user_id', Auth::user()->id)->whereNotIn('project_bids.project_id',$projectids)->count();
        $data['invitations'] = HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status','!=','accepted')->withTrashed()->count();
        $data['inprogress'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed',null)->count();
        $data['completed'] = ProjectUser::where('user_id', Auth::user()->id)->where('project_users.closed','!=',null)->count();        
        $data['all'] =  $data['applied'] + $data['invitations'] + $data['inprogress'] + $data['completed'];

        $private_projects = HireInvitation::where('sent_to_user_id', Auth::user()->id)->where('status', '!=','accepted')->withTrashed()->paginate($items);
            return view('frontend.default.user.freelancer.projects.private', compact('private_projects','items','sort_search','data'));
        }
    }

    //freelancer invition sending page
    public function freelancer_invition($username)
    {
        $freelancer = User::where('user_name', $username)->first();
        $categories = ProjectCategory::all();
        $client_package = Auth::user()->userPackage;
        return view('frontend.default.user.freelancer_hire_invitation.create', compact('freelancer', 'categories', 'client_package'));
    }

    //Store sent info for hiring freelancers
    public function store(Request $request)
    {   
        if($request->freelancer_id && $request->project_id){
            $price= (isset($request->price)) ? $request->price : 0;
            $message= (isset($request->message)) ? $request->message : '';
            $ProjectBid = HireInvitation::updateOrCreate(
                ['project_id' => $request->project_id,
                'sent_by_user_id'=>Auth::user()->id,
                'sent_to_user_id'=>$request->freelancer_id
                ],
                ['project_id' => $request->project_id,
                'sent_by_user_id'=>Auth::user()->id,
                'sent_to_user_id' => $request->freelancer_id,
                'price' => $price,
                'message' => $message,
                'status' => 'pending'
                ]
            );
           /* $hire_invitation = new HireInvitation;
            $hire_invitation->project_id = $request->project_id;
            $hire_invitation->sent_to_user_id = $request->freelancer_id;
            $hire_invitation->sent_by_user_id = Auth::user()->id;
            $hire_invitation->price = (isset($request->price)) ? $request->price : 0;
            $hire_invitation->message = (isset($request->message)) ? $request->message : '';
            $hire_invitation->save();*/
            $project=Project::findOrFail($request->project_id);
            $sender_user_id=Auth::user()->id;
            $receiver_user_id=$request->freelancer_id;
            $existing_chat_thread = ChatThread::where('sender_user_id', Auth::user()->id)->where('receiver_user_id', $request->freelancer_id)->where('project_id',$request->project_id)->first();
            if ($existing_chat_thread == null) {
                    $existing_chat_thread = new ChatThread;
                    $existing_chat_thread->thread_code = $request->freelancer_id.date('Ymd').Auth::user()->id;
                    $existing_chat_thread->sender_user_id = $sender_user_id;
                    $existing_chat_thread->receiver_user_id = $receiver_user_id;
                    $existing_chat_thread->project_id = (int) $request->project_id;
                    $existing_chat_thread->save();
            }
            $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
            //from client to freelancer
            NotificationUtility::set_notification(
                "freelancer_invitation_for_project",
                "You have received an invitation for a project by ",
                route('project.details',['slug'=>$project->slug],false),
                $request->freelancer_id,
                 Auth::user()->id,
                'freelancer'
            );
            EmailUtility::send_email(
                "You have a new project invitation - ".$project->name,
                "You have received an invitation for a project by ". $user_profile->company_name,
                get_email_by_user_id($request->freelancer_id),
                route('project.details',['slug'=>$project->slug]),
                "View on CashPost"
            );

            flash('Invitation has been sent successfully.')->success();
            return redirect()->route('private_projects');
        }
        else {
            flash('Sorry! Something went wrong.')->error();
            return back();
        }
    }

    //after taking interview client hires freelancer
    public function hire(Request $request)
    {
        $project = Project::withTrashed()->find($request->project_id);
       
        // $project->biddable = 0;
        // $project->save();
        if($project->biddable = 1){
            $project_user = new ProjectUser;
            $project_user->project_id = $request->project_id;
            $project_user->user_id = $request->bid_by_user_id;
            $project_user->hired_at = $request->amount;
            $project_user->closed = null;
            $project_user->disputed = null;
            $project_user->save();
            $bid_users = ProjectBid::where('project_id', $request->project_id)->where('bid_by_user_id',$request->bid_by_user_id)->first();
            $bid_users->status = 1;
            $bid_users->save();
        }
            $w = new WalletEscrow;
            $w->project_id = $request->project_id;
            $w->receiver_id = $request->bid_by_user_id;
            $w->amount = $request->amount;
            $w->commission_fee = (isset($request->commission_fee)) ? $request->commission_fee : '0';
            $w->save();

            $user = Auth::user();
            $user_profile = $user->profile;
            $user_profile->balance = $user_profile->balance - $request->amount;
            $user_profile->save();



        $invited_project = HireInvitation::where('project_id', $project->id)->first();
        $user_company_name = UserProfile::where('user_id', Auth::user()->id)->first();

        if($invited_project != null){
            $invited_project->status = 'accepted';
            $invited_project->save();
        }

        //from freelancer to client
        NotificationUtility::set_notification(
            "freelancer_hired_for_project",
            "You have been hired for a project by ",
            route('project.details',['slug'=>$project->slug],false),
            $request->bid_by_user_id,
            Auth::user()->id,
            'freelancer'
        );
        EmailUtility::send_email(
            "You have been hired - ".$project->name,
            "You have been hired for a project by ".$user_company_name->company_name.". Complete the job and provide proof in your CashPost account.",
            get_email_by_user_id($request->bid_by_user_id),
            route('project.details',['slug'=>$project->slug]),
            "Job Details"
        );

        flash('You have hired successfully.')->success();

        return back();
    }

    //rejecting a private project offer
    public function reject(Request $request)
    {
        //dd($arr_en);

        if(isClient()){
            $projects=Project::withTrashed()->where('slug',$request->project)->first();
            $project_id=$projects->id;
            $bid_users = ProjectBid::where('project_id', $project_id)->where('bid_by_user_id',$request->bid_by_user_id)->first();
            $bid_users->status = 2;
            $bid_users->save();

        }elseif(isFreelancer()){
            $invited_project = HireInvitation::where('project_id',decrypt($request->id))->where('sent_to_user_id',Auth::user()->id)->first();
            $invited_project = HireInvitation::findOrFail(decrypt($request->id));
            $invited_project->status = 2;
            $invited_project->save();

            $project = $invited_project->project;
            //$project->cancel_status = 1;
            //$project->cancel_by_user_id = Auth::user()->id;
            $project->save();
        }

        flash('You have rejected the private project offer')->success();
        return redirect('project-bids');
    }

    // public function hire_modal(Request $request)
    // {
    //     $bidder = ProjectBid::where('project_id', $chat_thread->project_id)->where('bid_by_user_id', $chat_thread->receiver_user_id)->first();
    //     return view('frontend.default.partials.hiring_modal', compact('chat_thread', 'bidder'));
    // }
}