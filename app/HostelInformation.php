<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class HostelInformation extends Model
{
    /**
     * this method stores hostel informations
     */
    public function storeHostelInformation($hostelId, Request $request)
    {
        $information = new HostelInformation();
        $information->hostel_id = $hostelId;
        $information->hostel_name = $request->input('hostelName');
        $information->phone_number = $request->input('phoneNumber');
        $information->hostel_category = $request->input('hostelCategory');
        $information->hostel_country = $request->input('hostelCountry');
        $information->hostel_province = $request->input('hostelProvince');
        $information->hostel_city = $request->input('hostelCity');
        $information->hostel_street = $request->input('streetAddress');
        $information->hostel_address_line = $request->input('addressLine');
        $information->hostel_rent = $request->input('estimateRent');
        $information->rent_period = $request->input('rentPeriod');
        $information->hostel_description = $request->input('description');
        $information->landmarks = $request->input('landmark');
        $information->save();
    }

    /**
     * this method updates hostel informations
     */
    public function updateHostelInformation(Request $request)
    {
        $information = HostelInformation::find($request->hostelInformation['informationId']);
        $information->hostel_name = $request->hostelInformation['hostelName'];
        $information->phone_number = $request->hostelInformation['phoneNo'];
        $information->hostel_category = $request->hostelInformation['category'];
        $information->hostel_country = $request->hostelInformation['country'];
        $information->hostel_province = $request->hostelInformation['province'];
        $information->hostel_city = $request->hostelInformation['city'];
        $information->hostel_street = $request->hostelInformation['street'];
        $information->hostel_address_line = $request->hostelInformation['addressLine'];
        $information->hostel_rent = $request->hostelInformation['estimatedRent'];
        $information->rent_period = $request->hostelInformation['rentPeriod'];
        $information->hostel_description = $request->hostelInformation['description'];
        $information->landmarks = $request->hostelInformation['landmarks'];
        $information->save();
    }

    /**
     * this function returns hostel informations
     */
    public function getHostelInformation($id)
    {
        $information = HostelInformation::where('hostel_id', $id)->get();
        return $information;
    }

    /**
     * this function returns informations
     */
    public function getInformation($id)
    {
        $information = HostelInformation::find($id);
        return $information;
    }

    /**
     * this function delets hostel informations
     */
    public function deleteHostelInformation($id)
    {
        $information = HostelInformation::where('hostel_id', $id)->get();
        if(count($information) > 0)
        {
            $information->first()->delete();
        }
    }

    /**
     * this method returns hostel information by city
     */
    public function getHostelByCity($city)
    {
        $hostelInfo = HostelInformation::where('hostel_city', $city)->get();
        return $hostelInfo;
    }

    /**
     * this method returns hostel name
     */
    public function getHostelName($id)
    {
        $name = HostelInformation::where('hostel_id', $id)->first()->hostel_name;
        return $name;
    }

    
}
