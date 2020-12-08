<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class QueryReply extends Model
{
    /**
     * this method returns the query reply
     */
    public function getReply($id)
    {
        $reply = QueryReply::find($id);
        return $reply;
    }

    /**
     * this method saves the query reply into the database
     */
    public function storeReply(Request $request)
    {
        $reply = new QueryReply();
        $reply->query_id = $request->queryReply['queryId'];
        $reply->reply = $request->queryReply['reply'];
        $reply->status = 'Pending';
        $reply->save();
        return $reply->id;
    }

    /**
     * this method returns the replies of a query
     */
    public function getQueryReply($id)
    {
        $reply = QueryReply::where('query_id', $id)->get();
        return $reply;
    }

    /**
     * this function deletes the query reply
     */
    public function deleteQueryReply($id)
    {
        $reply = QueryReply::find($id);
        $reply->delete();
    }

    /**
     * delete user query reply
     */
    public function deleteUserQueryReply($id)
    {
        $reply = QueryReply::where('query_id', $id)->get();
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
