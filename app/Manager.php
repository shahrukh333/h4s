<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Manager extends Model
{
    /**
     * This method returns the hostel manager
     */
    public function getHostelManager($id)
    {
        $manager = Manager::where('hostel_id', $id)->get();
        return $manager;
    }

    /**
     * this function adds hostel manager
     */
    public function addHostelManager($hoselId, $userId)
    {
        $manager = new Manager();
        $manager->user_id = $userId;
        $manager->hostel_id = $hoselId;
        $manager->save();
    }

    /**
     * This method removes the hostel manager
     */
    public function removeManager($id)
    {
        $manager = Manager::where('user_id', $id)->get();
        if(count($manager) > 0)
        {
            $manager->first()->delete();
        }
    }

    /**
     * this method returns hostel manager 
     */
    public function getManager($id)
    {
        $manager = Manager::where('user_id',$id)->get();
        return $manager;
    }

    /**
     * this method returns hostel manager of a hostel with a specific id
     */
    public function getHostelManagerCommit($hostelId, $userId)
    {
        $manager = Manager::where(['hostel_id' => $hostelId, 'user_id' => $userId])->first();
        return $manager;
    }

    /**
     * this method removes hostel manager
     */
    public function removeHostelManager($id, $userId)
    {
        $man = Manager::where(['hostel_id' => $id, 'user_id' => $userId])->get();
        if(count($man) > 0)
        {
            if(count($man) > 1)
            {
                foreach($man as $m)
                {
                    $m->delete();
                }
            }
            else
            {
                $man->first()->delete();
            }
        }
    }
}
