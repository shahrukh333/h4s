<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostlRule;
use App\Booking;
use App\Notification;
use DB;
use App\User;

class RulesController extends Controller
{
    /**
     * this method returns the hostel rules
     */
    public function getHostelRules()
    {
        $hostelId = session('hostel')->id;
        $rule = new HostlRule();
        $hostelRules = $rule->getHostelRule($hostelId);
        if(count($hostelRules) > 0)
        {
            return view('pages.hostelrule',['hostelRules' => $hostelRules]);
        }
        else 
        {
            return view('pages.addhostelrule');
        }
    }

    /**
     * this method stores rules into the database
     */
    public function addHostelRulesCommit(Request $request)
    {
       // return $request->hostelRules['hostelId'];
        $rule = new HostlRule();
        $rule->storeRule($request);
    }

    /**
     * this method returns the edit hostel page
     */
    public function displayEditHostelRulesPage($id)
    {
        $ruleId = decrypt($id);
        $rule = new HostlRule();
        $rules = $rule->getRule($ruleId);
        return view('pages.edithostelrule', ['rules' => $rules]);
    }

    /**
     * this method updates the hostel rules
     */
    public function updateRulesCommit(Request $request)
    {
        $rule = new HostlRule();
        $hostelId = $rule->updateRule($request);

        /**
         * notifying the hostellres
         */
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
                    $notification->storeRuleNotification($hostelId, $hosteller->user_id);
                }
            }
            else
            {
                $notification->storeRuleNotification($hostelId, $hostellers->first()->user_id);
            }
        }
    }

    /**
     * This method returns hostel rules to the hosteller
     */
    public function hostelRulesCommit()
    {
        $hostelId = session('hostelId');
        $rule = new HostlRule();
        $hostelRules = $rule->getHostelRule($hostelId);
        return view('pages.showhostelrule',['hostelRules' => $hostelRules]);
    }

}
