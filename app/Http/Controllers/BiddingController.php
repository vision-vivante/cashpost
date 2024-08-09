<?php

namespace App\Http\Controllers;

use App\Utility\EmailUtility;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use App\Models\ProjectBid;
use App\Models\UserPackage;
use App\Models\Project;
use App\Models\Notification;
use App\Models\ChatThread;
use App\Models\HireInvitation;
use App\User;

use Auth;

class BiddingController extends Controller
{
    // New Bid Request Store

    public function store(Request $request)
    {
        $set_bid_price=get_setting('set_bid_price');
        if(empty($request->amount)){
            $response = array('status' => false,'msg' =>'Enter bid price greater than 0' ); 
            return response()->json($response);
        }elseif( $request->amount > $set_bid_price || empty($request->amount)){
            $response = array('status' => false,'msg' =>'Bids cannot exceed '.$set_bid_price.' credits' ); 
            return response()->json($response);
        }
        $biddable = true;
        /*if(Project::findOrFail($request->project_id)->type == 'Fixed'){
            $userPackage = UserPackage::where('user_id', Auth::user()->id)->first();
            if($userPackage->fixed_limit > 0){
                $userPackage->fixed_limit -= 1 ;
                $userPackage->save();

                $biddable = true;
            }
        }
        else{
            $userPackage = UserPackage::where('user_id', Auth::user()->id)->first();
            if($userPackage->long_term_limit > 0){
                $userPackage->long_term_limit -= 1 ;
                $userPackage->save();

                $biddable = true;
            }
        }*/
        if ($biddable) {
            $ProjectBid = ProjectBid::updateOrCreate(
                    ['project_id' => $request->project_id,'bid_by_user_id'=>Auth::user()->id],
                    ['project_id' => $request->project_id,'bid_by_user_id'=>Auth::user()->id,'amount' => $request->amount,'message' => $request->message,'status' => 0]
                );
    
               /* $bid = new ProjectBid;
                $bid->project_id = $request->project_id;
                $bid->bid_by_user_id = Auth::user()->id;
                $bid->amount = $request->amount;
                $bid->message = $request->message;
                $bid->save();*/


            $project = Project::withTrashed()->where('id',$request->project_id)->first();
            $project->bids ++;
            $project->save();


            $existing_chat_thread = ChatThread::where('sender_user_id',$project->client_user_id )->where('receiver_user_id', Auth::user()->id)->where('project_id',$request->project_id)->first();
            if ($existing_chat_thread == null) {
                    $existing_chat_thread = new ChatThread;
                    $existing_chat_thread->thread_code = Auth::user()->id.date('Ymd').$project->client_user_id;
                    $existing_chat_thread->sender_user_id = $project->client_user_id;
                    $existing_chat_thread->receiver_user_id = Auth::user()->id;
                    $existing_chat_thread->project_id = (int) $request->project_id;
                    $existing_chat_thread->save();
            }
            if(isFreelancer()){
                $invited_project = HireInvitation::where('project_id', $project->id)->where('sent_to_user_id',Auth::user()->id)->first();
                if($invited_project != null){
                    $invited_project->status = 'accepted';
                    $invited_project->save();
                }
            }

            //from freelancer to client
            NotificationUtility::set_notification(
                "influencer bid_on_project",
                "A new bid has been submitted by ",
                route('project.details',['slug'=>$project->slug],false),
                $project->client_user_id,
                Auth::user()->id,
                'client'
            );
            EmailUtility::send_email(
                "A new bid has been submitted",
                "A new bid has been submitted by ". Auth::user()->name,
                get_email_by_user_id($project->client_user_id),
                route('project.details',['slug'=>$project->slug]),
                "Review Bid"
            );

            flash(translate('Bid has been submitted successfully'))->success();
            $response = array('status' => true,'msg' =>'Bid has been submitted successfully' ); 
            return response()->json($response);
        }

        flash(translate('Bid limit has been reached'))->warning();
        $response = array('status' => false,'msg' =>'Bid limit has been reached' ); 
            return response()->json($response);
    }
}
