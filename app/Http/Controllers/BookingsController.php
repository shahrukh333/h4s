<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelRoom;
use App\Space;
use App\Query;
use App\QueryReply;
use App\Booking;
use App\bookingrequest;
use App\Notification;
use App\HostelDues;
use App\Hostel;
use App\Complaint;
use App\HostelInformation;
use App\User;
use Mail;
use App\Mail\SendMail;
use Auth;

class BookingsController extends Controller
{
    /**
     * This method displays the bookingrequest page
     */
    public function viewBookingRequests()
    {
        $hostelId = session('hostel')->id;
        $bReq = new bookingrequest();
        $data = "";

        $bookingRequests = $bReq->getHostelBookingRequest($hostelId);

        if(count($bookingRequests) > 0)
        {
            if(count($bookingRequests) > 1)
            {
                foreach($bookingRequests as $request)
                {
                    $user = User::find($request->user_id);
                    $data .= "<tr>";
                    $data .= "<td>".$user->name."</td>";
                    $data .= "<td>".$user->email."</td>";
                    $data .= "<td>".$request->type."</td>"; 
                    if($request->check_in != null)
                    {
                        $data .= "<td>".$request->check_in."</td>";
                    }       
                    else
                    {
                        $data .= "<td>No time</td>";
                    }
                    $data .= "<td>".$request->check_out."</td>";
                    $data .= "<td>";
                    if($request->type == 'New Booking')
                    {
                        $data .= "<a class='btn btn-primary mt-1' href='".url("acceptRequest/".encrypt($request->id))."'>Accept<i class='fa fa-user-plus fa-lg ml-2'></i></a>";
                        $data .= "<a class='btn btn-primary ml-1 mt-1 pr-4' href='".url("deleteBookingRequest/".encrypt($request->id))."'>Reject<i class='fa fa-trash fa-lg ml-2'></i></a>";
                    }
                    else if($request->type == "Leaving Manager Job")
                    {
                        if(!session('isManager'))
                        {
                            $data .= "<a class='btn btn-primary ml-1 pr-4' href='".url("approveHostelManagerLeave/".encrypt($request->id))."'>Accept Request<i class='fa fa-trash fa-lg ml-2'></i></a>";
                        }
                        else 
                        {
                            $data .= 'You Cannot Respond';
                        }
                    }
                    else
                    {
                        $data .= "<a class='btn btn-primary ml-1 pr-5 pl-4' href='".url("cancelBookingRequest/".encrypt($request->id))."'>Accept Request<i class='fa fa-trash fa-lg ml-2'></i></a>";
                    }
                    $data .= "</td>";
                    $data .= "</tr>";
                }
            }
            else
            {
                $user = User::find($bookingRequests->first()->user_id);
                $data .= "<tr>";
                $data .= "<td>".$user->name."</td>";
                $data .= "<td>".$user->email."</td>";
                $data .= "<td>".$bookingRequests->first()->type."</td>";
                if($bookingRequests->first()->check_in != null)
                {
                    $data .= "<td>".$bookingRequests->first()->check_in."</td>";
                }
                else
                {
                    $data .= "<td>No time</td>";
                }
                $data .= "<td>".$bookingRequests->first()->check_out."</td>";
                $data .= "<td>";
                if($bookingRequests->first()->type == "New Booking")
                {
                    $data .= "<a class='btn btn-primary mt-1' href='".url("acceptRequest/".encrypt($bookingRequests->first()->id))."'>Accept<i class='fa fa-user-plus fa-lg ml-2'></i></a>";
                    $data .= "<a class='btn btn-primary ml-1 mt-1 pr-4' href='".url("deleteBookingRequest/".encrypt($bookingRequests->first()->id))."'>Reject<i class='fa fa-trash fa-lg ml-2'></i></a>";
                }
                else if($bookingRequests->first()->type == "Leaving Manager Job")
                {
                    if(!session('isManager'))
                    {
                        $data .= "<a class='btn btn-primary ml-1 pr-4' href='".url("approveHostelManagerLeave/".encrypt($bookingRequests->first()->id))."'>Accept Request<i class='fa fa-trash fa-lg ml-2'></i></a>";
                    }
                    else 
                    {
                        $data .= 'You Cannot Respond';
                    }
                }
                else
                {
                    $data .= "<a class='btn btn-primary ml-1 pr-4' href='".url("cancelBookingRequest/".encrypt($bookingRequests->first()->id))."'>Accept Request<i class='fa fa-trash fa-lg ml-2'></i></a>";
                }
                $data .= "</td>";
                $data .= "</tr>";
            }
        }
        else
        {
            session(['bookingRequest' => false]);
        }
        
        return view('pages.bookingrequest',['data' => $data]);
    }

