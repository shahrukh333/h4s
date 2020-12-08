<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\QueryReply;

class Query extends Model
{
    /**
     * This method returns the queries
     * of a hostel with a particular id
     */
    public static function getHostelQueries($id)
    {
        $query = Query::where(['hostel_id' => $id, 'status' => 'Pending'])->get();
        return $query;
    }

    /**
     * This method returns a query
     */
    public function getQuery($id)
    {
        $query = Query::find($id);
        return $query;
    }

    /**
     * this method stores query into the database
     */
    public function storeQuery(Request $request)
    {
        $query = new Query();
        $query->hostel_id = $request->myQuery['hostelId'];
        $query->hosteller_id = $request->myQuery['userId'];
        $query->body = $request->myQuery['query'];
        $query->status = "Pending";
        $query->save();
    }

    /**
     * this method updates the query
     */
    public function updateQuery(Request $request)
    {
        $query = Query::find($request->myQuery['queryId']);
        $query->body = $request->myQuery['query'];
        $query->save();
    }


    /**
     * this method returns user queries
     */
    public function getUserQueries($id)
    {
        $queries = Query::where('hosteller_id', $id)->get();
        return $queries;
    }

    /**
     * this method deletes the query
     */
    public function deleteQuery($id)
    {
        $query = Query::find($id);
        $query->delete();
    }
    
    /**
     * this function returns the query reply
     */
    public function getQueryReply($queryId)
    {
        $reply = Query::where('query_id', $queryId)->first();
        return $reply;
    }

    /**
     * this method update query status
     */
    public function updateQueryStatus($id)
    {
        $query = Query::find($id);
        $query->status = 'Read';
        $query->save();
    }

    /**
     * deleting user queries
     */
    public function deleteUserQuery($hostelId, $userId)
    {
        $reply = new QueryReply();
        $query = Query::where(['hostel_id' => $hostelId, 'hosteller_id' => $userId])->get();
        if(count($query) > 0)
        {
            if(count($query) > 1)
            {
                foreach($query as $que)
                {
                    $reply->deleteUserQueryReply($que->id);
                    $que->delete();
                }
            }
            else
            {
                $reply->deleteUserQueryReply($query->first()->id);
                $query->first()->delete();
            }
        }
    }
}
