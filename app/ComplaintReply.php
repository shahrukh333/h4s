<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ComplaintReply extends Model
{
    /**
     * this method stores reply to a complaint
     */
    public function storeReply(Request $request)
    {
        $reply = new ComplaintReply();
        $reply->complaint_id = $request->replyData['complaintId'];
        $reply->reply = $request->replyData['reply'];
        $reply->status = 'Pending';
        $reply->save();
        return $reply->id;
    }

    /**
     * this method returns the complaint reply
     */
    public function getReply($id)
    {
        $reply = ComplaintReply::find($id);
        return $reply;
    }

    /**
     * this method returns complaint reply
     */
    public function getComplaintReply($id)
    {
        $reply = ComplaintReply::where('complaint_id', $id)->get();
        return $reply;
    }

    /**
     * this method deletes complaint reply
     */
    public function deleteComplaintReply($id)
    {
        $reply = ComplaintReply::find($id);
        $reply->delete();
    }

    /**
     * this method deletes uer complaint replies
     */
    public function deleteUserComplaintReply($id)
    {
        $reply = ComplaintReply::where('complaint_id', $id)->get();
        if(count($reply) > 0)
        {
            if(count($reply) > 1)
            {
                foreach($reply as $rep)
                {
                    $rep->delete();
                }
            }
            else
            {
                $reply->first()->delete();
            }
        }
    }
}
