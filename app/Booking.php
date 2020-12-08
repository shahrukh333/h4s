<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Booking extends Model
{
    /**
     * this method returns the hostel booking
     */
    public function getBooking($id)
    {
        $booking = Booking::find($id);
        return $booking;
    }

    /**
     * this method returns booking of a user
     */
    public function getUserBooking($id)
    {
        $booking = Booking::where('user_id', $id)->get();
        return $booking;
    }

    /**
     * this method returns the booking of a hostel
     */
    public function getHostellers($id)
    {
        $hostellers = Booking::where('hostel_id', $id)->get();
        return $hostellers;
    }

    /**
     * this method stores hostel booking
     */
    public function storeBooking($userId, $hostelId, $checkIn, $checkOut)
    {
        $booking = new Booking();
        $booking->user_id = $userId;
        $booking->hostel_id = $hostelId;
        $booking->check_in = $checkIn;
        $booking->check_out = $checkOut;
        $booking->save();
    }

    /**
     * this method updates the user booking
     */
    public function updateBooking($userId, $request)
    {
        $book = Booking::find($request->bookingData['bookingId']);
        $book->check_in = $request->bookingData['checkin'];
        $book->check_out = $request->bookingData['checkout'];
        $book->save();
    }

    /**
     * this method deletes booking request
     */
    public function deleteBooking($id)
    {
        $book = Booking::find($id);
        $book->delete();
    }

    /**
     * this method deletes user booking
     */
    public function deleteUserBooking($hostelId, $userId)
    {
        $book = Booking::where(['hostel_id' => $hostelId, 'user_id' => $userId])->get();
        if(count($book) > 0)
        {
            $book->first()->delete();
        }
    }
}
