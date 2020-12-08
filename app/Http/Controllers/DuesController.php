<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelDues;
use App\Notification;
use App\User;
use App\HostelRoom;
use App\Space;
use Auth;
use Mail;
use App\Mail\SendMail;

class DuesController extends Controller
{
    /**
     * this method returns the hostel dues page
     */
    public function hostelDuesDataCommit()
    {
        $hostelId = session('hostel')->id;
        $dues = new HostelDues();
        $room = new HostelRoom();
        $hostelDues = $dues->getHostelDuesData($hostelId);
        $data = "";
        if(count($hostelDues) > 0)
        {
            if(count($hostelDues) > 1)
            {
                foreach($hostelDues as $dues)
                {
                    $rm = $room->getRoom($dues->room_id);
                    $user = User::find($dues->hosteller_id);
                    $data .="<tr>";
                    $data .="<td>".$user->name."</td>";
                    $data .="<td>".$rm['room_no']."</td>";
                    $data .="<td>".$dues->payable."</td>";
                    $data .="<td>".$dues->paid."</td>";
                    $data .="<td>".$dues->pending."</td>";
                    $data .="<td>".$dues->previous_balance."</td>";
                    $data .="<td><a href='".url("editHostellerDues/".encrypt($dues->id)."/".$user->name)."' class ='btn btn-primary mt-1 pl-4 pr-4'>Edit Dues<i class='fa fa-pencil fa-lg ml-2'></i></a></td>";
                    $data .="</tr>";
                }
            }
            else 
            {
                $rm = $room->getRoom($hostelDues->first()->room_id);
                $user = User::find($hostelDues->first()->hosteller_id);
                $data .="<tr>";
                $data .="<td>".$user->name."</td>";
                $data .="<td>".$rm->room_no."</td>";
                $data .="<td>".$hostelDues->first()->payable."</td>";
                $data .="<td>".$hostelDues->first()->paid."</td>";
                $data .="<td>".$hostelDues->first()->pending."</td>";
                $data .="<td>".$hostelDues->first()->previous_balance."</td>";
                $data .="<td><a href='".url("editHostellerDues/".encrypt($hostelDues->first()->id)."/".$user->name)."' class ='btn btn-primary mt-1 pl-4 pr-4'>Edit Dues<i class='fa fa-pencil fa-lg ml-2'></i></a></td>";
                $data .="</tr>";
            }
        }
        //return $data;
        return view('pages.hosteldues', ['data' => $data]);
    }

    /**
     * this function returns the edit hosteller dues page
     */
    public function editHostellerDuesCommit($id, $name)
    {
        $duesId = decrypt($id); 
        $dues = new HostelDues();
        $hostellerDues = $dues->getHostellerDues($duesId);
        return view('pages.edithostellerdues', ['hostellerDues' => $hostellerDues, 'name' => $name]);
    }

    /**
     * this function updates the hosteller dues
     */
    public function updateHostellerDuesCommit(Request $request)
    {
        $dues = new HostelDues();
        $notif = new Notification();
        $hostelId = session('hostel')->id;
        $hostellerId = $dues->updateDues($request);
        $notif->storeDuesNotification($hostelId, $hostellerId);

       /*  // sending email to the hosteller
        $emailData = array(
            'to' => User::find($hostellerId)->email,
            'subject' => 'Hostel Dues',
            'body' => 'Your dues has been adjusted'
        );
        $this->sendEmail($emailData); */
    }

    /**
     * this function returns the hosteller dues
     */
    public function myHostelDuesCommit()
    {
        $userId = Auth::user()->id;
        $hostelDues = new HostelDues();
        $dues = $hostelDues->getUserDues($userId);
        $name = "";
        if(count($dues) > 0)
        {
            $user = User::find($dues->first()->hosteller_id);
            $name = $user->name;
        }
        return view('pages.myhosteldues', ['name' => $name, 'dues' => $dues]);
    }