    /**
     * This function returns the accept booking request page
     */
    public function viewAcceptBookingRequestPage($id)
    {
        $requestId = decrypt($id);
        $hostel_id = session('hostel')->id;
        $room = new HostelRoom();
        $req = new bookingrequest();
        $request = $req->getBookingRequest($requestId);
        $rooms = $room->getHostelShiftRooms($hostel_id);
        return view('pages.acceptbookingrequest',['rooms' => $rooms, 'request' => $request]);
    }

    /**
     * this method adds hosteller into the room
     */
    public function addHostellerCommit($rmId, $rqId)
    {
        $roomId = decrypt($rmId);
        $requestId = decrypt($rqId);
        $hostelId = session('hostel')->id;
        $bRequest = new bookingrequest();
        $dues = new HostelDues();
        $space = new Space();
        $room = new HostelRoom();
        $book = new Booking();
        $data = "";

        // getting the user id from the booking requst table
        $booking = $bRequest->getBookingRequest($requestId); 
        $space->allocateSpace($roomId, $booking->user_id);
        $room->updateRoomOccupancy($roomId);
        // deleting the booking request
        $bRequest->removeBookingRequest($requestId);
        // storing the booking data
        $book->storeBooking($booking->user_id, $hostelId,$booking->check_in, $booking->check_out);
        // getting the room rent
        $roomRent = $room->getRoomRent($roomId);
        
        // storing the sutdent information into the student dues table
        $dues->addHostellerDues($hostelId, $booking->user_id, $roomId, $roomRent);

        $bookings = $book->getHostellers($hostelId);
        if(count($bookings) > 0)
        {
            if(count($bookings) > 1)
            {
                foreach($bookings as $booking)
                {
                    $user = User::find($booking->user_id);
                    $data .= "<tr>";
                    $data .= "<td>".$user->name."</td>";
                    $data .= "<td>".$user->email."</td>";
                    $data .= "<td>".$booking->check_in."</td>";
                    $data .= "<td>".$booking->check_out."</td>";
                    $data .= "</tr>";
                }
            }
            else
            {
                $user = User::find($bookings->first()->user_id);
                $data .= "<tr>";
                $data .= "<td>".$user->name."</td>";
                $data .= "<td>".$user->email."</td>";
                $data .= "<td>".$bookings->first()->check_in."</td>";
                $data .= "<td>".$bookings->first()->check_out."</td>";
                $data .= "</tr>";
            }
        }

        // checking if users has other booking request or not
        $userBookingRequests = $bRequest->getUserBookingRequests($booking->user_id);
        if(count($userBookingRequests) > 0)
        {
            if(count($userBookingRequests) > 1)
            {
                foreach($userBookingRequests as $userReq)
                {
                    // removing booking requests
                    $bRequest->removeBookingRequest($userReq->id);
                }
            }
            else
            {
                // removing booking requests
                $bRequest->removeBookingRequest($userBookingRequests->first()->id);
            }
        }

        $emailData = array(
            'to' => User::find($booking->user_id)->email,
            'subject' => 'Booking Request',
            'body' => 'Your booking request is accepted, you can check in'
        );
        $this->sendEmail($emailData);
        return view('pages.hostel', ['data' => $data]);
    }

