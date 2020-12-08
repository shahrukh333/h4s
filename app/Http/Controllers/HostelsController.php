<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HostelInformation;
use App\HostelFacility;
use App\RomFacility;
use App\HostelRoom;
use App\HostelDues;
use App\Manager;
use App\Space;
use App\Booking;
use App\Hostel;
use Auth;

class HostelsController extends Controller
{
    /**
     * this method returns the hostel registration page
     */
    public function hostelRegistrationCommit()
    {
        $registered = false;
        return view('pages.hostelregistration', ['registered' => $registered]);
    }

    /**
     * this method stores the hostel information into the database
     */
    public function registerHostelCommit(Request $request)
    {
        $information = new HostelInformation();
        $facility = new HostelFacility();
        $hostel = new Hostel();
        $userId = Auth::user()->id;
        // storing hostel
        $hostelId = $hostel->storeHostel($userId);
        // storing hostel informations
        $information->storeHostelInformation($hostelId, $request);
        // storing hostel facilities
        $facility->storeHostelFacility($hostelId, $request);

        
        $directory = public_path().'/graphics/hostel'.($hostelId);
        if(!is_dir($directory))
        {
            mkdir($directory, 0777, true);
        }
        // saving images
        if($_FILES["image1"]['name'] != "")
        {
            move_uploaded_file($_FILES["image1"]["tmp_name"], $directory.'/'.$_FILES["image1"]['name']);
        }

        if($_FILES["image2"]['name'] != "")
        {
            move_uploaded_file($_FILES["image2"]["tmp_name"], $directory.'/'.$_FILES["image2"]['name']);
        }

        if($_FILES["image3"]['name'] != "")
        {
            move_uploaded_file($_FILES["image3"]["tmp_name"], $directory.'/'.$_FILES["image3"]['name']);
        }

        if($_FILES["image4"]['name'] != "")
        {
            move_uploaded_file($_FILES["image4"]["tmp_name"], $directory.'/'.$_FILES["image4"]['name']);
        }
        return redirect()->action('dashboardController@index');
    }

    /**
     * this function returns the hostel information page
     */
    public function hostelInformationCommit()
    {

        $hostelId = session('hostel')->id;
        $info = new HostelInformation();
        $information = $info->getHostelInformation($hostelId);
        
        // getting the hostel images
        $directory = public_path().'/graphics/hostel'.($hostelId);
        $images = "";

        if(is_dir($directory))
        {
            $dh = opendir($directory);
            while (false !== ($fileName = readdir($dh))) 
            {
                if (is_file($directory."/".$fileName))
                {
                    $images .= "<div class='col-md-6 mt-4'>";
                    $images .= "<img src='".url("graphics/hostel".$hostelId."/".$fileName)."' width='100%' height='250'><br>";
                    $images .= "</div>";
                }
            }
            closedir($dh);
        }
        else
        {
            $images = "";
        }
        
        return view('pages.hostelinformation', ['information' => $information, 'images' => $images]);
    }

    /**
     * this function returns the hostel information update page
     */
    public function editHostelInformationCommit($id)
    {
        $informationId = decrypt($id);
        $info = new HostelInformation();
        $information = $info->getInformation($informationId);
        return view('pages.edithostelinformation', ['information' => $information]);
    }

    /**
     * this function updates the hostel informations
     */
    public function updateHostelInformationCommit(Request $request)
    {
        $info = new HostelInformation();
        $info->updateHostelInformation($request);
    }

    /**
     * this function returns hostel data
     */
    public function getHostelDataCommit(Request $request)
    {
        return 'aqib';
    }

