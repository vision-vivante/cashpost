<?php

namespace App\Http\Controllers;

use App\Utility\NotificationUtility;
use Illuminate\Http\Request;
use App\Models\Notification;
use Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_listing()
    {

        NotificationUtility::make_my_notifications_seen();
        $notifications = NotificationUtility::get_my_notifications(10,false,0,true);

        return view('admin.default.notifications',compact('notifications'));
    }

    public function frontend_listing()
    {
        NotificationUtility::make_my_notifications_seen();
        $notifications = NotificationUtility::get_my_notifications(5,false,0,true);

        return view('frontend.default.user.notifications',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public static function update_notification($id)
    {
       // dd($id);
        
            $panel = '';
            if (isClient()) {
                $panel = 'client';
            } else if (isFreelancer()) {
                $panel = 'freelancer';
            } else if (!isClient() && !isFreelancer()) {
                $panel = 'admin';
            }
            if (!Auth::check()) {
                return false;
            }

            $notifications_query = Notification::where('receiver_id', Auth::user()->id)->where('id', '=', $id);

            //dd($notifications_query);
            $notifications_query->where('seen_by_receiver', 0);

            if ($panel == 'admin') {
                $notifications_query->orWhere('showing_panel', $panel);
            }
            $notifications_query->update(['seen_by_receiver' => 1]);
        
             $data = Notification::where('receiver_id', Auth::user()->id)->where('id', '=', $id)->first();

        return collect([
           'status' => true,
           'data' => $data
        ]);

    }
}
