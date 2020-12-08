<?php

namespace App\Http\Controllers;
use App\MessMenu;
use App\Hostel;
use App\BreakfastMenu;
use App\LunchMenu;
use App\DinnerMenu;
use App\Booking;
use App\Notification;
use App\User;
use DB;

use Illuminate\Http\Request;

class MessMenuController extends Controller
{
    /**
     * This function returns the hostel mess
     */
    public function getHostelMess()
    {
        $hostelId = session('hostel')->id;
        $messMenu = new MessMenu();
        $breakfastMenu = new BreakfastMenu();
        $lunchMenu = new LunchMenu();
        $dinnerMenu = new DinnerMenu();

        $mess = $messMenu->getHostelMess($hostelId);
        if(count($mess) > 0)
        {
            $breakfast = $breakfastMenu->getBreakfastMenu($mess->first()->breakfast_menu_id);
            $lunch = $lunchMenu->getLunchMenu($mess->first()->lunch_menu_id);
            $dinner = $dinnerMenu->getDinnerMenu($mess->first()->dinner_menu_id);
            return view('pages.messmenu',['mess' => $mess, 'breakfast' => $breakfast, 'lunch' => $lunch, 'dinner' => $dinner]);
        }
        else
        {
            return view('pages.addmessmenu');
        }

    }

    /**
     * This function passes the hostel breakfast data
     * to BreakfastMessMenu class after validation
     */
    public function addBreakfastMenuCommit(Request $request)
    {
        $messMenu = new MessMenu(); 
        $breakfast = new BreakfastMenu();
        $hostelId = session('hostel')->id;
        $hostelMess = $messMenu->getHostelMess($hostelId);
        if(count($hostelMess) > 0)
        {
            if($hostelMess->first()->breakfast_menu_id != null)
            {
                return 1;
            }
            else
            {
                $breakfastId = $breakfast->storeBreakfastMenu($request);
                $messMenu->addBreakfastMenu($hostelId, $breakfastId); 
            }
        }
        else
        {
            $breakfastId = $breakfast->storeBreakfastMenu($request);
            $messMenu->addBreakfastMenu($hostelId, $breakfastId);
        }
        
    }

    /**
     * This function returns the update
     * breakfast menu page
     */
    public function showEditBreakfastPage($id)
    {
        $breakfast = new BreakfastMenu();
        $breakfastId = decrypt($id);
        $breakfastMenu = $breakfast->getBreakfastMenu($breakfastId);
        return view('pages.editbreakfastmenu',['breakfastMenu' => $breakfastMenu]);
    }

    /**
     * this method edit the breakfast menu
     */
    public function updateBreakfastMenu(Request $request)
    {
        $breakfastMenu = new BreakfastMenu();
        $breakfastId = $breakfastMenu->updateBreakfastMenu($request);
        $hostelId = session('hostel')->id;
        return $this->notifyHostellers(1,$hostelId);
    }

    /**
     * This function passes the hostel lunch data
     * to lunchMenu class after validation
     */
    public function addLunchMenuCommit(Request $request)
    {
        $messMenu = new MessMenu(); 
        $lunch = new LunchMenu();
        $hostelId = session('hostel')->id;
        $hostelMess = $messMenu->getHostelMess($hostelId);
        if(count($hostelMess) > 0)
        {
            if($hostelMess->first()->lunch_menu_id != null)
            {
                return 1;
            }
            else
            {
                $lunchId = $lunch->storeLunchMenu($request);
                $messMenu->addLunchMenu($hostelId, $lunchId); 
            }
        }
        else
        {
            $lunchId = $lunch->storeLunchMenu($request);
            $messMenu->addLunchMenu($hostelId, $lunchId);
        }
    }

    /**
     * This function returns the update
     * lunch menu page
     */
    public function showEditLunchPage($id)
    {
        $lunch = new LunchMenu();
        $lunchId = decrypt($id);
        $lunchMenu = $lunch->getLunchMenu($lunchId);
        return view('pages.editlunchmenu',['lunchMenu' => $lunchMenu]);
    }

    /**
     * this method passes the arguments to the updateLunchMenu
     * method of LunchMenu class
     */
    public function updateLunchMenu(Request $request)
    {
        $lunchMenu = new LunchMenu();
        $lunchId = $lunchMenu->updateLunchMenu($request);
        $hostelId = session('hostel')->id;
        return $this->notifyHostellers(2,$hostelId);
    }

