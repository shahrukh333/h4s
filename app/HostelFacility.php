<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HostelFacility extends Model
{
    /**
     * this method stores hostel facilities
     */
    public function storeHostelFacility($id, Request $request)
    {
        $facilities = new HostelFacility();
        $facilities->hostel_id = $id;
        $facilities->wifi = $request->input('wifi');
        $facilities->mess = $request->input('mess');
        $facilities->tv = $request->input('tv');
        $facilities->cctv_camera = $request->input('cctvCamera');
        $facilities->laundry = $request->input('laundry');
        $facilities->power_backup = $request->input('powerBackup');
        $facilities->daily_clean = $request->input('dailyClean');
        $facilities->iron = $request->input('iron');
        $facilities->geyser = $request->input('geyser');
        $facilities->refrigerator = $request->input('refrigerator');
        $facilities->parking = $request->input('parking');
        $facilities->other_1 = $request->input('other1');
        $facilities->other_2 = $request->input('other2');
        $facilities->save();
    }

    /**
     * this function updates the hostel facilities
     */
    public function updateHostelFacility(Request $request)
    {
        $facilities = HostelFacility::find($request->facilities['facilityId']);
        $facilities->wifi = $request->facilities['wifi'];
        $facilities->mess = $request->facilities['mess'];
        $facilities->tv = $request->facilities['tv'];
        $facilities->cctv_camera = $request->facilities['cctv'];
        $facilities->laundry = $request->facilities['laundry'];
        $facilities->power_backup = $request->facilities['powerBackup'];
        $facilities->daily_clean = $request->facilities['dailyClean'];
        $facilities->iron = $request->facilities['iron'];
        $facilities->geyser = $request->facilities['geyser'];
        $facilities->refrigerator = $request->facilities['refrigerator'];
        $facilities->parking = $request->facilities['parking'];
        $facilities->other_1 = $request->facilities['other1'];
        $facilities->other_2 = $request->facilities['other2'];
        $facilities->save();
    }

    /**
     * this function returns hostel facilities
     */
    public function getHostelFacilities($id)
    {
        $facilities = HostelFacility::where('hostel_id', $id)->get();
        return $facilities;
    }

    /**
     * this method returns a facility
     */
    public function getHostelFacility($id)
    {
        $facility = HostelFacility::find($id);
        return $facility;
    }

    /**
     * this function deletes hostel facilities
     */
    public function deleteHostelFacility($hostelId)
    {
        $facilities = HostelFacility::where('hostel_id', $hostelId)->get();
        if(count($facilities) > 0)
        {
            $facilities->first()->delete();
        }
    }

}