    /**
     * this method notifies the defaulter hostellsers
     */
    public function notifyDefaultersCommit()
    {
        $hostelId = session('hostel')->id;
        $room = new HostelRoom();
        $dues = new HostelDues();
        $notif = new Notification();
        $space = new Space();
        
        $rooms = $room->getRooms($hostelId);
        if(count($rooms) > 0)
        {
           if(count($rooms) > 1)
           {
               foreach($rooms as $rm)
               {
                   $spaces = $space->getHostelSpace($rm->id);
                   if(count($spaces) > 0)
                   {
                        if(count($spaces) > 1)
                        {
                            foreach($spaces as $sp)
                            {
                                $due = $dues->getUserDues($sp->hosteller_id);
                                if(count($due) > 0)
                                {
                                    if(($due->first()->paid == 0) || ($due->first()->previous_balance > 0))
                                    {
                                        $notif->storeDuesDefaultNotification($hostelId, $sp->hosteller_id);
                                        // sending email to the hosteller
                                        $emailData = array(
                                            'to' => User::find($sp->hosteller_id)->email,
                                            'subject' => 'Hostel Dues',
                                            'body' => 'Please clear your dues'
                                        );
                                        $this->sendEmail($emailData);
                                    }
                                }
                            }
                        }
                        else
                        {
                            $due = $dues->getUserDues($spaces->first()->hosteller_id);
                            if(count($due) > 0)
                            {
                                if(($due->first()->paid == 0) || ($due->first()->previous_balance > 0))
                                {
                                    $notif->storeDuesDefaultNotification($hostelId, $spaces->first()->hosteller_id);
                                    // sending email to the hosteller
                                    $emailData = array(
                                        'to' => User::find($spaces->first()->hosteller_id)->email,
                                        'subject' => 'Hostel Dues',
                                        'body' => 'Please clear your dues'
                                    );
                                    $this->sendEmail($emailData);
                                }
                            }
                        }
                   }
               }
            }
            else
            {
                $spaces = $space->getHostelSpace($rooms->first()->id);
                if(count($spaces) > 0)
                {
                    if(count($spaces) > 1)
                    {
                        foreach($spaces as $sp)
                        {
                            $due = $dues->getUserDues($sp->hosteller_id);
                            if(count($due) > 0)
                            {
                                if(($due->first()->paid == 0) || ($due->first()->previous_balance > 0))
                                {
                                    $notif->storeDuesDefaultNotification($hostelId, $sp->hosteller_id);
                                    // sending email to the hosteller
                                    $emailData = array(
                                        'to' => User::find($sp->hosteller_id)->email,
                                        'subject' => 'Hostel Dues',
                                        'body' => 'Please clear your dues'
                                    );
                                    $this->sendEmail($emailData);
                                }
                            }
                        }
                    }
                    else
                    {
                        $due = $dues->getUserDues($spaces->first()->hosteller_id);
                        if(count($due) > 0)
                        {
                            if(($due->first()->paid == 0) || ($due->first()->previous_balance > 0))
                            {
                                $notif->storeDuesDefaultNotification($hostelId, $spaces->first()->hosteller_id);
                                // sending email to the hosteller
                                $emailData = array(
                                    'to' => User::find($spaces->first()->hosteller_id)->email,
                                    'subject' => 'Hostel Dues',
                                    'body' => 'Please clear your dues'
                                );
                                $this->sendEmail($emailData);
                            }
                        }
                    }
                }
            } 
        }
        return back();
    }

    /**
     * this method resets the dues data
     */
    public function resetDuesDataCommit()
    {
        $hostelId = session('hostel')->id;
        $dues = new HostelDues();
        $hostelDues = $dues->getHostelDuesData($hostelId);
        if(count($hostelDues) > 0)
        {
            if(count($hostelDues) > 1)
            {
                foreach($hostelDues as $due)
                {
                    $dues->resetDues($due->id);
                }
            }
            else
            {
                $dues->resetDues($hostelDues->first()->id);
            }
        }
        return back();
    }

    /**
     * this method updates the previous balance
     */
    public function adjustPreviousBalanceCommit(Request $request)
    {
        if($request->input('previousMoney') == "")
        {
            return redirect()->back()->with('success', 'Please enter previous money'); 
        }
        else
        {
            if($request->input('previousMoney') <= 0)
            {
                return redirect()->back()->with('success', 'Previous amount should be greater than zero'); 
            }
            else
            {
                $dues = new HostelDues();
                $dues->adjustPreviousBalance($request);
                return redirect()->back()->with('success', 'Previous money is adjusted');
            }
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
