<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\HostelInformation;
use App\HostelFacility;
use App\Review;
use App\HostelRoom;
Use DB;
Use App\User;
use Auth;

class IndexController extends Controller
{

    public function index() 
    {
      $review = new Review();
      $info = new HostelInformation(); 

      $attock = $info->getHostelByCity("attock");
      $Islamabad = $info->getHostelByCity("Islamabad");
      $lahore = $info->getHostelByCity("Lahore");
      $karachi = $info->getHostelByCity("Karachi");
      $Faisalabad = $info->getHostelByCity("Faisalabad");
      $Rawalpindi = $info->getHostelByCity("Rawalpindi"); 
      $hostelInformations = HostelInformation::paginate(3);
      return view ('index',['hostelInformations' => $hostelInformations ,'attock' => $attock, 'Islamabad' => $Islamabad, 'lahore' => $lahore , 'kharachi' => $karachi ,'Faisalabad' => $Faisalabad ,'Rawalpindi' => $Rawalpindi, 'review' => $review]);
    }

    public function city($city)
    {
      $review = new Review();
      $info = new HostelInformation();
      $results = $info->getHostelByCity($city);
      return view ('search', ['results' => $results, 'review' => $review]);
    }



  public function modifySearch(Request $request)
  {
    $price = $request->input('price');
    $review = new Review();
    $price = explode("-",$request->input('price'));
    $min = $price [0];
    $max = $price [1];
    if(($request->hostelcity == NULL) && ($request->Category == NULL ) &&  ($request->Facilities == NULL))
    {
      $results = HostelInformation::whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
      return view ('search', ['results' => $results, 'review' => $review]);
    } 
    else if ( ( $request->hostelcity!= NULL ) && ($request->Category == NULL) && ($request->Facilities == NULL)) 
    {
        $results = HostelInformation::where('hostel_city', $request->hostelcity)->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
        return view ('search', ['results' => $results, 'review' => $review]);
    } //3
    else if (($request->hostelcity == NULL ) && ($request->Category == NULL) && ($request->Facilities != NULL))
    {
      $Facilities =($request->Facilities)+ [count($request->Facilities) => 'hostel_id'];
        $result1s = HostelFacility::all($Facilities);
        $total = 0;
        $str  = array();
        foreach ($result1s as $result1)
        {
          for($i = 0;$i<(count($Facilities)-1);$i++)
          {
            if ($result1[$Facilities[$i]] == "Yes")
            {
              $total = $total +1;
            }
          
            if($total == count($Facilities)-1)
            {
              $str[] =$result1[$Facilities[count($Facilities)-1]];
            }
          }
          $total = 0;
        }
    
      $results = HostelInformation::whereIn('hostel_id', $str)->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
      return view ('search', ['results' => $results, 'review' => $review]);
    } 
    else if(($request->hostelcity == NULL ) && ($request->Category != NULL) && ($request->Facilities==NULL)) 
    {
      $results = HostelInformation::whereIn('hostel_category', $request->Category )->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
      return view ('search', ['results' => $results, 'review' => $review]);
    }  
    else if(($request->hostelcity!= NULL ) && ($request->Category == NULL) && ($request->Facilities != NULL)) 
    {
      $Facilities =($request->Facilities)+ [count($request->Facilities) => 'hostel_id'];
      $result1s = HostelFacility::all($Facilities);
      $total = 0;
      $str  = array();
      foreach ($result1s as $result1) 
      {
        for($i = 0;$i<(count($Facilities)-1);$i++)
        {
          if ($result1[$Facilities[$i]] == "Yes")
          {
            $total = $total +1;
            }

          if($total == count($Facilities)-1)
          {
            $str[] =$result1[$Facilities[count($Facilities)-1]];
          }
        }
        $total = 0;
      }
      $results= HostelInformation::whereIn('hostel_id', $str )->where('hostel_city', $request->hostelcity)->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();

      return view ('search', ['results' => $results, 'review' => $review]);
    }  
    else if(($request->hostelcity!= NULL ) && ($request->Category !=NULL) && ($request->Facilities==NULL)) 
    {
      $results = HostelInformation::whereIn('hostel_category', $request->Category )->where('hostel_city', $request->hostelcity)->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
      return view ('search', ['results' => $results, 'review' => $review]);
    }    
    else if(($request->hostelcity == NULL ) && ($request->Category != NULL) && ($request->Facilities != NULL))
    {
      $Facilities =($request->Facilities)+ [count($request->Facilities) => 'hostel_id'];
      $result1s = HostelFacility::all($Facilities);
    $total = 0;
    $str  = array();
    foreach ($result1s as $result1) 
    {
        for($i = 0;$i<(count($Facilities)-1);$i++)
        {
          if ($result1[$Facilities[$i]] == "Yes")
          {
            $total = $total +1;
          }

          if ($total == count($Facilities)-1)
          {
          $str[] =$result1[$Facilities[count($Facilities)-1]];
          }
        }
        $total = 0;
    }
    $results = hostelInformation::whereIn('hostel_id', $str )->whereIn('hostel_category', $request->Category )->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
    return view ('search', ['results' => $results, 'review' => $review]);
    }  
    else if(($request->hostelcity != NULL ) && ($request->Category != NULL) && ($request->Facilities != NULL)) 
    {
      $Facilities =($request->Facilities)+ [count($request->Facilities) => 'hostel_id'];
      $result1s = HostelFacility::all($Facilities);
    $total = 0;
    $str  = array();
    foreach ($result1s as $result1) 
    {
        for($i = 0;$i<(count($Facilities)-1);$i++)
        {
          if ($result1[$Facilities[$i]] == "Yes")
          {
            $total = $total +1;
          }

          if($total == count($Facilities)-1)
          {
            $str[] =$result1[$Facilities[count($Facilities)-1]];
          }
        }
        $total = 0;
    }
    $results = hostelInformation::whereIn('hostel_id', $str )->where('hostel_city', $request->hostelcity)->whereIn('hostel_category', $request->Category )->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
    return view ('search', ['results' => $results, 'review' => $review]);
    }  

}