    /**
     * this method returns edit hostel images page
     */
    public function editHostelImagesCommit()
    {
        $hostelId = session('hostel')->id;
        $imageAdded = false;
        $directory = public_path().'/graphics/hostel'.($hostelId);
        $images = "";
        if(is_dir($directory))
        {
            $dh = opendir($directory);
            while (false !== ($fileName = readdir($dh))) 
            {
                if (is_file($directory."/".$fileName))
                {
                    $images .= "<div class='col-md-6 mt-4'>";
                    $url = "http://" . $_SERVER['SERVER_NAME'] . '/hostel4student/public/graphics/hostel'.$hostelId;
                    $url = $url.'/'.$fileName;
                    $images .= "<img src='".url("graphics/hostel".$hostelId."/".$fileName)."' width='100%' height='250'><br>";
                    $images .= "<a href='".url("deleteHostelImage/".$fileName."/".encrypt($hostelId))."' class ='btn btn-primary mt-1'>Delete Image<i class='fa fa-trash fa-lg ml-2'></i></a>";
                    $images .= "</div>";
                }
            }
            closedir($dh);
        }
        else
        {
            $images = "";
        }
        
        return view('pages.edithostelimage', ['hostelId' => $hostelId, 'imageAdded' => $imageAdded, "images" => $images]);
    }

    /**
     * this method saves hostel image into teh folder
     */
    public function addHostelImageCommit(Request $request)
    {
        $imageAdded = false;
        $directory = public_path().'/graphics/hostel'.($request->input('hostelId'));
        if(is_dir($directory))
        {
            move_uploaded_file($_FILES["hostelImage"]["tmp_name"], $directory.'/'.$_FILES["hostelImage"]['name']);
            $imageAdded = true;
        }
        else
        {
            mkdir($directory, 0777, true);
            move_uploaded_file($_FILES["hostelImage"]["tmp_name"], $directory.'/'.$_FILES["hostelImage"]['name']);
            $imageAdded = true;
        }
        return back()->with('imageAdded', $imageAdded);
    }

    /**
     * this function deletes hostelimage
     */
    public function deleteHostelImageCommit($imageName, $id)
    {
        $hostelId = decrypt($id);
        $directory = public_path().'/graphics/hostel'.($hostelId);
        $link = $directory.'/'.$imageName;
        if(is_dir($directory))
        {
            if(file_exists($link))
            {
                unlink($link);
            }
        }
        return back();
    }

    /**
     * this method deletes hostel
     */
    public function deleteHostelCommit()
    {
        $hostelId = session('hostel')->id;
        $book = new Booking();
        $dues = new HostelDues();
        $hostelInfo = new HostelInformation();
        $hostelFac = new HostelFacility();
        $roomFacility = new RomFacility();
        $manager = new Manager();
        $hostel = new Hostel();
        $room = new HostelRoom();
        $space = new Space();

        $booking = $book->getHostellers($hostelId);
        if(count($booking) > 0)
        {
            return redirect()->back()->with('success', 'sorry cannot delete hostel, it seems some people are living in the hostel'); 
        }
        else
        {
            // deleting the hostel
            $hostel->deleteHostel($hostelId);
            // deleting hostel facilities
            $hostelFac->deleteHostelFacility($hostelId);
            // deleting hostel informations
            $hostelInfo->deleteHostelInformation($hostelId);
            // deleting hostel manager
            $manager->removeHostelManager($hostelId);
            // deleting hostel dues details
            $hostelDues = $dues->getHostelDuesData($hostelId);
            if(count($hostelDues) > 0)
            {
                $dues->getHostelDuesData($hostelDues->first()->id);
            }
            // deleting rooms 
            $rooms = $room->getRooms($hostelId);
            if(count($rooms) > 0)
            {
                if(count($rooms) > 1)
                {
                    foreach($rooms as $rm)
                    {
                        // deleting space
                        $space->deleteRoomSpace($rm->id);
                        // deleting room
                        $room->deleteRoom($rm->id);
                        // deleting room facilities
                        $roomFacility->deleteFacility($rm->id);
                    }
                }
                else
                {
                    // deleting room space
                    $space->deleteRoomSpace($rooms->first()->id);
                    // deleting room
                    $room->deleteRoom($rooms->first()->id);
                    // deleting room facilities
                    $roomFacility->deleteFacility($room->first()->id);
                }
            }
            return redirect()->action('dashboardController@index');
        }
    }
}
