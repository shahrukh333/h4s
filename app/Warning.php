<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warning extends Model
{
    /**
     * this method returns the warned hostels
     */
    public function getAllWarnedHostels()
    {
        $warnedHostels = Warning::all();
        return $warnedHostels;
    }

    /**
     * this method returns the hostel warning
     */
    public function getHostelWarning($id)
    {
        $warning = Warning::where('hostel_id', $id)->get();
        return $warning;
    }

    /**
     * this method stores the hostel warning
     */
    public function storeWarning($id)
    {
        $warn = new Warning();
        $warn->hostel_id = $id;
        $warn->save();
    }

    /**
     * this method removes hostel warning
     */
    public function removeWarning($id)
    {
        $warn = Warning::where('hostel_id', $id)->get();
        $warn->first()->delete();
    }
}
