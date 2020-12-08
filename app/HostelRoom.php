<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class HostelRoom extends Model
{
    /**
     * This function returns rooms of a particular hostel
     */
    public function getRooms($hostel_id)
    {
        $rooms = HostelRoom::where('hostel_id',$hostel_id)->get();
        return $rooms;
    }

    /**
     * This method returns room of a hostel
     */
    public function getRoom($id)
    {
        $room = HostelRoom::find($id);
        return $room;
    }

    /**
     * This methods add hostel room into the database
     */
    public function addRoom(Request $request)
    {
        $room = new HostelRoom();
        $room->hostel_id = $request->roomData['hostelId'];
        $room->capacity = $request->roomData['capacity'];
        $room->room_no = $request->roomData['roomNo'];
        $room->occupied = 0;
        $room->rent = $request->roomData['rent'];
        $room->save();
        return $room->id;
    }

    /**
     * this method udpates room capacity
     */
    public function updateRoomOccupancy($id)
    {
        $room = HostelRoom::find($id);
        $room->occupied = $room->occupied + 1;
        $room->save();
    }

    /**
     * this method decrements room occupancy
     */
    public function decrementRoomOccupancy($roomId)
    {
        $room = HostelRoom::find($roomId);
        $room->occupied = $room->occupied - 1;
        $room->save();
    }

    /**
     * this method update the room details
     */
    public function updateRoom(Request $request)
    {
        $room = HostelRoom::find($request->roomId);
        $room->rent = $request->rent;
        $room->capacity = $request->capacity;
        $room->save();
    }

    /**
     * this method deletes hostel room
     */
    public function deleteRoom($id)
    {
        $room = HostelRoom::find($id);
        $room->delete();
    }

    /**
     * this method returns hostel room price
     */
    public function getRoomRent($id)
    {
        $room = HostelRoom::find($id);
        return $room->rent;
    }

    /**
     * this method returns rooms for hosteller shifting
     */
    public function getHostelShiftRooms($id)
    {
        $rooms = DB::table('hostel_rooms')->where('hostel_id', $id)->where('occupied', '<', DB::raw('capacity'))->get();
        return $rooms;
    }

    /**
     * this method returns hostel room no
     */
    public function getRoomNo($id)
    {
        $room = HostelRoom::find($id);
        return $room->room_no;
    }
}
