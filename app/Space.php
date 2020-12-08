<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HostelRoom;

class Space extends Model
{
    /**
     * this method returns user's space
     */
    public function getUserSpace($id)
    {
        $space = Space::where('hosteller_id', $id)->get();
        return $space;
    }

    /**
     * This function returns the space of a hostel
     */
    public function getHostelSpace($id)
    {
        $roomId = $id;
        $space = Space::where('room_id',$roomId)->get();
        return $space;
    }

    /**
     * This method removes person from a room
     */
    public function removeFromRoom($id)
    {
        $space = Space::where('hosteller_id', $id)->get();
        $roomId = $space->first()->room_id;
        $space->first()->delete();
        return $roomId;
    }

    /**
     * This method allocates space in the room
     */
    public function allocateSpace($roomId, $userId)
    {
        $space = new Space();
        $space->room_id = $roomId;
        $space->hosteller_id = $userId;
        $space->save();
    }

    /**
     * this method deletes user space
     */
    public function deleteUserSpace($id)
    {
        $room = new HostelRoom();
        $space = Space::where('hosteller_id', $id)->get();
        if(count($space) > 0)
        {
            if(count($space) > 1)
            {
                foreach($space as $sp)
                {
                    $room->decrementRoomOccupancy($sp->room_id);
                    $sp->delete();
                }
            }
            else
            {
                $room->decrementRoomOccupancy($space->first()->room_id);
                $space->first()->delete();
            }
        }
    }

    /**
     * this function deletes hostel room space
     */
    public function deleteRoomSpace($id)
    {
        $space = Space::where('room_id', $id)->get();
        if(count($space) > 0)
        {
            $space->first()->delete();
        }
    }
}
