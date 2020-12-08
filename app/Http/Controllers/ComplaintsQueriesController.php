<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\ComplaintReply;
use App\HostelInformation;
use App\Notification;
use App\QueryReply;
use App\Hostel;
use App\Warning;
use App\Query;
use App\User;
use Auth;
use DB;

class ComplaintsQueriesController extends Controller
{
 
    /**
     * This method show the complaint about the hostel
     */
    public function complaintCommit()
    {
        $hostelId = session('hostel')->id;
        $user = new User();
        $complaints = Complaint::where(['hostel_id' => $hostelId, 'status' => 'Pending'])->paginate(3);
        if(count($complaints) < 1)
        {
            session(['complaint' => false]);
        }
        return view('pages.complaint', ['complaints' => $complaints, 'user' => $user]);
    }

    /** 
     * This method updates the complaint status
     * from pending to read
     */
    public function updateHostelComplaints($id)
    {
        $complaintId = decrypt($id);
        $complaint = new Complaint();
        $notification = new Notification();
        // getting the complaint for user id
        $com = $complaint->getComplaint($complaintId);
        $userId = $com->hosteller_id;
        $complaint->updateComplaintStatus($complaintId);
        return back();
    }

    /**
     * This method displays the the replycomplaint page
     */
    public function replyHostelComplaint($id)
    {
        $complaintId = decrypt($id);
        $com = new Complaint();
        $complaint = $com->getComplaint($complaintId);
        $reply = false; 
        return view('pages.replycomplaint', ['complaint' => $complaint, 'reply' => $reply]);
    }

    /**
     * This method displays the query page
     */
    public function viewQueries()
    {
        $user = new User();
        $hostelId = session('hostel')->id;
        $queries = Query::where(['hostel_id' => $hostelId, 'status' => 'Pending'])->paginate(3);
        if(count($queries) < 1)
        {
            session(['query' => false]);   
        }
        return view('pages.query', ['queries' => $queries, 'user' => $user]);
    }

    /**
     * this method displays the reply query page
     */
    public function showReplyQueryPage($id)
    {
        $queryId = decrypt($id);
        $qry = new Query();
        $query = $qry->getQuery($queryId);
        $reply = false;
        return view('pages.queryreply', ['query' => $query, 'reply' => $reply]);
    }


    /**
     * This method store reply to a complaint
     */
    public function storeQueryReply(Request $request)
    {
        $qry = new Query();
        $reply = new QueryReply();
        $notification = new Notification();
        // storing the query reply
        $replyId = $reply->storeReply($request);
        $queryId = $request->queryReply['queryId'];
        // getting the query for notification
        $query = $qry->getQuery($queryId);
        // notifying the hosteller
        $notification->storeQueryNotification(session('hostel')->id, $query->hosteller_id, $replyId);
        // updating the query status
        $qry->updateQueryStatus($queryId);
    }

    /**
     * This method store reply to a complaint
     */
    public function storeComplaintReply(Request $request)
    {
        $reply = new ComplaintReply();
        $cmplnt = new Complaint();
        $notification = new Notification();

        $complaintReplyId = $reply->storeReply($request);
        $complaintId = $request->replyData['complaintId'];
        $cmplnt->updateComplaintStatus($complaintId);
        $complaint = $cmplnt->getComplaint($complaintId);
        /**
         * notifying the hosteller
         */
        $notification->storeComplaintNotification(session('hostel')->id,$complaint->hosteller_id,$complaintReplyId);
        
    }

     /**
     * this method returns registerComplaint page
     */
    public function hostelComplaintCommit()
    {
        return view('pages.registercomplaint');
    }

    /**
     * this method stores complaint into the database
     */
    public function registerComplaintCommit(Request $request)
    {
        $complaint = new Complaint();
        $complaint->storeComplaint($request);
    } 

    /**
     * this function returns the complaint of the hosteller
     */
    public function myComplaintsCommit()
    {
        $hostellerId = Auth::user()->id;
        $info = new HostelInformation();
        $complaint = new Complaint();
        $complaints = $complaint->getHostellerComplaints($hostellerId);
        return view('pages.mycomplaint', ['complaints' => $complaints, 'info' => $info]);
    }

    /**
     * This method returns the edit complaint page
     */
    public function editComplaintCommit($id)
    {
        $complaintId = decrypt($id);
        $comp = new Complaint();
        $complaint = $comp->getComplaint($complaintId);
        return view('pages.editmycomplaint',['complaint' => $complaint]);
    }

