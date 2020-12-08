<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelInformation;
use App\Hostel;
use App\User;
use App\Complaint;
use App\Warning;
use Mail;
use App\Mail\SendMail;

class AdminTasksController extends Controller
{
   /**
    * this method returns the blocked hostels
    */
    public function blockedHostelsCommit()
    {
        $info = new HostelInformation();
        $hostel = new Hostel();
        $user = new User();
        $com = new Complaint();
        $data = "";
        //getting all the hostels
        $hostels = $hostel->getBlockedHostels();
        if(count($hostels) > 0)
        {
            if(count($hostels) > 1)
            {
                foreach($hostels as $host)
                {
                    $information = $info->getHostelInformation($host->id);
                    $data .= '<tr>';
                    $data .= '<td>'.$information->first()->hostel_name.'</td>';
                    $data .= '<td>'.$information->first()->hostel_city.'</td>';
                    $data .= '<td>'.$user->getUserName($host->user_id).'</td>';
                    $data .= '<td>'.$com->getHostelComplaintCount($host->id).'</td>';
                    $data .= '<td>'.$host->updated_at.'</td>';
                    $data .= '<td>';
                    $data .= "<a id='blockedHostelNotifyOwner' class='btn btn-primary ml-1 mt-1' href='".url("notifyOwner/".encrypt($host->user_id))."'>Notify Owner<i class='fa fa-bell fa-lg ml-2'></i></a>";
                    $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("unblockHostel/".encrypt($host->id))."'>Unblock<i class='fa fa-unlock fa-lg ml-2'></i></a>";
                    $data .= '</td>';
                    $data .= '</tr>';
                }
            }
            else
            {
                $information = $info->getHostelInformation($hostels->first()->id);
                $data .= '<tr>';
                $data .= '<td>'.$information->first()->hostel_name.'</td>';
                $data .= '<td>'.$information->first()->hostel_city.'</td>';
                $data .= '<td>'.$user->getUserName($hostels->first()->user_id).'</td>';
                $data .= '<td>'.$com->getHostelComplaintCount($hostels->first()->id).'</td>';
                $data .= '<td>'.$hostels->first()->updated_at.'</td>';
                $data .= '<td>';
                $data .= "<a id='blockedHostelNotifyOwner' class='btn btn-primary ml-1 mt-1' href='".url("notifyOwner/".encrypt($hostels->first()->user_id))."'>Notify Owner<i class='fa fa-bell fa-lg ml-2'></i></a>";
                $data .= "<a class='btn btn-primary ml-1 mt-1' href='".url("unblockHostel/".encrypt($hostels->first()->id))."'>Unblock<i class='fa fa-unlock fa-lg ml-2'></i></a>";
                $data .= '</td>';
                $data .= '</tr>';
            }
        }
        
        return view('pages.blockedhostel', ['data' => $data]);
    }

    /**
     * this method returns the warned hostels
     */
    public function warnedHostelsCommit()
    {
        $info = new HostelInformation();
        $com = new Complaint();
        $hostel = new Hostel();
        $user = new User();
        $warning = new Warning();
        $data = "";
        //getting all the warned hostels
        $warn = $warning->getAllWarnedHostels();
        if(count($warn) > 0)
        {
            if(count($warn) > 1)
            {
                foreach($warn as $w)
                {
                    $host = $hostel->getHostel($w->hostel_id);
                    $information = $info->getHostelInformation($w->hostel_id);
                    $data .= '<tr>';
                    $data .= '<td>'.$information->first()->hostel_name.'</td>';
                    $data .= '<td>'.$information->first()->hostel_city.'</td>';
                    $data .= '<td>'.$user->getUserName($host->user_id).'</td>';
                    $data .= '<td>'.$com->getHostelComplaintCount($host->id).'</td>';
                    $data .= '<td>'.$w->created_at.'</td>';
                    if($host->status == 'Blocked')
                    {
                        $data .= '<td>Hostel is blocked</td>';
                    }
                    else
                    {
                        $data .= '<td>';
                        $data .= "<a id='notifyHostelOwnerBtn' class='btn btn-primary ml-1 pr-2 mt-1' href='".url("notifyHostelOwner/".encrypt($host->user_id))."'>Notify Owner<i class='fa fa-bell fa-lg ml-2'></i></a>";
                        $data .= "<a class='btn btn-primary ml-1 pr-2 mt-1' href='".url("blockHostel/".encrypt($host->id))."'>Block Hostel<i class='fa fa-lock fa-lg ml-2'></i></a>";
                        $data .= '</td>';
                    }
                    $data .= '</tr>';
                }
            }
            else
            {
                $host = $hostel->getHostel($warn->first()->hostel_id);
                $information = $info->getHostelInformation($warn->first()->hostel_id);
                $data .= '<tr>';
                $data .= '<td>'.$information->first()->hostel_name.'</td>';
                $data .= '<td>'.$information->first()->hostel_city.'</td>';
                $data .= '<td>'.$user->getUserName($host->user_id).'</td>';
                $data .= '<td>'.$com->getHostelComplaintCount($host->id).'</td>';
                $data .= '<td>'.$warn->first()->created_at.'</td>';
                if($host->status == 'Blocked')
                {
                    $data .= '<td>Hostel is blocked</td>';
                }
                else
                {
                    $data .= '<td>';
                    $data .= "<a id='notifyHostelOwnerBtn' class='btn btn-primary ml-1 pr-2 mt-1' href='".url("NotifyHostelOwner/".encrypt($host->user_id))."'>Notify Owner<i class='fa fa-bell fa-lg ml-2'></i></a>";
                    $data .= "<a class='btn btn-primary ml-1 pr-2 mt-1' href='".url("blockHostel/".encrypt($host->id))."'>Block Hostel<i class='fa fa-lock fa-lg ml-2'></i></a>";
                    $data .= '</td>';
                }
                $data .= '</tr>';
            }
        }
        return view('pages.warnedhostel', ['data' => $data]);
    }

