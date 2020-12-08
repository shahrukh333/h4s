<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BreakfastMenu extends Model
{
    /**
     * This method returns the menu of a hostel
     */
    public function getBreakfastMenu($id)
    {
        $breakfastMenu = BreakfastMenu::find($id);
        return $breakfastMenu;
    }

    /**
     * This function saves the breakfast menu
     * into the database
     */
    public function storeBreakfastMenu(Request $request)
    {
        $breakfast = new BreakfastMenu();
        $breakfast->monday = $request->breakfastData['bMonday'];
        $breakfast->tuesday = $request->breakfastData['bTuesday'];
        $breakfast->wednesday = $request->breakfastData['bWednesday'];
        $breakfast->thursday = $request->breakfastData['bThursday'];
        $breakfast->friday = $request->breakfastData['bFriday'];
        $breakfast->saturday = $request->breakfastData['bSaturday'];
        $breakfast->sunday = $request->breakfastData['bSunday'];
        $breakfast->save();
        return $breakfast->id;
    }

    /**
     * this method updates the breakfast menu
     */
    public function updateBreakfastMenu(Request $request)
    {
        $breakfast = BreakfastMenu::find($request->breakfastData['breakfastId']);
        if($breakfast != null)
        {
            $breakfast->monday = $request->breakfastData['bMonday'];
            $breakfast->tuesday = $request->breakfastData['bTuesday'];
            $breakfast->wednesday = $request->breakfastData['bWednesday'];
            $breakfast->thursday = $request->breakfastData['bThursday'];
            $breakfast->friday = $request->breakfastData['bFriday'];
            $breakfast->saturday = $request->breakfastData['bSaturday'];
            $breakfast->sunday = $request->breakfastData['bSunday'];
            $breakfast->save();
        }
    }
}
