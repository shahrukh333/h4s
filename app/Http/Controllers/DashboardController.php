<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hostel;
use App\Review;
use App\bookingrequest;
use App\HostelInformation;
use App\Notification;
use App\Booking;
use App\Query;
use App\Complaint;
use App\Manager;
use App\Warning;
use App\HostelRoom;
use App\Space;
use App\User;
use Auth;
use Mail;
use App\Mail\SendMail;

class DashboardController extends Controller
{ 
    /**
     * This function returns all the informations of a hostel when the owner
     * or hostel manager opens the page
     */
    public function myHostelCommit($id)
    {
        $hostel_id = decrypt($id);
        $hos = new Hostel();
        $book = new Booking();
        $com = new Complaint();
        $rev = new Review();
        $man = new Manager();
        $room = new HostelRoom();
        $space = new Space();
        $que = new Query();
        $bReq = new bookingrequest();
        $info = new HostelInformation();
        $data = "";

        $hostel = $hos->getHostel($hostel_id);
        $manager = Manager::where('hostel_id',$hostel_id)->get();
        $reviews = $rev->getHostelReview($hostel_id);
        $complaints = $com->getHostelComplaint($hostel_id);
        $bookingRequests = $bReq->getHostelBookingRequest($hostel_id);
        $queries = $que->getHostelQueries($hostel_id);
        $information = $info->getHostelInformation($hostel->id);
        $mn = $man->getHostelManagerCommit($hostel_id, Auth::user()->id);

        if($mn != null)
        {
            session(['isManager' => true]);
        }
        else
        {
            session(['isManager' => false]);
        }

        if(count($information) > 0)
        {
            session(['hostelName' => $information->first()->hostel_name]);
        }
        else
        {
            session(['hostelName' => 'Unknown Hostel']);
        }

        if(count($reviews) > 0)
        {
            session(['review' => true]);
        }
        else
        {
            session(['review' => false]);   
        }

        if(count($complaints) > 0)
        {
            session(['complaint' => true]);
        }
        else
        {
            session(['complaint' => false]);   
        }

        if(count($bookingRequests) > 0)
        {
            session(['bookingRequest' => true]);
        }
        else
        {
            session(['bookingRequest' => false]);    
        }

        if(count($queries) > 0)
        {
            session(['query' => true]);
        }
        else
        {
            session(['query' => false]);   
        }
        if(count($manager) > 0)
        {
            session(['manager' => true]);
        }
        else
        {
            session(['manager' => false]);   
        }


        // getting the booking
        $bookings = $book->getHostellers($hostel_id);
        if(count($bookings) > 0)
        {
            if(count($bookings) > 1)
            {
                foreach($bookings as $booking)
                {
                    // getting the users space
                    $sp = $space->getUserSpace($booking->user_id);
                    // getting the room
                    if(count($sp) > 0)
                    {
                        $rm = $room->getRoom($sp->first()->room_id);
                    }
                    $user = User::find($booking->user_id);
                    $data .= "<tr>";
                    $data .= "<td>".$user->name."</td>";
                    $data .= "<td>".$user->email."</td>";
                    if(count($sp) > 0)
                    {
                        $data .= "<td>".$rm->room_no."</td>";
                    }
                    else
                    {
                        $data .="<td>Unknown</td>";
                    }
                    $data .= "<td>".$booking->check_in."</td>";
                    $data .= "<td>".$booking->check_out."</td>";
                    $data .= "</tr>";
                }
            }
            else
            {
                // getting the users space
                $sp = $space->getUserSpace($bookings->first()->user_id);
                // getting the room
                if(count($sp) > 0)
                {
                    $rm = $room->getRoom($sp->first()->room_id);
                }
                $user = User::find($bookings->first()->user_id);
                $data .= "<tr>";
                $data .= "<td>".$user->name."</td>";
                $data .= "<td>".$user->email."</td>";
                if(count($sp) > 0)
                {
                    $data .= "<td>".$rm->room_no."</td>";
                }
                else
                {
                    $data .="<td>Unknown</td>";
                }
                $data .= "<td>".$bookings->first()->check_in."</td>";
                $data .= "<td>".$bookings->first()->check_out."</td>";
                $data .= "</tr>";
            }
        }

        session(['hostel' => $hostel]);
        return view('pages.hostel', ['data' => $data]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Contracts\Support\Renderable
 */
public function index()
{
    $hostl = new Hostel();
    $com = new Complaint();
    if(Auth::user()->type == 'A')
    {
        $warn = new Warning();
        // getting the blocked hostels
        $blockedHostels = $hostl->getBlockedHostels();
        // getting warnined hostels
        $warningHostel = $warn->getAllWarnedHostels();
        // getting all the hostels
        $hostel = $hostl->getAllhostels();
        $found = false;
        if(count($hostel) > 0)
        {
            if(count($hostel) > 1)
            {
                foreach($hostel as $host)
                {
                    $complaints = $com->getHostelComplaintCount($host->id);
                    if($complaints > 0)
                    {
                        if($host->status != 'Blocked')
                        {
                            $warning = $warn->getHostelWarning($host->id);
                            if(count($warning) <= 0)
                            {
                                $found = true;
                                break;
                            }
                        }
                    }
                }
            }
            else
            {
                $complaints = $com->getHostelComplaintCount($hostel->first()->id);
                if($complaints > 0)
                {
                    if($hostel->first()->status != 'Blocked')
                    {
                        $warning = $warn->getHostelWarning($hostel->first()->id);
                        if(count($warning) <= 0)
                        {
                            $found = true;
                        }
                    }
                }
            }
        }
        
        if($found)
        {
            session(['complainedHostel' => true]);
        }
        else
        {
            session(['complainedHostel' => false]);
        }

        if(count($blockedHostels) > 0)
        {
            session(['blockedHostel' => true]);
        }
        else
        {
            session(['blockedHostel' => false]);   
        }

        if(count($warningHostel) > 0)
        {
            session(['warnedHostel' => true]);
        }
        else
        {
            session(['warnedHostel' => false]);   
        }
        return view('dashboard');
    }
    else 
    {
        $book = new Booking();
        $hostelInfo = new HostelInformation();
        $com = new Complaint();
        $rev = new Review();
        $que = new Query();
        $man = new Manager();
        $bReq = new bookingrequest();
        $userId=Auth::user()->id; 
        $data = "";
        $path = "";

        // clearing the session variables
        if(session()->has('hostelName'))
        {
            session()->forget('hostelName');
        }

        if(session()->has('reviews'))
        {
            session()->forget('reviews');
        }

        if(session()->has('complaint'))
        {
            session()->forget('complaint');
        }

        if(session()->has('bookingRequest'))
        {
            session()->forget('bookingRequest');
        }

        if(session()->has('query'))
        {
            session()->forget('query');
        }

        if(session()->has('hostel'))
        {
            session()->forget('hostel');
        }

        if(session()->has('manager'))
        {
            session()->forget('manager');
        }

        if(session()->has('hostelId'))
        {
            session()->forget('hostelId');
        }

        if(session()->has('bookingId'))
        {
            session()->forget('bookingId');
        }

        // getting the booking
        $booking = $book->getUserBooking($userId);
        if(count($booking) > 0)
        {
            $notif = new Notification();
            $hostlId = $booking->first()->hostel_id;
            $notification = $notif->getHostellerNotifications($userId, $hostlId);

            if(count($notification) > 0)
            {
                session(['bookingNotification' => true]);
            }
            else
            {
                session(['bookingNotification' => false]);
            }
            session(['booking' => true]);
        }
        else
        {
            session(['booking' => false]);
        }

        $hostel = $hostl->getUserHostel($userId);
        
        if(count($hostel) > 0) 
        {
            if(count($hostel) > 1)
            {
                foreach($hostel as $host)
                {
                    $path = "";
                    $info = $hostelInfo->getHostelInformation($host->id);
                    $requests = $bReq->getHostelBookingRequest($host->id);
                    $complaint = $com->getHostelComplaint($host->id);
                    $review = $rev->getHostelReview($host->id);
                    $query = $que->getHostelQueries($host->id);
                    
                    $directory = public_path().'/graphics/hostel'.($host->id);
                    if(is_dir($directory))
                    {
                        $dh = opendir($directory);
                        while (false !== ($fileName = readdir($dh))) 
                        {
                            if (is_file($directory."/".$fileName))
                            {
                                $path = "/graphics/hostel".$host->id."/".$fileName;
                                break;
                            }
                        }
                        closedir($dh);
                    }
                    $data .= "<div class='col-md-4 col-sm-12'>";
                    $data .= "<a href='".url("myHostel/".encrypt($host->id))."'>";
                    if($path != "")
                    {
                        $data .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                    }
                    else
                    {
                        $path = "/graphics/defaulthostelimage.jpg";
                        $data .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                    }
                    $data .= "<h4 class='pt-4 text-center text-primary'><span class='badge badge-secondary'>".$info->first()->hostel_name."</span></h4>";
                    $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Complaints<span class='bg-danger rounded pr-2 pl-2'>".count($complaint)."</span></span></p>";
                    $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Requests<span class='bg-danger rounded pr-2 pl-2'>".count($requests)."</span></span></p>";
                    $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Reviews <span class='bg-danger rounded pr-2 pl-2'>".count($review)."</span></span></p>";
                    $data .= "<p class='text-center text-light pb-5'><span class='bg-secondary rounded pl-1'>Queries <span class='bg-danger rounded pr-2 pl-2'>".count($query)."</span></span></p>";
                    $data .= "</div>";
                    $data .= "</a>";
                    $data .= "</div>";
                }
            }
            else
            {
                $info = $hostelInfo->getHostelInformation($hostel->first()->id);
                $requests = $bReq->getHostelBookingRequest($hostel->first()->id);
                $complaint = $com->getHostelComplaint($hostel->first()->id);
                $review = $rev->getHostelReview($hostel->first()->id);
                $query = $que->getHostelQueries($hostel->first()->id);

                $directory = public_path().'/graphics/hostel'.($hostel->first()->id);
                if(is_dir($directory))
                {
                    $dh = opendir($directory);
                    while (false !== ($fileName = readdir($dh))) 
                    {
                        if (is_file($directory."/".$fileName))
                        {
                            $path = "/graphics/hostel".$hostel->first()->id."/".$fileName;
                            break;
                        }
                    }
                    closedir($dh);
                }
                $data .= "<div class='col-md-4 col-sm-12'>";
                $data .= "<a style='color:black;' href='".url("myHostel/".encrypt($hostel->first()->id))."'>";
                if($path != "")
                {
                    $data .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                }
                else
                {
                    $path = "/graphics/defaulthostelimage.jpg";
                    $data .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                }
                $data .= "<h4 class='pt-4 text-center text-primary'><span class='badge badge-secondary'>".$info->first()->hostel_name."</span></h4>";
                $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Complaints<span class='bg-danger rounded pr-2 pl-2'>".count($complaint)."</span></span></p>";
                $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Requests<span class='bg-danger rounded pr-2 pl-2'>".count($requests)."</span></span></p>";
                $data .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Reviews <span class='bg-danger rounded pr-2 pl-2'>".count($review)."</span></span></p>";
                $data .= "<p class='text-center text-light pb-5'><span class='bg-secondary rounded pl-1'>Queries <span class='bg-danger rounded pr-2 pl-2'>".count($query)."</span></span></p>";
                $data .= "</div>";
                $data .= "</a>";
                $data .= "</div>";
            }
        }
        // if the user is serving as a hostel manager
        $manager = $man->getManager($userId);
        $data2 = "";
        if(count($manager) > 0)
        {
            if(count($manager) > 1)
            {
                foreach($manager as $man)
                {
                    $hostelId = $man->hostel_id;
                    $info = $hostelInfo->getHostelInformation($hostelId);
                    $requests = $bReq->getHostelBookingRequest($hostelId);
                    $complaint = $com->getHostelComplaint($hostelId);
                    $review = $rev->getHostelReview($hostelId);
                    $query = $que->getHostelQueries($hostelId);

                    $directory = public_path().'/graphics/hostel'.($hostelId);
                    if(is_dir($directory))
                    {
                        $dh = opendir($directory);
                        while (false !== ($fileName = readdir($dh))) 
                        {
                            if (is_file($directory."/".$fileName))
                            {
                                $path = "/graphics/hostel".$hostelId."/".$fileName;
                                break;
                            }
                        }
                        closedir($dh);
                    }
                    $data2 .= "<div class='col-md-4 col-sm-12'>";
                    $data2 .= "<a style='color:black;' href='".url("myHostel/".encrypt($hostelId))."'>";
                    if($path != "")
                    {
                        $data2 .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                    }
                    else
                    {
                        $path = "/graphics/defaulthostelimage.jpg";
                        $data2 .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                    }

                    $data2 .= "<h4 class='pt-4 text-center text-primary'><span class='badge badge-secondary'>".$info->first()->hostel_name."</span></h4>";
                    $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Complaints<span class='bg-danger rounded pr-2 pl-2'>".count($complaint)."</span></span></p>";
                    $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Requests<span class='bg-danger rounded pr-2 pl-2'>".count($requests)."</span></span></p>";
                    $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Reviews <span class='bg-danger rounded pr-2 pl-2'>".count($review)."</span></span></p>";
                    $data2 .= "<p class='text-center text-light pb-5'><span class='bg-secondary rounded pl-1'>Queries <span class='bg-danger rounded pr-2 pl-2'>".count($query)."</span></span></p>";
                    $data2 .= "</div>";
                    $data2 .= "</a>";
                    $data2 .= "</div>";
                }
            }
            else
            {
                $hostelId = $manager->first()->hostel_id;
                $hostel = $hostl->getHostel($hostelId);
                
                $info = $hostelInfo->getHostelInformation($hostel->id);
                $requests = $bReq->getHostelBookingRequest($hostel->id);
                $complaint = $com->getHostelComplaint($hostel->id);
                $review = $rev->getHostelReview($hostel->id);
                $query = $que->getHostelQueries($hostel->id);

                $directory = public_path().'/graphics/hostel'.($hostel->id);
                if(is_dir($directory))
                {
                    $dh = opendir($directory);
                    while (false !== ($fileName = readdir($dh))) 
                    {
                        if (is_file($directory."/".$fileName))
                        {
                            $path = "/graphics/hostel".$hostel->id."/".$fileName;
                            break;
                        }
                    }
                    closedir($dh);
                }
                $data2 .= "<div class='col-md-4 col-sm-12'>";
                $data2 .= "<a style='color:black;' href='".url("myHostel/".encrypt($hostel->id))."'>";
                if($path != "")
                {
                    $data2 .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                }
                else
                {
                    $path = "/graphics/defaulthostelimage.jpg";
                    $data2 .= "<div class='w-100 rounded shadow mt-4 float-left' style = 'background-image: url(".url($path)."); background-size: cover'>";
                }

                $data2 .= "<h4 class='pt-4 text-center text-primary'><span class='badge badge-secondary'>".$info->first()->hostel_name."</span></h4>";
                $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Complaints<span class='bg-danger rounded pr-2 pl-2'>".count($complaint)."</span></span></p>";
                $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Requests<span class='bg-danger rounded pr-2 pl-2'>".count($requests)."</span></span></p>";
                $data2 .= "<p class='text-center text-light'><span class='bg-secondary rounded pl-1'>Reviews <span class='bg-danger rounded pr-2 pl-2'>".count($review)."</span></span></p>";
                $data2 .= "<p class='text-center text-light pb-5'><span class='bg-secondary rounded pl-1'>Queries <span class='bg-danger rounded pr-2 pl-2'>".count($query)."</span></span></p>";
                $data2 .= "</div>";
                $data2 .= "</a>";
                $data2 .= "</div>";
            }
        }
        return view('dashboard', ['data' => $data, 'data2' => $data2]);
    }
}


    public function sendEmail($data)
    {
        Mail::to($data['to'])->send(new SendMail($data));
    }
    
}
