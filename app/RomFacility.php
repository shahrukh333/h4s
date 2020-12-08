<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RomFacility extends Model
{
    /*
    * this method stores room facilities into the database
    */
   public function storeFacility($id, Request $request)
   {
       $facility = new RomFacility();
       $facility->room_id = $id;
       $facility->ac = $request->roomFacilities['ac'];
       $facility->fan = $request->roomFacilities['fan'];
       $facility->wardrobe = $request->roomFacilities['wardrobe'];
       $facility->attach_washroom = $request->roomFacilities['washroom'];
       $facility->ventilation = $request->roomFacilities['ventilation'];
       $facility->other_1 = $request->roomFacilities['other1'];
       $facility->other_2 = $request->roomFacilities['other2'];
       $facility->save();
   }

   /**
    * this function udpates the room facilities
    */
    public function updateRoomFacility(Request $request)
    {
        $facility = RomFacility::find($request->roomFacilities['facId']);
        $facility->ac = $request->roomFacilities['ac'];
        $facility->fan = $request->roomFacilities['fan'];
        $facility->wardrobe = $request->roomFacilities['wardrobe'];
        $facility->attach_washroom = $request->roomFacilities['washroom'];
        $facility->ventilation = $request->roomFacilities['ventilation'];
        $facility->other_1 = $request->roomFacilities['other1'];
        $facility->other_2 = $request->roomFacilities['other2'];
        $facility->save();
    }

   /**
    * this method returns room facility
    */
    public function getRoomFacility($id)
    {
        $facility = RomFacility::where('room_id', $id)->get();
        return $facility;
    }

    /**
     * this method deletes hostel facility
     */
    public function deleteFacility($id)
    {
        $facility = RomFacility::where('room_id', $id)->get();
        $facility->first()->delete();
    }
}
