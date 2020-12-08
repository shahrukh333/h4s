    @include('includes.showsearchhead')
    @include('includes.indexnavbar')
    <section id="home" class="about-us">
        <div class="container">
            <div class="about-us-content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="single-about-us">
                            <div class="about-us-txt"> </div>
                        </div>
                    </div>
                    <div class="col-sm-0">
                        <div class="single-about-us"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <form action="{{url('search')}}" method="POST" >
        {{ csrf_field() }}
        <section  class="travel-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-travel-boxes">
                            <div id="desc-tabs" class="desc-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation">
                                        <a href="#hostels" aria-controls="hostels" role="tab" data-toggle="tab">
                                            <i class="fa fa-building"></i>hostel
                                        </a>
                                    </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade in" id="tours">
                                        <div class="tab-para">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="single-tab-select-box">
                                                        <h2>Destination</h2>
                                                        <div >
                                                            <input id="" name="city" class="form-control"   placeholder="City" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                    <div class="single-tab-select-box">
                                                        <h2>Category</h2>
                                                        <div class="travel-select">
                                                            <select class="form-control " name="category">
                                                                <option value="default">Select your hostel Category</option>
                                                                <option value="Male Hostel">Male-hostel</option>
                                                                <option value="Female Hostel">female-hostel</option>                                                                  
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="travel-budget">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-4">
                                                                <h3>budget : </h3>
                                                            </div>
                                                            <div class="co-md-9 col-sm-8">
                                                                <div class="travel-filter">
                                                                    <div class="info_widget">
                                                                        <div class="price_filter">
                                                                            <div id="slider-range"></div>
                                                                            <div class="price_slider_amount">
                                                                                <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clo-sm-7">
                                                    <div class="about-btn travel-mrt-0 pull-right">
                                                        <button  class="about-view travel-btn">
                                                            search	
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
        </form>
                <!--galley start-->
            <section id="gallery" class="gallery">
                <div class="container">
                    <div class="gallery-details">
                        <div class="gallary-header text-center">
                            <h2>Top Destination</h2>
                        </div>
                        <div class="gallery-box">
                            <div class="gallery-content">
                                    <div class="filtr-container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g1.jpg') }}" alt="portfolio image" style="height: 400px"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Islamabad'])}}" > Islamabad</a>
                                                        <p><span>{{count($Islamabad)}}</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-6">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g2.jpg') }}" alt="portfolio image" style="height: 400px"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Karachi'])}}" >karachi</a>
                                                        <p><span>{{count($kharachi)}}</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-4">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g3.jpg') }}" alt="portfolio image"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Lahore'])}}" >Lahore</a>
                                                        <p><span>{{count($lahore)}}</</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-4">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g4.jpg') }}" alt="portfolio image" style="height: 250px"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Rawalpindi'])}}" > Rawalpindi</a>
                                                        <p><span>{{count($Rawalpindi)}}</</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-4">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g5.jpg') }}" alt="portfolio image" style="height: 250px"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Attock'])}}" > Attock</a>
                                                        <p><span>{{count($attock)}}</</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-md-8">
                                                <div class="filtr-item">
                                                    <img src="{{ url('../resources/indexpageresources/images/gallery/g6.jpg') }}" alt="portfolio image" style="height: 377px"/>
                                                    <div class="item-title">
                                                        <a href="{{ url('cities', ['city'=> 'Faisalabad'])}}">faisalabad</a>
                                                        <p><span>{{count($Faisalabad)}}</span></p>
                                                    </div>
                                                </div>
                                            </div>
    
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="pack" class="packages">
                <div class="container">
                    <div class="gallary-header text-center">
                        <h2>Top Hostels</h2>
                    </div> 
                    @foreach ($hostelInformations as $hostelInformation)
                        <div class="col-md-4 col-sm-6">
                            <div class="single-package-item">
                                @php
                                    $directory = public_path().'/graphics/hostel'.($hostelInformation->hostel_id);
                                    if(is_dir($directory))
                                    {
                                        $dh = opendir($directory);
                                        while (false !== ($fileName = readdir($dh))) 
                                        {
                                            $path = "";
                                            if (is_file($directory."/".$fileName))
                                            {
                                                $path = "/graphics/hostel".$hostelInformation->hostel_id."/".$fileName;
                                                $data = '<img src="'.url($path).'" alt="hotel img" style="height: 250px"/>';
                                                break;
                                            }
                                            else 
                                            {
                                                $path = "/graphics/defaulthostelimage.jpg";
                                                $data = '<img src="'.url($path).'" alt="hotel img" style="height: 250px"/>';
                                                break;    
                                            }
                                        }
                                        closedir($dh);
                                    }
                                @endphp
                                {!!$data!!}
                                <div class="single-package-item-txt">
                                    <h4 style="padding-top: 5px">{{$hostelInformation->hostel_name}} <span class="pull-right">Rs{{$hostelInformation->hostel_rent}}</span></h4>
                                    <div class="packages-para">
                                        <p>
                                            <span><i class="fa fa-angle-double-right"></i>{{$hostelInformation->hostel_city}}</span>
                                            <i class="fa fa-angle-double-right"></i>{{$hostelInformation->hostel_province}} 
                                        </p>
                                        <p>
                                            <span><i class="fa fa-angle-double-right"></i>{{$hostelInformation->hostel_category}}</span>
                                            <i class="fa fa-angle-double-right"></i>food facilities
                                        </p>
                                    </div>
                                    <div class="packages-review">
                                        <p>
                                            @if($review->getRating($hostelInformation->hostel_id) == 0)
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($review->getRating($hostelInformation->hostel_id) == 1)
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($review->getRating($hostelInformation->hostel_id) == 2)
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($review->getRating($hostelInformation->hostel_id) == 3)
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($review->getRating($hostelInformation->hostel_id) == 4)
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star"></i>
                                            @elseif($review->getRating($hostelInformation->hostel_id) == 5)
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                                <i class="fa fa-star myRatingStar""></i>
                                                <i class="fa fa-star myRatingStar"></i>
                                            @endif
                                            <span>{{$review->getHostelRatingCount($hostelInformation->hostel_id)}} Ratings</span>
                                        </p>
                                    </div>
                                    <div class="about-btn">
                                        <a class="about-view packages-btn" href="{{ url('show',['id' => encrypt($hostelInformation->hostel_id)]) }}">book now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="container">
                        <div class="row col-md-12 col-sm-12 ml-3">
                            {!! $hostelInformations->appends(Request::all())->render()!!}
                        </div>
                    </div>
                </div>
            </section>
           
            @include('includes.showsearchfooter')
         
            <script src="{{ asset('js/indexjs/jquery.js') }}"></script>
            <!--bootstrap.min.js-->
<script  src="{{ asset('js/indexjs/bootstrap.min.js') }}"></script>
    
<!-- bootsnav js -->
<script src="{{ asset('js/indexjs/bootsnav.js') }}"></script>

<!-- jquery.filterizr.min.js -->
<script src="{{ asset('js/indexjs/jquery.filterizr.min.js') }}"></script>

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

<!--jquery-ui.min.js-->
<script src="{{ asset('js/indexjs/jquery-ui.min.js') }}"></script>

<!-- counter js -->
<script src="{{ asset('js/indexjs/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/indexjs/waypoints.min.js') }}"></script>

<!--owl.carousel.js-->
<script  src="{{ asset('js/indexjs/owl.carousel.min.js') }}"></script>

<!-- jquery.sticky.js -->
<script src="{{ asset('js/indexjs/jquery.sticky.js') }}"></script>

<!--datepicker.js-->
<script  src="{{ asset('js/indexjs/datepicker.js') }}"></script>

<!--Custom JS-->
<script src="{{ asset('js/indexjs/custom.js') }}"></script>
   
</body>
</html>