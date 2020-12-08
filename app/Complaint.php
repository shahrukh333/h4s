<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\ComplaintReply;
use App\Complaint;

class Complaint extends Model
{
    /**
     * This method returns the complaints
     * of a hostel with a particular id
     */
    public static function getComplaint($id)
    {
        $complaint = Complaint::find($id);
        return $complaint;
    }

    /**
     * This method update the complaint
     */
    public function updateComplaintStatus($id)
    {
        $complaint = Complaint::find($id);
        $complaint->status = 'Read';
        $complaint->save();
    }
 
    /**
     * this method store complaint
     */
    public function storeComplaint(Request $request)
    {
        $complaint = new Complaint();
        $complaint->hostel_id = $request->myComplaint['hostelId'];
        $complaint->hosteller_id = $request->myComplaint['userId'];
        $complaint->body = $request->myComplaint['complaint'];
        $complaint->status = 'Pending';
        $complaint->save();
    }

    /**
     * This method returns the complaints of a hosteller
     */
    public function getHostellerComplaints($id)
    {
        $complaints = Complaint::where('hosteller_id', $id)->get();
        return $complaints;
    }

    /**
     * this method updates the hosteller complaint and 
     * store the complaint into the database
     */
    public function updateComplaint(Request $request)
    {
        $complaint = Complaint::find($request->myComplaint['complaintId']);
        $complaint->body = $request->myComplaint['complaint'];
        $complaint->save();
    }

    /**
     * This method deletes hosteller complaint
     */
    public function deleteComplaint($id)
    {
        $complaint = Complaint::find($id);
        $complaint->delete();
    }

    /**
     * this function returns hostel complaints
     */
    public function getHostelComplaint($id)
    {
        $complaint = Complaint::where(['hostel_id' => $id, 'status' => 'Pending'])->get();
        return $complaint;
    }

    /**
     * this method delets user complaints
     */
    public function deleteUserComplaint($hostelId, $userId)
    {
        $complaint = Complaint::where(['hostel_id' => $hostelId, 'hosteller_id' => $userId])->get();
        if(count($complaint) > 0)
        {
            if(count($complaint) > 1)
            {
                foreach($complaint as $com)
                {
                    // getting the complaint reply
                    $reply = ComplaintReply::where('complaint_id', $com->id)->get();
                    if(count($reply) > 0)
                    {
                        // deleting the complaint reply
                        $reply->first()->delete();
                    }
                    $com->delete();
                }
            }
            else
            {
                // getting the complaint reply
                $reply = ComplaintReply::where('complaint_id', $complaint->first()->id)->get();
                if(count($reply) > 0)
                {
                    // deleting the complaint reply
                    $reply->first()->delete();
                }
                $complaint->first()->delete();
            }
        }
    }

    /**
     * this function returns hostel with complaint greater than zero
     */
    public function getHostelComplaintCount($id)
    {
        $count = Complaint::where(['hostel_id' => $id, 'status' => 'Pending'])->count();
        return $count;
    }
    
}