    /**
     * this method updates the hosteller complaint
     */
    public function updateComplaintCommit(Request $request)
    {
        $complaint = new Complaint();
        $complaint->updateComplaint($request);
    }

    /**
     * This method delete the complaint
     */
    public function deleteComplaintCommit($id)
    {
        $complaintId = decrypt($id);
        $complaint = new Complaint();
        $complaintReply = new ComplaintReply();
        $notif = new Notification();

        // getting the reply of the complaint
        $reply = $complaintReply->getComplaintReply($complaintId);
        if(count($reply) > 0)
        {
            // deleting the complaint reply
            $complaintReply->deleteComplaintReply($reply->first()->id);

            // getting the complaint notification
            $notification = $notif->getComplaintNotification($reply->first()->id);
            if(count($notification) > 0)
            {
                // deleting the notification
                if(count($notification) > 1)
                {
                    foreach($notification as $nf)
                    {
                        $notif->deleteNotification($nf->id);
                    }
                }
                else
                {
                    $notif->deleteNotification($notification->first()->id);
                }
            }
        }

        // deleting the complaint
        $complaint->deleteComplaint($complaintId);
        return back();
    }

    /**
     * This method stores query into the database
     */
    public function registerHostelQueryCommit(Request $request)
    {
        $query = new Query();
        $query->storeQuery($request);
    }

    /**
     * this method returns the register query page
     */
    public function registerQueryCommit()
    {
        return view('pages.registerquery');
    }

    /**
     * This method gets user queries
     */
    public function myQueriesCommit()
    {
        $userId = Auth::user()->id;
        $query = new Query();
        $queries = $query->getUserQueries($userId);
        return view('pages.myquery',['queries' => $queries]);
    }

    /**
     * this method returns the edit query page
     */
    public function editQueryCommit($id)
    {
        $queryId = decrypt($id);
        $qry = new Query();
        $query = $qry->getQuery($queryId);
        return view('pages.editquery',['query' => $query]);
    }

    /**
     * this method update the query
     */
    public function updateQueryCommit(Request $request)
    {
        $query = new Query();
        $query->updateQuery($request);
    }

    /**
     * this method deletes the query and query reply
     */
    public function deleteQueryCommit($id)
    {
        $queryId = decrypt($id);
        $query = new Query();
        $queryReply = new QueryReply();
        $notif = new Notification();
        
        // getting the reply of the query
        $reply = $queryReply->getQueryReply($queryId);
        if(count($reply) > 0)
        {
            // deleting the query reply
            $queryReply->deleteQueryReply($reply->first()->id);

            // getting the complaint notification
            $notification = $notif->getQueryNotification($reply->first()->id);
            if(count($notification) > 0)
            {
                if(count($notification) > 1)
                {
                    foreach($notification as $nf)
                    {
                        // deleting the notification
                        $notif->deleteNotification($nf->id);
                    }
                }
                else
                {
                    // deleting the notification
                    $notif->deleteNotification($notification->first()->id);
                }
            }
        }

        // deleting the query
        $query->deleteQuery($queryId);
        return back();
    }

    /**
     * this function get the query replies
     */
    public function getQueryReplyCommit(Request $request)
    {
        $queryId = $request->queryId;
        $queryReply = new QueryReply();
        $reply = $queryReply->getQueryReply($queryId);
        $r = $reply->first()->reply.'<br/><p class="pb-3">Replied at <span class="text-primary">'.
        $reply->first()->created_at.'</span></p>';
        return $r;
    }

    /**
     * this function returns the complaint reply
     */
    public function getComplaintReplyCommit(Request $request)
    {
        $complaintId = $request->complaintId;
        $complaintReply = new ComplaintReply();
        $reply = $complaintReply->getComplaintReply($complaintId);
        $r = $reply->first()->reply.'<br/><p class="pb-4">Replied at <span class="text-primary">'.
        $reply->first()->created_at.'</span></p>';
        return $r;
    }

    /**
     * this method deletes the hosteller query
     */
    public function deleteHostellerQueryCommit($id)
    {
        $queryId = decrypt($id);
        $query = new Query();
        $query->updateQueryStatus($queryId);
        return back();
    }

    /**
     * complaint reply
     */
    public function getComplaintReply($id)
    {
        $com = new Complaint();
        $comReply = new ComplaintReply();
        $complaintId = decrypt($id);
        // now getting the complaint reply
        $complaint = $com->getComplaint($complaintId);
        $reply = $comReply->getComplaintReply($complaint->id);

        return view('pages.mycomplaintreply',['complaint' => $complaint, 'reply' => $reply]);
    }

