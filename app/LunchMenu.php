<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LunchMenu extends Model
{
    /**
     * This method returns the lunch menu of a hostel
     */
    public function getLunchMenu($id)
    {
        $lunchMenu = LunchMenu::find($id);
        return $lunchMenu;
    }

    /**
     * This function saves the lunch menu
     * into the database
     */
    public function storeLunchMenu(Request $request)
    {
        $lunch = new LunchMenu();
        $lunch->monday = $request->lunchData['lMonday'];
        $lunch->tuesday = $request->lunchData['lTuesday'];
        $lunch->wednesday = $request->lunchData['lWednesday'];
        $lunch->thursday = $request->lunchData['lThursday'];
        $lunch->friday = $request->lunchData['lFriday'];
        $lunch->saturday = $request->lunchData['lSaturday'];
        $lunch->sunday = $request->lunchData['lSunday'];
        $lunch->save();
        return $lunch->id;
    }

     /**
     * This function updates the lunch menu
     * into the database
     */
    public function updateLunchMenu(Request $request)
    {
        $lunchId = $request->lunchData['lunchId'];
        $lunch = LunchMenu::find($lunchId);
        if($lunch != null)
        {
            $lunch->monday = $request->lunchData['lMonday'];
            $lunch->tuesday = $request->lunchData['lTuesday'];
            $lunch->wednesday = $request->lunchData['lWednesday'];
            $lunch->thursday = $request->lunchData['lThursday'];
            $lunch->friday = $request->lunchData['lFriday'];
            $lunch->saturday = $request->lunchData['lSaturday'];
            $lunch->sunday = $request->lunchData['lSunday'];
            $lunch->save();
        }
    }
}