    /**
     * this method saves the dinner menu
     * and store dinner menu detials into the
     * mess menu
     */
    public function addDinnerMenuCommit(Request $request)
    {
        $messMenu = new MessMenu(); 
        $dinner = new DinnerMenu();
        $hostelId = session('hostel')->id;
        $hostelMess = $messMenu->getHostelMess($hostelId);
        if(count($hostelMess) > 0)
        {
            if($hostelMess->first()->dinner_menu_id != null)
            {
                return 1;
            }
            else
            {
                $dinnerId = $dinner->storeDinnerMenu($request);
                $messMenu->addDinnerMenu($hostelId, $dinnerId); 
            }
        }
        else
        {
            $dinnerId = $dinner->storeDinnerMenu($request);
            $messMenu->addDinnerMenu($hostelId, $dinnerId);
        }
    }

    /**
     * This function returns the update
     * dinner menu page
     */
    public function showEditDinnerPage($id)
    {
        $dinner = new DinnerMenu();
        $dinnerId = decrypt($id);
        $dinnerMenu = $dinner->getDinnerMenu($dinnerId);
        return view('pages.editdinnermenu',['dinnerMenu' => $dinnerMenu]);
    }

    /**
     * this method passes the arguments to the updateDinnerMenu
     * method of LunchMenu class
     */
    public function updateDinnerMenu(Request $request)
    {
        $dinnerMenu = new DinnerMenu();
        $dinnerMenu->updateDinnerMenu($request);
        $hostelId = session('hostel')->id;
        return $this->notifyHostellers(3,$hostelId);
    }

    /**
     * This method returns the addmessmenu page
     */
    public function addMessMenu()
    {
        return view('pages.addmessmenu');
    }

    /**
     * This method returns the edit breakfast page
     */
    public function viewEditBreakfastMenuPage()
    {
        return view('pages.editbreakfastmenu');
    }

    /**
     * This method returns the edit lunch page
     */
    public function viewEditLunchMenuPage()
    {
        return view('pages.editlunchmenu');
    }

    /**
     * This method returns the edit dinner page
     */
    public function viewEditDinnerMenuPage()
    {
        return view('pages.editdinnermenu');
    }

    /**
     * This method returns hostel mess menu to the hosteller
     */
    public function hostelMessMenuCommit()
    {
        $hostelId = session('hostelId');
        $messMenu = new MessMenu();
        $breakfastMenu = new BreakfastMenu();
        $lunchMenu = new LunchMenu();
        $dinnerMenu = new DinnerMenu();

        $mess = $messMenu->getHostelMess($hostelId);
        if(count($mess) > 0)
        {
            $breakfast = $breakfastMenu->getBreakfastMenu($mess->first()->breakfast_menu_id);
            $lunch = $lunchMenu->getLunchMenu($mess->first()->lunch_menu_id);
            $dinner = $dinnerMenu->getDinnerMenu($mess->first()->dinner_menu_id);
            return view('pages.showhostelmessmenu',['mess' => $mess, 'breakfast' => $breakfast, 'lunch' => $lunch, 'dinner' => $dinner]);
        }
        else
        {
            return view('pages.showhostelmessmenu',['mess' => $mess]);
        }
    }

    /**
     * this function notifies the hostellers
     */
    public function notifyHostellers($value, $hostelId)
    {
        $booking = new Booking();
        $hostellers = $booking->getHostellers($hostelId);
        //return $hostellers;

        if(count($hostellers) > 0)
        {
            $notification = new Notification();
            if(count($hostellers) > 1)
            {
                foreach($hostellers as $hosteller)
                {
                    $notification->storeMessMenuNotification($hostelId, $hosteller->user_id);
                }
            }
            else
            {
                $notification->storeMessMenuNotification($hostelId, $hostellers->first()->user_id);
            }
        }


        if($value == 1)
        {
            $breakfastMenu = null;
            return view('pages.editbreakfastmenu',['breakfastMenu' => $breakfastMenu]);
        }
        else if($value == 2)
        {
            $lunchMenu = null;
            return view('pages.editlunchmenu',['lunchMenu' => $lunchMenu]);
        }
        else if($value == 3)
        {
            $dinnerMenu = null;
            return view('pages.editdinnermenu',['dinnerMenu' => $dinnerMenu]);
        }
    }

}