    /**
     * this function returns query replies
     */
    public function getQueReplyCommit($id)
    {
        $queryId = decrypt($id);
        $queryReply = new QueryReply();
        $query = new Query();
        // now getting the query reply
        $myQuery = $query->getQuery($queryId);
        $reply = $queryReply->getQueryReply($myQuery->id);
        return view('pages.myqueryreply',['myQuery' => $myQuery, 'reply' => $reply]);
    }

    /**
     * this method returns hostel with complaints
     */
    public function adminHostelComplaintsCommit()
    {
        $info = new HostelInformation();
        $hostel = new Hostel();
        $user = new User();
        $warn = new Warning();
        $com = new Complaint();
        $data = "";
        //getting all the hostels
        $hostels = $hostel->getAllhostels();
        if(count($hostels) > 0)
        {
            if(count($hostels) > 1)
            {
                foreach($hostels as $host)
                {
                    if($host->status != 'Blocked')
                    {
                        // checking whether the hostel is in warning or not
                        $warning = $warn->getHostelWarning($host->id);
                        if(count($warning) <= 0)
                        { 
                            $complaints = $com->getHostelComplaintCount($host->id);
                            // condition on the warned hostels
                            if($complaints > 0)
                            {
                                $information = $info->getHostelInformation($host->id);
                                $data .= '<tr>';
                                $data .= '<td>'.$information->first()->hostel_name.'</td>';
                                $data .= '<td>'.$information->first()->hostel_city.'</td>';
                                $data .= '<td>'.$user->getUserName($host->user_id).'</td>';
                                $data .= '<td>'.$com->getHostelComplaintCount($host->id).'</td>';
                                $data .= '<td>';
                                $data .= "<a class='btn btn-primary ml-1 pr-2 mt-1' href='".url("adminViewHostelComplaints/".encrypt($host->id))."'>View Complaints<i class='fa fa-eye fa-lg ml-2'></i></a>";
                                $data .= "<a id='issueWarningBtn' class='btn btn-primary ml-1 pr-2 mt-1' href='".url("issueWarning/".encrypt($host->id))."'>Issue Warning<i class='fa fa-exclamation-triangle fa-lg ml-2'></i></a>";
                                $data .= '</td>';
                                $data .= '</tr>';
                            }
                        }
                    }
                }
            }
            else
            {
                if($hostels->first()->status != 'Blocked')
                {
                    // checking whether the hostel is in warning or not
                    $warning = $warn->getHostelWarning($hostels->first()->id);
                    if(count($warning) <= 0)
                    {
                        $complaints = $com->getHostelComplaintCount($hostels->first()->id);
                        if($complaints > 0)
                        {
                            $information = $info->getHostelInformation($hostels->first()->id);
                            $data .= '<tr>';
                            $data .= '<td>'.$information->first()->hostel_name.'</td>';
                            $data .= '<td>'.$information->first()->hostel_city.'</td>';
                            $data .= '<td>'.$user->getUserName($hostels->first()->user_id).'</td>';
                            $data .= '<td>'.$com->getHostelComplaintCount($hostels->first()->id).'</td>';
                            $data .= '<td>';
                            $data .= "<a class='btn btn-primary ml-1 pr-2 mt-1' href='".url("adminViewHostelComplaints/".encrypt($hostels->first()->id))."'>View Complaints<i class='fa fa-eye fa-lg ml-2'></i></a>";
                            $data .= "<a id='issueWarningBtn' class='btn btn-primary ml-1 pr-2 mt-1' href='".url("issueWarning/".encrypt($hostels->first()->id))."'>Issue Warning<i class='fa fa-exclamation-triangle fa-lg ml-2'></i></a>";
                            $data .= '</td>';
                            $data .= '</tr>';
                        }
                    }
                }
            }
        }
        return view('pages.adminhostelcomplaint', ['data' => $data]);
    }

    /**
     * this method returns the hostel complaints for the admin
     */
    public function adminViewHostelComplaintsCommit($id)
    {
        $hostelId = decrypt($id);
        $user = new User();
        $complaints = Complaint::where(['hostel_id' => $hostelId, 'status' => 'Pending'])->paginate(3);
        return view('pages.admincomplaint', ['complaints' => $complaints, 'user' => $user]);
    }

}
