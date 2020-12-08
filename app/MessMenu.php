<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessMenu extends Model
{
    /**
     * This method returns the mess menu of a hostel
     */
    public function getHostelMess($id)
    {
        $messMenu = MessMenu::where('hostel_id',$id)->get();
        return $messMenu;
    }

    /**
     * This method add hostel mess menu
     */
    public function addHostelMess($hostelId, $breakfastId, $lunchId, $dinnerId)
    {
        $menu = new HostelMenu();
        $menu->hostel_id = $hostelId;
        $mess->breakfast_menu_id = $breakfastId;
        $mess->lunch_menu_id = $lunchId;
        $mess->dinner_menu_id = $dinnerId;
        $mess->save();
    }

    /**
     * This method saves the breakfast mess
     */
    public function addBreakfastMenu($hostelId, $breakfastId)
    {
        $mess = MessMenu::where('hostel_id',$hostelId)->get();
        if(count($mess) > 0)
        {
            $mess->first()->breakfast_menu_id = $breakfastId;
            $mess->first()->save();
        }
        else
        {
            $menu = new MessMenu();
            $menu->hostel_id = $hostelId;
            $menu->breakfast_menu_id = $breakfastId;
            $menu->save();
        }
    }

    /**
     * This method saves the lunch menu
     */
    public function addLunchMenu($hostelId, $lunchId)
    {
        $mess = MessMenu::where('hostel_id',$hostelId)->get();
        if(count($mess) > 0)
        {
            $mess->first()->lunch_menu_id = $lunchId;
            $mess->first()->save();
        }
        else
        {
            $menu = new MessMenu();
            $menu->hostel_id = $hostelId;
            $menu->lunch_menu_id = $lunchId;
            $menu->save();
        }

    }

    /**
     * This method saves the dinner menu
     */
    public function addDinnerMenu($hostelId, $dinnerId)
    {
        $mess = MessMenu::where('hostel_id',$hostelId)->get();
        if(count($mess) > 0)
        {
            $mess->first()->dinner_menu_id = $dinnerId;
            $mess->first()->save();
        }
        else
        {
            $menu = new MessMenu();
            $menu->hostel_id = $hostelId;
            $menu->dinner_menu_id = $dinnerId;
            $menu->save();
        }

    }

    /**
     * This method updates the breakfast mess
     */
    public function updateBreakfastMenu($hostelId, $breakfastId)
    {
        $breakfastMess = new MessMenu();
        $breakfastMess->hostel_id = $hostelId;
        $breakfastMess->breakfast_menu_id = $breakfastId;
        $breakfastMess->save();
    }

    /**
     * this function returns the hostel id
     */
    public function getHostelIdBreakfast($id)
    {
        $mess = MessMenu::where('breakfast_menu_id', $id)->get();
        return $mess->first()->hostel_id;
    }

    /**
     * this function returns the hostel id
     */
    public function getHostelIdLunch($id)
    {
        $mess = MessMenu::where('lunch_menu_id', $id)->get();
        return $mess->first()->hostel_id;
    }

    /**
     * this function returns the hostel id
     */
    public function getHostelIdDinner($id)
    {
        $mess = MessMenu::where('dinner_menu_id', $id)->get();
        return $mess->first()->hostel_id;
    }

}
