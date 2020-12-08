<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /**
     * this method returns the notification
     */
    public function getNotification($id)
    {
        $notification = Notification::find($id);
        return $notification;
    }

    /**
     * this method returns hosteller notification
     */
    public function getHostellerNotifications($hostellerId, $hostelId)
    {
        $notification = Notification::where(['hosteller_id' => $hostellerId, 'hostel_id' => $hostelId])->get();
        return $notification;
    }

    /**
     * this method stores mess menu notificaiton
     */
    public function storeMessMenuNotification($hostelId, $userId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->type = 'MessMenu';
        $notification->notification = 'Mess men is updated';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method stores rules notificaiton
     */
    public function storeRuleNotification($hostelId, $userId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->type = 'Rule';
        $notification->notification = 'Hostel rules are updated';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method deletes the notificaiton
     */
    public function deleteNotification($id)
    {
        $notif = Notification::find($id);
        $notif->delete();
    }

    /**
     * this method returns hostel notification
     */
    public function getHostelMessNotification($id)
    {
        $notification = Notification::where(['hostel_id' => $id, 'type' => 'MessMenu'])->get();
        return $notification();
    }

    /**
     * this method stores query reply notificaiton
     */
    public function storeQueryNotification($hostelId, $userId, $replyId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->query_reply_id = $replyId;
        $notification->type = 'Query';
        $notification->notification = 'Your query has been replied';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method stores complaint reply notificaiton
     */
    public function storeComplaintNotification($hostelId, $userId, $replyId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->complaint_reply_id = $replyId;
        $notification->type = 'Complaint';
        $notification->notification = 'Your complaint has been replied';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method saves dues notifications
     */
    public function storeDuesNotification($hostelId, $userId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->type = 'Dues';
        $notification->notification = 'Your dues have been adjusted';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method saves dues room rent notification
     */
    public function storeDuesChangeNotification($hostelId, $userId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->type = 'Dues';
        $notification->notification = 'Room rent has been updated';
        $notification->status = 'Pending';
        $notification->save();
    }


    /**
     * this method saves dues notifications
     */
    public function storeDuesDefaultNotification($hostelId, $userId)
    {
        $notification = new Notification();
        $notification->hostel_id = $hostelId;
        $notification->hosteller_id = $userId;
        $notification->type = 'Dues';
        $notification->notification = 'please clear your dues soon, thank you';
        $notification->status = 'Pending';
        $notification->save();
    }

    /**
     * this method returns complaint notificatoin of hosteller
     */
    public function getComplaintNotification($id)
    {
        $notification = Notification::where('complaint_reply_id', $id)->get();
        return $notification;
    }

    /**
     * this method returns query notification of hosteller
     */
    public function getQueryNotification($id)
    {
        $notification = Notification::where('query_reply_id', $id)->get();
        return $notification;
    }

    /**
     * this method deletes user notifications
     */
    public function deleteUserNotification($hostelId, $userId)
    {
        $notification = Notification::where(['hostel_id' => $hostelId, 'hosteller_id' => $userId])->get();
        if(count($notification) > 0)
        {
            if(count($notification) > 1)
            {
                foreach($notification as $notif)
                {
                    $notif->delete();
                }
            }
            else
            {
                $notification->first()->delete();
            }
        }
    }
}
