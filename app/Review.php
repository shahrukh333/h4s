<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Review extends Model
{
    /**
     * This method returns the reviews
     * of a hostel with a particular id
     */
    public static function getHostelReviews($id)
    {
        $review = Review::where('hostel_id',$id)->get();
        return $review;
    }

    /**
     * This method stores review into the database
     */
    public function storeReview(Request $request)
    {
        $review = new Review();
        $review->hostel_id = $request->reviewData['hostelId'];
        $review->hosteller_id = $request->reviewData['userId'];
        $review->review = $request->reviewData['review'];
        $review->rating = $request->reviewData['rating'];
        $review->status = 'Pending';
        $review->save();
    }

    /**
     * this method returns the reviews of a hosteller
     */
    public function getHostellerReviews($id)
    {
        $reviews = Review::where('hosteller_id', $id)->get();
        return $reviews;
    }

    /**
     * this method returns hosteller reviews of a hostel
     *
     */
    public function getHostellerRating($hostelId, $hostellerId)
    {
        $reviews = Review::where(['hostel_id' => $hostelId, 'hosteller_id' => $hostellerId])->get();
        return $reviews;
    }

    /**
     * this method returns a review based on its id
     */
    public function getReview($id)
    {
        $review = Review::find($id);
        return $review;
    }

    /**
     * This method updates the review
     */
    public function updateReview(Request $request)
    {
        $review = Review::find($request->reviewData['reviewId']);
        if($review != null)
        {
            $review->review = $request->reviewData['review'];
            $review->rating = $request->reviewData['rating'];
            $review->save();
        }
    }

    /**
     * this method returns hostel reviews
     */
    public function getHostelReview($id)
    {
        $reviews = Review::where(['hostel_id' => $id, 'status' => 'Pending'])->get();
        return $reviews;
    }

    /**
     * update review status
     */
    public function updateReviewStatus($id)
    {
        $review = Review::find($id);
        $review->status = 'Read';
        $review->save();
    }

    /**
     * this method deletes the review
     */
    public function deleteReview($id)
    {
        $review = Review::find($id);
        $review->delete();
    }

    /**
     * this method gives hostels base on reviews
     */
    public function getHostelRating()
    {
        $rating = Review::inRandomOrder()->limit(3)->get();
        return $rating;
    }

    /**
     * this method gives rating count of a hostel
     */
    public function getHostelRatingCount($hostelId)
    {
        $rating = Review::where('hostel_id', $hostelId)->count();
        return $rating;
    }

    /**
     * this method returns hostel rating
     */
    public function getRating($id)
    {
        $rating = Review::where('hostel_id', $id)->get();
        if(count($rating) > 0)
        {
            return $rating->first()->rating;
        }
        else
        {
            return 0;
        }
    }

    /**
     * this method returns two revies
     */
    public function getHostelTwoReviews($id)
    {
        $review = Review::where('hostel_id', $id)->take(2)->get();
        return $review;
    }

    /**
     * this mehtod retursn hostel all ratings
     */
    public function getHostelAllRatings($id)
    {
        $review = Review::where('hostel_id', $id)->get();
        return $review;
    }

}
