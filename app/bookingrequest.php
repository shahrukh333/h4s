<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bookingrequest extends Model
{
    /**
     * this method returns user booking requests
     */
    public function getUserBookingRequests($id)
    {
        $request = bookingrequest::where('user_id', $id)->get();
        return $request;
    }

    /**
     * This method returns the booking requests
     * of a hostel with a particular id
     */
    public static function getHostelBookingRequests($id)
    {
        return bookingrequest::where('hostel_id',$id)->get();
    }

    /**
     * This method returns the booking request of a user
     */
    public function getBookingRequest($id)
    {
        $request = bookingrequest::find($id);
        return $request;
    }

    /**
     * this method removes booking request
     */
    public function removeBookingRequest($id)
    {
        $request = bookingrequest::find($id);
        $request->delete();
    }

    /**
     * this method returns hostel booking requests
     */
    public function getHostelBookingRequest($id)
    {
        $request = bookingrequest::where('hostel_id', $id)->get();
        return $request;
    }

    /**
     * this method update booking request status
     */
    public function updateBookingRequestStatus($id)
    {
        $request = bookingrequest::find($id);
        $request->status = 'Read';
        $request->save();
    }

    /**
     * store cancel booking request
     */
    public function storeNewBookingRequest($userId, $hostelId, $checkin, $checkout)
    {
        $request = new bookingrequest();
        $request->hostel_id = $hostelId;
        $request->user_id = $userId;
        $request->type = "New Booking";
        $request->check_in = $checkin;
        $request->check_out = $checkout;
        $request->save();
    }


    /**
     * store cancel booking request
     */
    public function storeCancelBookingRequest($hostelId, $userId, $checkout)
    {
        $request = new bookingrequest();
        $request->hostel_id = $hostelId;
        $request->user_id = $userId;
        $request->type = "Cancel Hostel Booking";
        $request->check_out = $checkout;
        $request->save();
    }

    /**
     * this method stores hostel manager leave request
     */
    public function storeHostelManagerLeaveRequest($hostelId, $userId, $leaveDate)
    {
        $request = new bookingrequest();
        $request->hostel_id = $hostelId;
        $request->user_id = $userId;
        $request->type = "Leaving Manager Job";
        $request->check_out = $leaveDate;
        $request->save();
    }
}
