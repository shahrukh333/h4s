<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DinnerMenu extends Model
{
    /**
     * This method returns the dinner of a hostel
     */
    public function getDinnerMenu($id)
    {
        $dinnerMenu = DinnerMenu::find($id);
        return $dinnerMenu;
    }

    /**
     * This method store the dinner menu
     * into the database
     */
    public function storeDinnerMenu(Request $request)
    {
        $dinner = new DinnerMenu();
        $dinner->monday = $request->dinnerData['dMonday'];
        $dinner->tuesday = $request->dinnerData['dTuesday'];
        $dinner->wednesday = $request->dinnerData['dWednesday'];
        $dinner->thursday = $request->dinnerData['dThursday'];
        $dinner->friday = $request->dinnerData['dFriday'];
        $dinner->saturday = $request->dinnerData['dSaturday'];
        $dinner->sunday = $request->dinnerData['dSunday'];
        $dinner->save();
        return $dinner->id;
    }

    /**
     * This method updates the dinner menu
     * into the database
     */
    public function updateDinnerMenu(Request $request)
    {
        $dinner = DinnerMenu::find($request->dinnerData['dinnerId']);
        if($dinner != null)
        {
            $dinner->monday = $request->dinnerData['dMonday'];
            $dinner->tuesday = $request->dinnerData['dTuesday'];
            $dinner->wednesday = $request->dinnerData['dWednesday'];
            $dinner->thursday = $request->dinnerData['dThursday'];
            $dinner->friday = $request->dinnerData['dFriday'];
            $dinner->saturday = $request->dinnerData['dSaturday'];
            $dinner->sunday = $request->dinnerData['dSunday'];
            $dinner->save();
        }
    }
}
