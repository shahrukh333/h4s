<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    /**
     * this method stores hostel
     */
    public function storeHostel($userId)
    {
        $hostel = new Hostel();
        $hostel->user_id = $userId;
        $hostel->status = 'Unblocked';
        $hostel->save();
        return $hostel->id;
    }

    /**
     * this function deletes hostel
     */
    public function deleteHostel($id)
    {
        $hostel = Hostel::find($id);
        $hostel->delete();
    }

    /**
     * This method returns all the hostels
     */
    public function getAllhostels()
    {
        $hostels = Hostel::all();
        return $hostels;
    }

    /**
     * This method returns the hostel with a specific id
     */
    public function getHostel($id)
    {
        $hostel = Hostel::find($id);
        return $hostel;
    }

    /**
     * this method returns user hostel
     */
    public function getUserHostel($id)
    {
        $hostel = Hostel::where('user_id',$id)->get();
        return $hostel;
    }

    /**
     * this method returns the blocked hostels
     */
    public function getBlockedHostels()
    {
        $hostels = Hostel::where('status', 'Blocked')->get();
        return $hostels;
    }

    /**
     * this method unblocks hostel
     */
    public function unblockHostel($id)
    {
        $hostel = Hostel::find($id);
        $hostel->status = 'Unblock';
        $hostel->save();
        return $hostel->user_id;
    }

    /**
     * this method blocks hostel
     */
    public function blockHostel($id)
    {
        $hostel = Hostel::find($id);
        $hostel->status = 'Blocked';
        $hostel->save();
    }
}