    /**
     * this method issues warning to the hostel
     */
    public function issueWarningCommit($id)
    {
        $hostelId = decrypt($id);
        $warn = new Warning();
        $hostel = new Hostel();
        $com = new Complaint();

        $warning = $warn->getHostelWarning($hostelId);
        if(count($warning) > 0)
        {
            return redirect()->back()->with('success', 'The hostel is already on warning');
        }
        else
        {
            $host = $hostel->getHostel($hostelId);
            $warn->storeWarning($hostelId);
            $user = User::find($host->user_id);
            if($user != null)
            {
                // sending email to the hosteller
                $emailData = array(
                    'to' => $user->email,
                    'subject' => 'Hostel Warning',
                    'body' => 'There are many complaints against your hostel, please take action against those complaints otherwise your hostel will be blocked'
                );
                $this->sendEmail($emailData);
            }

            $hostels = $hostel->getAllhostels();
            $found = false;
            if(count($hostels) > 0)
            {
                if(count($hostels) > 1)
                {
                    foreach($hostels as $host)
                    {
                        $complaints = $com->getHostelComplaintCount($host->id);
                        if($complaints > 0)
                        {
                            /* $warning = $warn->getHostelWarning($host->id);
                            if(count($warning) > 0)
                            { */
                                $found = true;
                                break;
                           // }
                        }
                    }
                }
                else
                {
                    $complaints = $com->getHostelComplaintCount($hostels->first()->id);
                    if($complaints > 0)
                    {
                        /* $warning = $warn->getHostelWarning($hostel->first()->id);
                        if(count($warning) > 0)
                        { */
                            $found = true;
                       // }
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
            // setting hostel warning session
            $warnFound = $warn->getAllWarnedHostels();
            if(count($warnFound) > 0)
            {
                session(['warnedHostel' => true]);
            }
            else
            {
                session(['warnedHostel' => false]);
            }
            return redirect()->back()->with('success', 'The hostel is placed in the warning list, and the owner is notified');
        }
    }

    /**
     * this method notifies the hostel owner about the warned hostel
     */
    public function NotifyHostelOwnerCommit($id)
    {
        $userId = decrypt($id);
        $user = User::find($userId);
        if($user != null)
        {
            // sending email to the hosteller
            $emailData = array(
                'to' => $user->email,
                'subject' => 'Block Hostel',
                'body' => 'It is to remind you again that there lots of complaints against your hostel, please resolve the complaints otherwise your hostel will be blocked, thankyou'
            );
            $this->sendEmail($emailData);
            return redirect()->back()->with('success', 'Email notification is sent to the hostel owner');
        }
        else
        {
            return redirect()->back()->with('success', 'Unable to notify hostel owner');
        }
    }

    /**
     * this method notify the hostel owner about the blocked hostels
     */
    public function notifyOwnerCommit($id)
    {
        $userId = decrypt($id);
        $user = User::find($userId);
        if($user != null)
        {
            // sending email to the hosteller
            $emailData = array(
                'to' => $user->email,
                'subject' => 'Block Hostel',
                'body' => 'It is to remind you that your hostel has been blocked, please resolve the complaints to unblock your hostel, thankyou'
            );
            $this->sendEmail($emailData);
            return redirect()->back()->with('success', 'Email notification is sent to the hostel owner');
        }
        else
        {
            return redirect()->back()->with('success', 'Unable to notify hostel owner');
        }
    }

    /**
     * this method blocks hostel
     */
    public function blockHostelCommit($id)
    {
        $hostelId = decrypt($id);
        $hostel = new Hostel();
        $warn = new Warning();
        $host = $hostel->getHostel($hostelId);
        // blocking hostel
        $hostel->blockHostel($hostelId);
        // removing warning
        $warn->removeWarning($hostelId);
        // sending email to the hosteller
        $emailData = array(
            'to' => User::find($host->user_id)->email,
            'subject' => 'Hostel Blocked',
            'body' => 'It is to notify you that your hostel has been blocked, due to too many complaints, please remove the complaints to unblock the hostel, thank you'
        );
        $this->sendEmail($emailData);
        // getting all the warned hostels
        $warnedHostels = $warn->getAllWarnedHostels();
        // setting the warned hostel session
        if(count($warnedHostels) > 0)
        {
            session(['warnedHostel' => true]);
        }
        else
        {
            session(['warnedHostel' => false]);
        }
        return redirect()->back()->with('success', 'Hostel is blocked, and the owner is notified');
    }

    /**
     * this method unblocks the hostel
     */
    public function unblockHostelCommit($id)
    {
        $hostelId = decrypt($id);
        $hostel = new Hostel();
        $com = new Complaint();
        // checking the hostel complaint
        $complaint = $com->getHostelComplaintCount($hostelId);
        if($complaint > 10)
        {
            return redirect()->back()->with('success', 'Unable to unblock hostel because number of complaints are greater than allowed');
        }
        else
        {
            // unblocking hostel
            $userId = $hostel->unblockHostel($hostelId);
            // sending email to the hosteller
            $emailData = array(
                'to' => User::find($userId)->email,
                'subject' => 'Unblock Hostel',
                'body' => 'Congratulations! your hostel is unblocked again, thankyou'
            );
            $this->sendEmail($emailData);
            // getting blocked hostels
            $hostels = $hostel->getBlockedHostels();
            if(count($hostels) == 0)
            {
                session(['blockedHostel' => false]);
            }
            return redirect()->back()->with('success', 'Hostel is unblocked successfully');
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
