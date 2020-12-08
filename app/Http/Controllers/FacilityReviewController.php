<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelInformation;
use App\HostelFacility;
use App\Review;
use App\User;
use Auth;

class FacilityReviewController extends Controller
{
    /**
     * This method displays the review page
     */
    public function reviewCommit()
    {
        $hostelId = session('hostel')->id;
        $user = new User();
        $reviews = Review::where(['hostel_id' => $hostelId, 'status' => 'Pending'])->paginate(2);
        if(count($reviews) < 0)
        {
            session(['review' => false]);  
        }
        return view('pages.review', ['reviews' => $reviews, 'user' => $user]);
    }

    /**
     * this method returns the hostel facilities
     */
    public function getHostelFacilities()
    {
        $hostelId = session('hostel')->id;
        $facility = new HostelFacility();
        $hostelFacilities = $facility->getHostelFacilities($hostelId);
        if(count($hostelFacilities) > 0)
        {
            return view('pages.hostelfacility',['hostelFacilities' => $hostelFacilities]);
        }
    }

    /**
     * this method stores facilities into the database
     */
    public function addHostelFacilities(Request $request)
    {
        $facility = new HostelFacility();
        $facility->storeFacility($request);
        $added = true;
        return view('pages.addhostelfacility',['added' => $added]);
    }

    /**
     * this method returns the edit hostel facility page
     */
    public function displayEditHostelFacilitiesPage($id)
    {
        $facilityId = decrypt($id);
        $facility = new HostelFacility();
        $facilities = $facility->getHostelFacility($facilityId);
        return view('pages.edithostelfacility', ['facilities' => $facilities]);
    }

    /**
     * this method updates the hostel rules
     */
    public function updateHostelFacilitiesCommit(Request $request)
    {
        $facility = new HostelFacility();
        $facility->updateHostelFacility($request);
    }

    /**
     * this function returns the register review page
     */
    public function reviewHostelCommit()
    {
        return view('pages.registerreview');
    }

    /**
     * this method stores the user review int
     * the database
     */
    public function registerHostelReviewCommit(Request $request)
    {
        $review = new Review();
        $reviews = $review->getHostellerRating($request->reviewData['hostelId'], $request->reviewData['userId']);
        if(count($reviews) > 0)
        {
            return '<div class="alert alert-success mt-3" role="alert">Sorry you have already rated the hostel, you can update your review</div>';
        }
        else
        {
            $review->storeReview($request);
            return '<div class="alert alert-success mt-3" role="alert">review successfully registered</div>';
        }
    }

    /**
     * this method returns the reviews of a hosteller
     */
    public function myReviewsCommit()
    {
        $hostellerId = Auth::user()->id;
        $review = new Review();
        $info = new HostelInformation();
        $reviews = $review->getHostellerReviews($hostellerId);
        return view('pages.myreview', ['reviews' => $reviews, 'info' => $info]);
    }

    /**
     * This method returns the edit review page
     */
    public function editReviewCommit($id)
    {
        $reviewId = decrypt($id);
        $rev = new Review();
        $review = $rev->getReview($reviewId);
        return view('pages.editmyreview', ['review' => $review]);
    }

    /**
     * This method update the review
     */
    public function updateReviewCommit(Request $request)
    {
        $review = new Review();
        $review->updateReview($request);
    }

    /**
     * this function deletes review
     */
    public function updateReviewStatusCommit($id)
    {
        $reviewId = decrypt($id);
        $review = new Review();
        $review->updateReviewStatus($reviewId);
        return back();
    }
   
}