  /**
   * this method returns the searched results
   */
  public function searchCommit(Request $request)
  {
    $review = new Review();
    $city = $request->input('city');
    $category = $request->input('category') ;
    $price = explode("-",$request->input('price'));
    
    if ($category == "default" ) 
    {
      $results = DB::table('hostel_informations')->where('hostel_city', $city)->where('hostel_rent', '<=', DB::raw((int)$price[1]))->get();
    }
    else 
    {
      $results = HostelInformation::where([['hostel_city','=',$city],['hostel_category','=', $request->category]])->whereBetween('hostel_rent', [ (int)$price [0], (int)$price [1]])->get();
    }
    return view ('search',['results' => $results , 'review' => $review]);
  }


    public function showHostelCommit($id)
    {
      $info = new HostelInformation();
      $review = new Review();
      $user = new User();
      $room = new HostelRoom();

      $hostelId = decrypt($id);
      $hostelFacilities = HostelFacility::where('hostel_id', $hostelId)->first();
      $hostelInformation = $info->getHostelInformation($hostelId);
      $directory = public_path().'/graphics/hostel'.($hostelId);
      $data = "";
      if(is_dir($directory))
      {
          $dh = opendir($directory);
          while (false !== ($fileName = readdir($dh))) 
          {
            $path = "";
              if (is_file($directory."/".$fileName))
              {
                  $path = "/graphics/hostel".$hostelId."/".$fileName;
                  $data .= '<div class="htlfndr-gallery-item">';
                  $data .= '<img src="'.url($path).'" alt="hostel img" style="height: 450px"/>';
                  $data .= '</div>';
                   
              }
          }
          closedir($dh);
         
      }
      $nearhostels = $info->getHostelByCity($hostelInformation->first()->hostel_city);
      return view ('show', ['hostelFacilities' => $hostelFacilities, 'hostelInformation' => $hostelInformation, 'data' => $data ,'nearhostels' => $nearhostels, 'review' => $review, 'user' => $user, 'room' => $room]);
    }

    /**
     * this function returns the searched hostel
     */
    public function searchShowCommit($id)
    {
      $info = new HostelInformation();
      $review = new Review();
      $user = new User();
      $room = new HostelRoom();

      $hostelId = decrypt($id);
      $hostelFacilities = HostelFacility::where('hostel_id', $hostelId)->first();
      $hostelInformation = $info->getHostelInformation($hostelId);
      $directory = public_path().'/graphics/hostel'.($hostelId);
      $data = "";
      if(is_dir($directory))
      {
          $dh = opendir($directory);
          while (false !== ($fileName = readdir($dh))) 
          {
            $path = "";
              if (is_file($directory."/".$fileName))
              {
                  $path = "/graphics/hostel".$hostelId."/".$fileName;
                  $data .= '<div class="htlfndr-gallery-item">';
                  $data .= '<img src="'.url($path).'" alt="hotel img"/>';
                  $data .= '</div>';
                   
              }
          }
          closedir($dh);
         
      }
      $nearhostels = $info->getHostelByCity($hostelInformation->first()->hostel_city);
      return view ('searchshow', ['hostelFacilities' => $hostelFacilities, 'hostelInformation' => $hostelInformation, 'data' => $data ,'nearhostels' => $nearhostels, 'review' => $review, 'user' => $user, 'room' => $room]);
    }

    public function editProfile()
    {
        return view('pages.editprofile');
    }

    public function booking()
    {
        return view('pages.booking');
    }

    public function addHostelManager()
    {
        return view('pages.addHostelManager');
    }
}
