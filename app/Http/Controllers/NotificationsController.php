<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MessMenuController;
use Illuminate\Http\Request;
use App\Notification;
use App\QueryReply;
use App\Query;
use App\ComplaintReply;
use App\Complaint;
use App\MessMenu;
use App\BreakfastMenu;
use App\LunchMenu;
use App\DinnerMenu;
use App\HostlRule;
use App\HostelDues;
use Auth;

class NotificationsController extends Controller
{
    /**
     * This method returns a user notifications
     */
    public function myNotificationsCommit()
    {
        $notif = new Notification();
        $hostellerId = Auth::user()->id;
        $hostelId = session('hostelId');
        $notification = Notification::where(['hosteller_id' => $hostellerId, 'hostel_id' => $hostelId])->paginate(2);
        if(count($notification) < 1)
        {
            session(['notification' => false]);
        }  
        return view('pages.mynotification',['notification' => $notification]);
    }

    /**
     * this method returns the notification data
     */
    public function getNotificationDataCommit(Request $request)
    {
        return 'aqib';
        $type = $request->type;
        return type;
    }

    /**
     * this method returns the mess menu
     */
    public function getMyMessCommit($id)
    {
        $hostelId = session('hostelId');
        $messMenu = new MessMenu();
        $breakfastMenu = new BreakfastMenu();
        $lunchMenu = new LunchMenu();
        $dinnerMenu = new DinnerMenu();
        $notif = new Notification();
        $notif->deleteNotification(decrypt($id));

        return redirect()->action('MessMenuController@hostelMessMenuCommit');
    }

    /**
     * this method returns hostel rules
     */
    public function getMyRulesCommit($id)
    {
        $hostelId = session('hostelId');
        $notifId = decrypt($id);
        $rule = new HostlRule();
        $notif = new Notification();
        $hostelRules = $rule->getHostelRule($hostelId);
        /**
         * Deleting the notification
         */
        $notif->deleteNotification($notifId);

        return redirect()->action('RulesController@hostelRulesCommit');
    }

    /**
     * this method returns the query reply
     */
    public function getMyQueryCommit($id)
    {
        $notificationId = decrypt($id);
        $notif = new Notification();
        $queryReply = new QueryReply();
        $query = new Query();

        // getting the notification of the hosteller
        $notification = $notif->getNotification($notificationId);
        $queryReplyId = $notification->query_reply_id;

        // now getting the query reply
        $reply = $queryReply->getReply($queryReplyId);
        $myQuery = $query->getQuery($reply->query_id);
        $notif->deleteNotification($notificationId);

        return view('pages.notificationqueryreply',['myQuery' => $myQuery, 'reply' => $reply]);
    }

    /**
     * this function return the complaint replies
     */
    public function getMyComplaintCommit($id)
    {
        $notificationId = decrypt($id);
        $notif = new Notification();
        $comReply = new ComplaintReply();
        $com = new Complaint();

        // getting the notification of the hosteller
        $notification = $notif->getNotification($notificationId); 
        $complaintReplyId = $notification->complaint_reply_id;

        // now getting the complaint reply
        $reply = $comReply->getReply($complaintReplyId);
        $complaint = $com->getComplaint($reply->complaint_id);
        $notif->deleteNotification($notificationId);

        return view('pages.notificationcomplaintreply',['complaint' => $complaint, 'reply' => $reply]);
    }

    /**
     * this method returns hosteller dues notification
     */
    public function myDuesNotificationCommit($id)
    {
        $notifId = decrypt($id);
        $notif = new Notification();
        $dues = new HostelDues();
        $notif->deleteNotification($notifId);
        return redirect()->action('DuesController@myHostelDuesCommit');
    }
}