    /**
     * this function returns my booking page
     */
    public function myBookingCommit()
    {
        $userId = Auth::user()->id;
        $bk = new Booking();
        $info = new HostelInformation;
        $host = new Hostel();
        $notifications = new Notification();
        $book = $bk->getUserBooking($userId);

        if(count($book) > 0)
        {
            $hostelId = $book->first()->hostel_id;
            $hostel = $host->getHostel($hostelId);
            $information = $info->getHostelInformation($hostel->id);
            $hostelName = $information->first()->hostel_name;
            $notif = $notifications->getHostellerNotifications($userId, $book->first()->hostel_id);
            if(count($notif) > 0)
            {
                $notification = true;
            }
            else
            {
                $notification = false;
            }

            $bookingId = $book->first()->id;
            if(session()->has('bookingNotification'))
            {
                session()->forget('bookingNotification');
            }
            
            session(['hostelId' => $book->first()->hostel_id, 'bookingId' => $bookingId, 'notification' => $notification]);
            return view('pages.booking', ['book' => $book, 'hostelName' => $hostelName]);

        }
        else
        {
            return back();
        }
        
    }

    /**
     * this function returns the my booking page
     */
    public function bookingCommit()
    {
        $userId = Auth::user()->id;
        $book = new Booking();
        $host = new Hostel();
        $hostelInfo = new HostelInformation();
        $booking = $book->getUserBooking($userId);
        if(count($booking) > 0)
        {
            $hostelId = $booking->first()->hostel_id;
            $hostel = $host->getHostel($hostelId);
            $information = $hostelInfo->getHostelInformation($hostel->id);
            $hostelName = $information->first()->hostel_name;
            return view('pages.managemybooking', ['booking' => $booking, 'hostelName' => $hostelName]);
        }
        else
        {
            return back();
        }
    }

    /**
     * this method updates the hosteller booking
     */
    public function updateBookingCommit(Request $request)
    {
        $book = new Booking();
        $userId = Auth::user()->id;
        $book->updateBooking($userId, $request);
    }

    /**
     * this method deletes booking request
     */
    public function deleteBookingRequest($id)
    {
        $requestId = decrypt($id);
        $book = new bookingrequest();
        $book->removeBookingRequest($requestId);
        return back();
    }

    /**
     * this method cancels hosteller booking
     */
    public function cancelBookingCommit(Request $request)
    {
        $booking = new Booking();
        $hostelDues = new HostelDues();
        $book = new bookingrequest();
        $userId = Auth::user()->id;
        $checkout = $request->checkout;

        $userBooking = $booking->getUserBooking($userId);
        // getting hosteller dues
        $hostellerDues = $hostelDues->getUserDues($userId);
        if(count($userBooking) > 0)
        {
            if(count($hostellerDues) > 0)
            {
                if(($hostellerDues->first()->previous_balance > 0) || ($hostellerDues->first()->pending > 0))
                {
                    return '<div class="alert alert-success ml-3 mt-5" role="alert"><p>Please clear your dues first</p></div>';
                }
                else
                {
                    $book->storeCancelBookingRequest($userBooking->first()->hostel_id, $userId, $checkout);
                    return '<div class="alert alert-success ml-3 mt-5" role="alert"><p>Request is succesfully sent to the hostel manager</p></div>';
                }
            }
            else
            {
                $book->storeCancelBookingRequest($userBooking->first()->hostel_id, $userId, $checkout);
                return '<div class="alert alert-success ml-3 mt-5" role="alert"><p>Request is succesfully sent to the hostel manager</p></div>';
            }
        }
        else
        {
            return '<div class="alert alert-success ml-3 mt-5" role="alert"><p>You have no dues data</p></div>';
        }
    }

