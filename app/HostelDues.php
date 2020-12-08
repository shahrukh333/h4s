<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HostelDues extends Model
{
    /**
     * this method adds hosteller details into the database
     */
    public function addHostellerDues($hostelId, $hostellerId, $roomId, $roomRent)
    {
        $dues = new HostelDues();
        $dues->hostel_id = $hostelId;
        $dues->hosteller_id = $hostellerId;
        $dues->room_id = $roomId;
        $dues->payable = $roomRent;
        $dues->paid =0;
        $dues->pending = 0;
        $dues->previous_balance = 0;
        $dues->save();
    }

    /**
     * this function returns the hostel dues data
     */
    public function getHostelDuesData($id)
    {
        $dues = HostelDues::where('hostel_id', $id)->get();
        return $dues;
    }

    /**
     * this method returns dues of a hosteller
     */
    public function getHostellerDues($id)
    {
        $dues = HostelDues::find($id);
        return $dues;
    }

    /**
     * this method updates the hostel dues
     */
    public function updateDues(Request $request)
    {
        $dues = HostelDues::find($request->duesInfo['duesId']);
        if($dues->paid == 0)
        {
            if($request->duesInfo['paid'] < $dues->payable)
            {
                $remaining = $dues->payable - $request->duesInfo['paid'];
                $dues->paid = $request->duesInfo['paid'];
                $dues->pending = $remaining;
                $dues->save();
            }
            else
            {
                $dues->paid = $dues->payable;
                $dues->save();
            }
        }
        else
        {
            if($request->duesInfo['paid'] < $dues->pending)
            {
                $dues->paid = $dues->paid + $request->duesInfo['paid'];
                $dues->pending = $dues->payable - $dues->paid;
                $dues->save();
            }
            else
            {
                $dues->paid = $dues->paid + $dues->pending;
                $dues->pending = 0;
                $dues->save();
            }
        }
        return $dues->hosteller_id;
    }

    /**
     * this method retrns hosteller dues
     */
    public function getUserDues($id)
    {
        $dues = HostelDues::where('hosteller_id', $id)->get();
        return $dues;
    }

    /**
     * this method delete user dues data
     */
    public function deleteUserDues($hostelId, $userId)
    {
        $dues = HostelDues::where(['hostel_id' => $hostelId, 'hosteller_id' => $userId])->get();
        if(count($dues) > 0)
        {
            if(count($dues) > 1)
            {
                foreach($dues as $due)
                {
                    $due->delete();
                }
            }
            else
            {
                $dues->first()->delete();
            }
        }
    }

    /**
     * this method resets hosteller dues
     */
    public function resetDues($id)
    {
        $dues = HostelDues::find($id);
        if($dues != null)
        {
            if($dues->paid == 0)
            {
                $dues->previous_balance = $dues->previous_balance + $dues->payable;
                $dues->save();
            }
            else
            {
                $dues->previous_balance = $dues->previous_balance + $dues->pending;
                $dues->paid = 0;
                $dues->pending = 0;
                $dues->save();
            }
            /* else if($dues->paid < $dues->payable)
            {
                $remaining = $dues->payable - $dues->paid;
                $dues->previous_balance = $dues->previous_balance + $remaining;
                $dues->paid = 0;
                $dues->save();
            }
            else if($dues->paid == $dues->payable)
            {
                $dues->paid = 0;
                $dues->save();
            } */
        }
    }

    /**
     * this method returns room dues
     */
    public function getRoomDues($id)
    {
        $dues = HostelDues::where('room_id', $id)->get();
        return $dues;
    }

    /**
     * this method udpates the dues payable rent of room
     */
    public function updateDuesPayable($id, $rent)
    {
        $dues = HostelDues::find($id);
        if($dues != null)
        {
            $dues->payable = $rent;
            $dues->save();
        }
    }

    /**
     * this method adjusts the previous balance
     */
    public function adjustPreviousBalance(Request $request)
    {
        $dues = HostelDues::find($request->input('duesId'));
        if($dues != null)
        {
            if($request->input('previousMoney') < $dues->previous_balance)
            {
                $dues->previous_balance = $dues->previous_balance - $request->input('previousMoney');
                $dues->save();
            }
            else
            {
                $dues->previous_balance = 0;
                $dues->save();
            }
        }
    }

    /**
     * this method deletes hostel dues
     */
    public function deleteHostelDues($id)
    {
        $dues = HostelDues::find($id);
        if($dues != null)
        {
            $dues->delete();
        }
    }
}
