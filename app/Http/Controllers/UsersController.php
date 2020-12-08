<?php

namespace App\Http\Controllers;
Use App\User;
use App\Manager;
use App\Booking;
use App\Hostel;
use App\HostelRoom;
use App\Space;
use App\HostelDues;
use App\bookingrequest;
use App\HostelInformation;
Use DB;
use Auth;
use Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * This function updates the existing users
     */
    public function updateUsernameCommit(Request $request)
    {
        $userId = Auth::user()->id;
        $user=User::find($userId);
        $user->name = $request->name;
        $user->save();
    }

    /**
     * this method updates the user password
     */
    public function updatePasswordCommit(Request $request)
    {
        $userId = Auth::user()->id;
        $user=User::find($userId);
        $user->password = Hash::make($request->password);
        $user->save();
    }


    /**
      * This method registers the hostel manager
      */
      public function registerManagerCommit(Request $request)
      {
        $user = new User();
        $manager = new Manager();
        $hostelId = session('hostel')->id;
        $found = false;
        if($request->userData['email'] == Auth::user()->email)
        {
            return 'hostelOwner';
        }
        // getting the user
        $man = $manager->getHostelManager($hostelId);
        if(count($man) > 0)
        {
            if(count($man) > 1)
            {
                foreach($man as $m)
                {
                    $us = User::find($m->user_id);
                    if($us != null)
                    {
                        if($us->email == $request->userData['email'])
                        {
                            $found = true;
                            break;
                        }
                    }
                }
            }
            else
            {
                $us = User::find($man->first()->user_id);
                if($us != null)
                {
                    if($us->email == $request->userData['email'])
                    {
                        $found = true;
                    }
                }
            }
        }
        
        if(!$found)
        {
           $user = User::where('email', $request->userData['email'])->get();
           if(count($user) > 0)
           {
                // now registering the manager
                $manager->addHostelManager($hostelId, $user->first()->id);
                // sending email
                $emailData = array(
                    'to' => $user->first()->email,
                    'subject' => 'Hostel Manager',
                    'body' => 'You have been added as hostel manager. Your password is '.$request->userData['password']
                );
                $this->sendEmail($emailData);
                return 'userExist';
           }
           else
           {
                $user = new User();
                $user->name = $request->userData['name'];
                $user->email = $request->userData['email'];
                $user->type = $request->userData['type'];
                $user->password = Hash::make($request->userData['password']);
                $user->save();
                // now registering the manager
                $manager->addHostelManager($hostelId, $user->id);
                // sending email
                $emailData = array(
                    'to' => $request->userData['email'],
                    'subject' => 'Hostel Manager',
                    'body' => 'You have been added as hostel manager. Your password is '.$request->userData['password']
                );
                $this->sendEmail($emailData);
                return 'registered';
           }
        }
        else
        {
            return 'exist';
        }

      }

      /**
       * this method add the hosteller
       */
      public function addHostellerCommit(Request $request)
      {
          $hostelId = session('hostel')->id;
          $booking = new Booking();
          $room = new HostelRoom();
          $info = new HostelInformation();
          $space = new Space();
          $dues = new HostelDues();
          $found = false;
          
          $bookings = $booking->getHostellers($hostelId);
          if(count($bookings) > 0)
          {
            if(count($bookings) > 1)
            {
                foreach($bookings as $book)
                {
                    $user = User::find($book->user_id);
                    if($user != null)
                    {
                        if($user->email == $request->userData['email'])
                        {
                            $found = true;
                            break;
                        }
                    }
                }
            }
            else
            {
                $user = User::find($bookings->first()->user_id);
                if($user != null)
                {
                    if($user->email == $request->userData['email'])
                    {
                        $found = true;
                    }
                }
            }
          }

        if(!$found)
        {
            $user = User::where('email', $request->userData['email'])->get();
            if(count($user) > 0)
            {
                // now booking the hostel
                $booking->storeBooking($user->first()->id, $hostelId, $request->userData['checkout'], $request->userData['checkout']);
                $rm = $room->getRoom($request->userData['roomId']);
                if($rm != null)
                {
                    if($rm->capacity > $rm->occupied)
                    {
                        // allocating space to user
                        $space->allocateSpace($rm->id, $user->first()->id);
                        // updating the occupancy of the room
                        $room->updateRoomOccupancy($rm->id);
                        // adding to the dues table
                        $dues->addHostellerDues($hostelId, $user->first()->id, $rm->id, $rm->rent);
                        // sending email
                        $emailData = array(
                            'to' => $request->userData['email'],
                            'subject' => 'Booking',
                            'body' => 'You are registered with the hostel'
                        );
                        $this->sendEmail($emailData);
                    }
                }
                return 'regUser';
            }
            else
            {
                $user = new User();
                $user->name = $request->userData['name'];
                $user->email = $request->userData['email'];
                $user->type = 'U';
                $user->password = Hash::make($request->userData['password']);
                $user->save();
                $userId = $user->id;
                // now booking the hostel
                $booking->storeBooking($userId, $hostelId, $request->userData['checkout'], $request->userData['checkout']);
                $rm = $room->getRoom($request->userData['roomId']);
                if($rm != null)
                {
                    if($rm->capacity > $rm->occupied)
                    {
                        // allocating space to user
                        $space->allocateSpace($rm->id, $userId);
                        // updating the occupancy of the room
                        $room->updateRoomOccupancy($rm->id);
                        // adding to the dues table
                        $dues->addHostellerDues($hostelId, $userId, $rm->id, $rm->rent);
                        // sending email
                        $emailData = array(
                            'to' => $request->userData['email'],
                            'subject' => 'Booking',
                            'body' => 'You are registered with the hostel'
                        );
                        $this->sendEmail($emailData);
                    }
                }
                return 'registered';
            }
        }
        else
        {
            return 'userExist';
        }
      }

      /**
       * This function returns the hostel manager
       */
      public function getManagerCommit()
      {
         $hostelId = session('hostel')->id;
         $man = new Manager();
         $manager = $man->getHostelManager($hostelId);
         $data = "";
         if(count($manager) > 0)
         {
             if(count($manager) > 1)
             {
                 foreach($manager as $mngr)
                 {
                    $user = User::find($mngr->user_id);
                    $data .= "<tr>";
                    $data .= "<td>".$user->name."</td>";
                    $data .= "<td>".$user->email."</td>";
                    $data .= "<td><button class='btn btn-primary' onclick='showHostelManagerDeleteAlert(".$user->id.")'>Remove Manager<i class='fa fa-trash fa-lg ml-2'></i></button></td>";
                    $data .= "</tr>";
                 }
                 
             }
             else
            {
                $user = User::find($manager->first()->user_id);
                $data .= "<tr>";
                $data .= "<td>".$user->name."</td>";
                $data .= "<td>".$user->email."</td>";
                $data .= "<td><button class='btn btn-primary' onclick='showHostelManagerDeleteAlert(".$user->id.")'>Remove Manager<i class='fa fa-trash fa-lg ml-2'></i></button></td>";
                $data .= "</tr>";
            }
            return view('pages.hostelmanager',['data' => $data]);
         }
         else
         {
            return view('pages.addhostelmanager'); 
         }
      }

      /**
       * this method returns add hostel manager page
       */
      public function addHostelManagerCommit()
      {
          return view('pages.addhostelmanager');
      }

      /**
       * this method removes the hostel manager
       */
      public function removeHostelManagerCommit($id)
      {
        $managerId = $id;
        $manager = new Manager();
        $hostelId = session('hostel')->id;
        // removing manger from the manager table
        $manager->removeManager($managerId);
        // removing manager from the user table
        $user = User::find($managerId);
        $man = $manager->getHostelManager($hostelId);
        if(count($man) > 0)
        {
            session(['manager' => true]);
        }
        else
        {
            session(['manager' => false]);
        }
        $email = $user->email;
        // sending email
        $emailData = array(
            'to' => $email,
            'subject' => 'Hostel Manager',
            'body' => 'You are removed as hostel manager'
        );
        $this->sendEmail($emailData);
        return redirect()->back()->with('success', 'hosteller manager removed successfully'); 
      }

      /**
       * this method validates user
       */
      public function validateUserCommit(Request $request)
      {
          $user = User::where('email', $request->email)->get();
          if(count($user) > 0)
          {
              return 1;
          }
          else
          {
              return 0;
          }
      }

    /**
     * this method sends emails
     */
    public function sendEmail($data)
    {
        Mail::to($data['to'])->send(new SendMail($data));
    }

    /**
     * this function deletes user account
     */
    public function deleteAccountCommit()
    {
        $userId = Auth::user()->id;
        $book = new Booking();
        $man = new Manager();
        $hos = new Hostel();
        $booking = $book->getUserBooking($userId);
        $manager = $man->getManager($userId);
        $hostel = $hos->getUserHostel($userId);
        if(count($booking) > 0)
        {
            return redirect()->back()->with('success', 'Sorry, you cannot delete your account because you have booking in a hostel'); 
        }
        else if(count($manager) > 0)
        {
            return redirect()->back()->with('success', 'Sorry, you cannot delete your account because you are working as a manager in a hostel'); 
        }
        else if(count($hostel) > 0)
        {
            return redirect()->back()->with('success', 'Sorry, you cannot delete your account because you have hostel registered against your account'); 
        }
        else
        {
            $user = User::find($userId);
            if($user != null)
            {
                $user->delete();
            }
            return redirect('login')->with(Auth::logout());
        }
    }

    /**
     * this method returns the hostel manager leave hostel page
     */
    public function leaveHostelCommit()
    {
        return view('pages.hostelmanagerleave');
    }

    /**
     * this method removes the hostel manager
     */
    public function hostelManagerLeaveCommit(Request $request)
    {
        $userId = Auth::user()->id;
        $hostelId = session('hostel')->id;
        $due = new HostelDues();
        $book = new bookingrequest();

        /* $dues = $due->getHostelDuesData($hostelId);
        if(count($dues) > 0)
        {
            if(count($dues) > 1)
            {
                foreach($dues as $d)
                {
                    if($d->previous_balance > 0)
                    {
                        return redirect()->back()->with('success', 'Please first clear the hosteller previous balances');  
                    }
                }
            }
            else
            {
                if($dues->first()->previous_balance > 0)
                {
                    return redirect()->back()->with('success', 'Please first clear the hosteller previous balances');
                }
            }
        } */
        // storing hostel leaving request
        $book->storeHostelManagerLeaveRequest($hostelId, $userId, $request->input('leaveDate'));
        return redirect()->back()->with('success', 'Your request is successfully send and will be responded soon');
    }

    /**
     * this method removes the hostel manager form the hostel
     */
    public function approveHostelManagerLeaveCommit($id)
    {
        $requestId = decrypt($id);
        $hostelId = session('hostel')->id;
        $book = new bookingrequest();
        $manager = new Manager();
        $req = $book->getBookingRequest($requestId);
        if($req != null)
        {
            $man = $manager->getHostelManagerCommit($hostelId, $req->user_id);
            if($man != null)
            {
                $manager->removeHostelManager($hostelId, $man->first()->user_id);
                // sending email
                $emailData = array(
                    'to' => User::find($man->first()->user_id)->email,
                    'subject' => 'Hostel Manager',
                    'body' => 'You are removed as hostel manager'
                );
                $this->sendEmail($emailData); 
            }
            
            // deleting booking request
            $book->removeBookingRequest($requestId);
            return redirect()->back()->with('success', 'Hostel Manager is removed successfully');
        }
        
    }
}
