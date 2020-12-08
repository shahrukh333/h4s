<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelRoom;
use App\HostelDues;
use App\RomFacility;
use App\Booking;
use App\HostelInformation;
use App\Notification;
use Redirect;
use App\Space;
use App\User;
use Mail;
use App\Mail\SendMail;

class RoomSpaceFacilityController extends Controller
{
    /**
     * This function returns the rooms of a hostel
     */
    public function hostelRoomCommit()
    {
        $hostel_id = session('hostel')->id;
        $room = new HostelRoom();
        $rooms = $room->getRooms($hostel_id);
        return view('pages.room',['rooms' => $rooms]);
    }

    /**
     * this method returns room to the page
     */
    public function getHostelRoom($id)
    {
        $roomId = decrypt($id);
        $rm = new HostelRoom();
        $rf = new RomFacility();
        $space = new Space();
        $data = "";
        $room = $rm->getRoom($roomId);
        $facilities = $rf->getRoomFacility($roomId);
        $residants = $space->getHostelSpace($roomId);
        if(count($residants) > 0)
        {
            if(count($residants) > 1)
            {
                foreach($residants as $hosteller)
                {
                    $user = User::find($hosteller->hosteller_id);
                    $data .= "<tr>";
                    $data .= "<td>".$user->name."</td>";
                    $data .= "<td>".$user->email."</td>";
                    $data .= "<td>";
                    $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("removeRoomate/".encrypt($hosteller->hosteller_id))."'>Remove Hosteller<i class='fa fa-trash fa-lg ml-2'></i></a>";
                    $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("shiftHosteller/".encrypt($hosteller->hosteller_id)."/".encrypt($roomId))."'>Shift Hosteller<i class='fa fa-share fa-lg ml-2'></i></a>";
                    $data .= "</td>";
                    $data .= "</tr>";
                }
            }
            else
            {
                $user = User::find($residants->first()->hosteller_id);
                $data .= "<tr>";
                $data .= "<td>".$user->name."</td>";
                $data .= "<td>".$user->email."</td>";
                $data .= "<td>";
                $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("removeRoomate/".encrypt($residants->first()->hosteller_id))."'>Remove Hosteller<i class='fa fa-trash fa-lg ml-2'></i></a>";
                $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("shiftHosteller/".encrypt($residants->first()->hosteller_id)."/".encrypt($roomId))."'>Shift Hosteller<i class='fa fa-share fa-lg ml-2'></i></a>";
                $data .= "</td>";
                $data .= "</tr>";
            }
        }
        return view('pages.manageroom',['room' => $room, 'data' => $data, 'facilities' => $facilities]);
    }

    /**
     * this method updates the room facilities and room informations
     */
    public function updateRoomDetailCommit(Request $request)
    {
        $fac = new RomFacility();
        $room = new HostelRoom();
        $dues = new HostelDues();
        $notif = new Notification();
        $space = new Space();
        $hostelId = session('hostel')->id;
        $fac->updateRoomFacility($request);
        //return $request->capacity;
        $room->updateRoom($request); 

        // get hostellers
        $spaces = $space->getHostelSpace($request->roomId);
        if(count($spaces) > 0)
        {
            if(count($spaces) > 1)
            {
                foreach($space as $sp)
                {
                    // notifying the hosteller about the change
                    $notif->storeDuesChangeNotification($hostelId, $sp->hosteller_id);
                }
            }
            else
            {   
                //notifying the hosteller about the change
                $notif->storeDuesChangeNotification($hostelId, $spaces->first()->hosteller_id);
            }
        }

        $hostelDues = $dues->getRoomDues($request->roomId);
        if(count($hostelDues) > 0)
        {
            if(count($hostelDues) > 1)
            {
                foreach($hostelDues as $due)
                {
                    $dues->updateDuesPayable($due->id, $request->rent);
                }
            }
            else
            {
                $dues->updateDuesPayable($hostelDues->first()->id, $request->rent);
            }
        }
    }