    /**
     * this method cancels the hosteller request
     */
    public function cancelBookingRequestCommit($id)
    {
        $requestId = decrypt($id);
        $request = new bookingrequest();
        $book = new Booking();
        $dues = new HostelDues();
        $complaint = new Complaint();
        $query = new Query();
        $notif = new Notification();
        $space = new Space();
        $bookingRequest = $request->getBookingRequest($requestId);
        $userId = $bookingRequest->user_id;

        if($bookingRequest != null)
        {
            $hostelId = $bookingRequest->hostel_id;
            // removing booking request
            $request->removeBookingRequest($requestId);
            // removing user booking data
            $book->deleteUserBooking($hostelId, $userId);
            //removing user complaints
            $complaint->deleteUserComplaint($hostelId, $userId);
            //removing user queries
            $query->deleteUserQuery($hostelId, $userId);
            //removing notification
            $notif->deleteUserNotification($hostelId, $userId);
            // removing user space
            $space->deleteUserSpace($userId);
            // removing user dues data
            $dues->deleteUserDues($hostelId, $userId);
            return redirect()->back()->with('success', 'User booking is successfully removed');
        }
        else
        {
            return back();
        }
    }

    /**
     * this method returns hostel room status
     */
    public function getRoomStatusCommit(Request $request)
    {
        $room = new HostelRoom();
        $hostelId = session('hostel')->id;
        $rooms = $room->getRooms($hostelId);
        $data = "";
        if(count($rooms) > 0)
        {
            $data .= '<table class="table table-bordered mt-2">';
            $data .= '<thead>';
            $data .= '<tr>';
            $data .= '<th>Room</th>';
            $data .= '<th>Capacity</th>';
            $data .= '<th>Occupied</th>';
            $data .= '<th>Available</th>';
            $data .= '</tr>';
            $data .= '</thead>';
            $data .= '<tbody>';
            
            if(count($rooms) > 1)
            {
                foreach($rooms as $rm)
                {
                    $data .= '<tr>';
                    $data .= '<td>Room No '.$rm->room_no.'</td>';
                    $data .= '<td>'.$rm->capacity.' seats</td>';
                    $data .= '<td>'.$rm->occupied.' seats</td>';
                    $ocpd = $rm->capacity - $rm->occupied;
                    $data .= '<td>'.$ocpd.' seats</td>';
                    $data .= '</tr>';
                }
            }
            else
            {
                $data .= '<tr>';
                $data .= '<td>Room No '.$rooms->first()->room_no.'</td>';
                $data .= '<td>'.$rooms->first()->capacity.' seats</td>';
                $data .= '<td>'.$rooms->first()->occupied.' seats</td>';
                $ocpd = $rooms->first()->capacity - $rooms->first()->occupied;
                $data .= '<td>'.$ocpd.' seats</td>';
                $data .= '</tr>';
            }
            $data .= '</tbody>';
            $data .= '</table>';
            return $data;
        }
        else
        {
            return 'Not found';
        }
    }

    /**
     * this method sends email
     */
    public function sendEmail($data)
    {
        Mail::to($data['to'])->send(new SendMail($data));
    }

    /**
     * this method book hostel
     */
    public function bookHostelCommit(Request $request)
    {
        $book = new Booking();
        $req = new bookingrequest();
        $hostel = new Hostel();
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        if(($checkin != "") && ($checkout != ""))
        {
            if($checkin > $checkout)
            {
                return redirect()->back()->with('success', 'Invalid check in check out dates');
            }
            else
            {
                if(Auth::check())
                {
                    $bk = $book->getUserBooking(Auth::user()->id);
                    if(count($bk) > 0)
                    {
                        return redirect()->back()->with('success', 'You have already booked a hostel, please cancel that booking first for new booking');
                    }
                    else
                    {
                        $req->storeNewBookingRequest(Auth::user()->id, $request->input('hostelId'), $checkin, $checkout);
                        return redirect()->back()->with('success', 'Your booking request is successfully sent, and will be responded soon, We will get you email notification as soon as the action is performed');
                    }
                }
                else
                {
                    return redirect()->back()->with('success', 'Please login to continue');
                }
            }
        }
        else
        {
            return redirect()->back()->with('success', 'Please enter check in or check out dates');
        }
    }
}