    /**
     * This method add room into the database
     */
    public function addHostelRoom(Request $request)
    {
        $room = new HostelRoom();
        $fac = new RomFacility();
        $info = new HostelInformation();
        $hostelId = session('hostel')->id;
        $information = $info->getHostelInformation($hostelId);

        $rooms = $room->getRooms($request->roomData['hostelId']);
        if(count($rooms) > 0)
        {
            if(count($rooms) > 1)
            {
                foreach($rooms as $rm)
                {
                    if($rm->room_no == $request->roomData['roomNo'])
                    {
                        return 'exist';
                    }
                }
            }
            else
            {
                if($rooms->first()->room_no == $request->roomData['roomNo'])
                {
                    return 'exist';
                }
            }
        }
        if(count($information) > 0)
        {
            if($request->roomData['rent'] > $information->first()->hostel_rent)
            {
                return 'rent';
            }
        }
        $roomId = $room->addRoom($request);
        $fac->storeFacility($roomId, $request);
        return 'success';
    // now storing the room facilities into the database
    }

    /**
     * this function removes a roomate from a room
     */
    public function removeRoomate($id)
    {
        $hostellerId = decrypt($id);
        $space = new Space();
        $room = new HostelRoom();
        $due = new HostelDues();
        $book = new Booking();

        $dues = $due->getUserDues($hostellerId); 
        if(count($dues) > 0)
        {
            if($dues->first()->previous_balance > 0)
            {
                return redirect()->back()->with('success', 'Sorry! the hosteller seems to have pending dues, therefore unable to remove hosteller'); 
            }
            else
            {
                $roomId = $space->removeFromRoom($hostellerId);
                // decrementing room occupancy
                $room->decrementRoomOccupancy($roomId);
                // deleting the dues data
                $due->deleteUserDues(session('hostel')->id, $hostellerId);
                // deleting the space data
                $booking = $book->getUserBooking($hostellerId);
                if(count($booking) > 0)
                {
                    $book->deleteBooking($booking->first()->id);
                }
                return back();
            }
        }
        
    }

    /**
     * this function returns the shift hosteller page
     */
    public function shiftHostellerCommit($id, $rmId)
    {
        $roomId = decrypt($rmId);
        $hostellerId = decrypt($id);
        $hostel_id = session('hostel')->id;
        $room = new HostelRoom();
        // getting the room number
        $roomNo = $room->getRoomNo($roomId);
        // getting the available rooms
        $rooms = $room->getHostelShiftRooms($hostel_id);
        if(count($rooms) <= 0)
        {
            return redirect()->back()->with('success', 'Oops! unable to shift room. It seems no space is available in the hostel'); 
        }
        return view('pages.shifthostellerroom',['rooms' => $rooms, 'hostellerId' => $hostellerId, 'roomId' => $roomId, 'roomNo' => $roomNo]);
    }

    /**
     * this function shifts the hosteller room
     */
    public function changeHostellerRoomCommit($rId, $hId)
    {
        $roomId = decrypt($rId);
        $hostellerId = decrypt($hId);
        $space = new Space();
        $rooms = new HostelRoom();
        $rf = new RomFacility();
        
        $perviousRoomId = $space->removeFromRoom($hostellerId);
        $rooms->decrementRoomOccupancy($perviousRoomId);
       
        // now shifting the hosteller into a new room
        $space->allocateSpace($roomId, $hostellerId);
        $rooms->updateRoomOccupancy($roomId);

        // sending email
        $emailData = array(
            'to' => User::find($hostellerId)->email,
            'subject' => 'Hostel Room Shift',
            'body' => 'Your hostel room has been shifted'
        );
        $this->sendEmail($emailData);

        // now returning to the old room page
        return \Redirect::route('getRoom', ['id' => encrypt($perviousRoomId)]);
    }

    /**
     * this method removes hostel room
     */
    public function removeHostelRoomCommit(Request $request)
    {
        $roomId = $request->roomId;
        $room = new HostelRoom();
        $space = new Space();
        $spaces = $space->getHostelSpace($roomId);
        if(count($spaces) > 0)
        {
            return 1;
        }
        else
        {
            $facility = new RomFacility();
            // deleting room
            $room->deleteRoom($roomId);
            // deleting facility
            $facility->deleteFacility($roomId);
            // redirecting the room page
            return 0;
        }
    }

    /**
     * this method sends email
     */
    public function sendEmail($data)
    {
        Mail::to($data['to'])->send(new SendMail($data));
    }
}
