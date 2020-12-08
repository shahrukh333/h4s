@extends('layouts.showsearchlayout')
@section('content')
<div class="htlfndr-loader-overlay"></div>
<div class="htlfndr-wrapper">
	<div class="container"  style=" margin-top:20px ;">
        <div class="htlfndr-steps">
            <ul class="htlfndr-progress">
                <li><a href="{{url('/')}}">
                    <span class="htlfndr-step-number">1</span> <span class="htlfndr-step-description">Index</span></a>
                </li>
                <li><a href="javascript:history.go(-1)">
                    <span class="htlfndr-step-number">2</span> <span class="htlfndr-step-description">Search</span></a>
                </li>
                <li class="htlfndr-active-step">
                    <span class="htlfndr-step-number">3</span> <span class="htlfndr-step-description">{{$hostelInformation->first()->hostel_name}}</span>
                </li>
            </ul>
        </div>
        <div class="row htlfndr-page-content">
            <main id="htlfndr-main-content" class="col-sm-12 col-md-8 col-lg-9 post htlfndr-hotel-single-content" role="main">
                <section id="htlfndr-gallery-and-map-tabs">
                    <ul><li><a href="#htlfndr-gallery-tab-1">Hostel Images</a></li></ul>
                    <div id="htlfndr-gallery-tab-1" class="htlfndr-hotel-gallery" style="max-height: 500px">
                        <div id="htlfndr-gallery-synced-1" class="htlfndr-gallery-carousel">
                            {!! $data !!}
                        </div>
                    </div>
                </section>
                <section id="htlfndr-hotel-description-tabs">
                    <ul>
                        <li class="active" data-number="0"><a href="#htlfndr-hotel-description-tab-1">description</a></li>
                        <li data-number="1"><a href="#htlfndr-hotel-description-tab-2">availability</a></li>
                        <li data-number="2"><a href="#htlfndr-hotel-description-tab-3">facilities</a></li>
                        <li data-number="3"><a href="#htlfndr-hotel-description-tab-4">reviews</a></li>
                    </ul>
                    <div id="htlfndr-hotel-description-tab-1" class="htlfndr-hotel-description-tab">
                        <div class="row">
                            <div class="col-md-5 htlfndr-description-table">
                                <table>
                                    <tr>
                                        <th scope="row">type:</th>
                                        <td>hostel</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">hostel Category</th>
                                        <td>{{$hostelInformation->first()->hostel_category}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">city</th>
                                        <td>{{$hostelInformation->first()->hostel_city }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">address</th>
                                    <td>{{$hostelInformation->first()->hostel_street}} {{$hostelInformation->first()->hostel_address_line}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">phone no</th>
                                        <td>{{$hostelInformation->first()->phone_number}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">land mark </th>
                                        <td>{{$hostelInformation->first()->landmarks}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">estimate rent </th>
                                        <td>{{$hostelInformation->first()->hostel_rent}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">rent period</th>
                                        <td>{{$hostelInformation->first()->rent_period}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-7 htlfndr-description-right-side">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">Description</h4>
                                    </div>
                                </div>
                                <blockquote>
                                    <p>{{$hostelInformation->first()->hostel_description}}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div id="htlfndr-hotel-description-tab-2" class="htlfndr-hotel-description-tab">
                        <aside class="htlfndr-sidebar-in-top htlfndr-short-form">
                            @php
                                $rooms = $room->getRooms($hostelInformation->first()->hostel_id);
                                $capacity = 0;
                                $available = 0;
                                if(count($rooms) > 0)
                                {
                                    if(count($rooms) > 1)
                                    {
                                        foreach ($rooms as $rm)
                                        {
                                            if($rm->capacity > $rm->occupied)
                                            {
                                                $cap = $rm->capacity - $rm->occupied;
                                                $available = $available + $cap;
                                            }
                                            $capacity = $capacity + $rm->capacity;
                                        }
                                    }
                                    else 
                                    {
                                        if($rooms->first()->capacity > $rooms->first()->occupied)
                                        {
                                            $cap = $rooms->first()->capacity - $rooms->first()->occupied;
                                            $available = $available + $cap;
                                        }
                                        $capacity = $capacity + $rooms->first()->capacity;
                                    }
                                }
                            @endphp
                            <div class="htlfndr-description-table">
                                <table>
                                    <tr>
                                        <th scope="row">Total Rooms in hostel</th>
                                        <td>{{count($room->getRooms($hostelInformation->first()->hostel_id))}} Room</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Seats in hostel</th>
                                        <td>{{$capacity}} Seat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Available seats  in hostel</th>
                                        <td>{{$available}} Seat</td>
                                    </tr>
                                </table>
                            </div>
                        </aside>
                    </div>
                    <div id="htlfndr-hotel-description-tab-3" class="htlfndr-hotel-description-tab">
                        <article class="htlfndr-tab-article htlfndr-third-tab-post">
                            <header>
                                <h3>Facilities of {{$hostelInformation->first()->name}}</h3>
                            </header>
                            <footer class="row htlfndr-amenities">
                                @if($hostelFacilities->wifi == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-wifi"></i>
                                        </div>
                                        <p>Wi-Fi internet</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->mess == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-cutlery"></i>
                                        </div>
                                        <p>Mess</p>
                                    </div>
                                @endif
                                
                                @if($hostelFacilities->cc_camera == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                        <p>CC Camera</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->tv == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-square-o"></i>
                                        </div>
                                        <p>TV</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->laundry == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                        <p>Laundry</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->power_backup == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-archive"></i>
                                        </div>
                                        <p>Power Backup</p>
                                    </div>
                                @endif
                                
                                @if($hostelFacilities->daily_clean == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-arrow-circle-right"></i>
                                        </div>
                                        <p>Daily Clean</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->iron == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-columns"></i>
                                        </div>
                                        <p>Iron</p>
                                    </div>
                                @endif
                                
                                @if($hostelFacilities->geyser == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-columns"></i>
                                        </div>
                                        <p>geyser</p>
                                    </div>
                                @endif

                                @if($hostelFacilities->parking == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-columns"></i>
                                        </div>
                                        <p>Parking</p>
                                    </div>
                                @endif
                                
                                @if($hostelFacilities->refrigerator == 'Yes')
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="htlfndr-amenities-icon">
                                            <i class="fa fa-square-o"></i>
                                        </div>
                                        <p>Refrigerator</p>
                                    </div>
                                @endif
                            
                            </footer>
                        </article>
                    </div>
                    <div id="htlfndr-hotel-description-tab-4" class="htlfndr-hotel-description-tab">
                        @php 
                            $reviews = $review->getHostelTwoReviews($hostelInformation->first()->hostel_id);
                            $rev = $review->getHostelAllRatings($hostelInformation->first()->hostel_id);
                            $hostelReviewCount = $review->getHostelRatingCount($hostelInformation->first()->hostel_id);
                            $totalRatings = 0;
                        @endphp
                        <div class="htlfndr-hotel-marks">
                            <div class="htlfndr-overview-rating">
                                <div class="htlfndr-rating-stars">
                                    <i class="fa fa-star htlfndr-star-color"></i>
                                    <i class="fa fa-star htlfndr-star-color"></i>
                                    <i class="fa fa-star htlfndr-star-color"></i>
                                    <i class="fa fa-star htlfndr-star-color"></i>
                                    <i class="fa fa-star htlfndr-star-color"></i>
                                </div> 
                                <dl>
                                    @if($hostelReviewCount > 0)
                                        @if(count($rev) > 0)
                                            @foreach($rev as $r)
                                                @php
                                                    $totalRatings = $totalRatings + $r->rating;
                                                @endphp
                                            @endforeach
                                        @else 
                                            $totalRatings = $totalRatings + $rev->first()->rating;
                                        @endif
                                        <dt><span>{{$totalRatings/$hostelReviewCount}}</span> out of 5</dt>
                                        <dd>based on <span>{{$hostelReviewCount}}</span> Reviews</dd>
                                    @else
                                        <dt><span>0</span> out of 5</dt>
                                        <dd>based on <span>0</span> Reviews</dd>
                                    @endif
                                </dl> 
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        @if(count($reviews) > 0)
                            @if(count($reviews) > 1)
                                @foreach($reviews as $rv)
                                    <div class="htlfndr-visitor-review">
                                        <div class="htlfndr-review-left-side">
                                            <dl><dt>{{$user->getUserName($rv->hosteller_id)}}</dt></dl>
                                        </div>
                                        <div class="htlfndr-review-right-side">
                                            <article class="htlfndr-visitor-post">
                                                <header>
                                                    @if($rv->rating == 1)
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                    @elseif($rv->rating == 2)
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                    @elseif($rv->rating == 3)
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                    @elseif($rv->rating == 4)
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg"></i>
                                                    @elseif($rv->rating == 5)
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                        <i class="fa fa-star fa-lg text-warning"></i>
                                                    @endif
                                                    <p>{{$rv->review}}</p>
                                                    <h6>Rating date {{$rv->created_at}}</h6>
                                                </header>
                                            </article>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <div class="htlfndr-visitor-review">
                                    <div class="htlfndr-review-left-side">
                                        <dl><dt>{{$user->getUserName($reviews->first()->hosteller_id)}}</dt></dl>
                                    </div>
                                    <div class="htlfndr-review-right-side">
                                        <article class="htlfndr-visitor-post">
                                            <header>
                                                @if($reviews->first()->rating == 1)
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                @elseif($reviews->first()->rating == 2)
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                @elseif($reviews->first()->rating == 3)
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                @elseif($reviews->first()->rating == 4)
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg"></i>
                                                @elseif($reviews->first()->rating == 5)
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                    <i class="fa fa-star fa-lg text-warning"></i>
                                                @endif
                                                <p>{{$reviews->first()->review}}</p>
                                                <h6>Rating date {{$reviews->first()->created_at}}</h6>
                                            </header>
                                        </article>
                                    </div>
                                </div>
                            @endif
                        @else
                            no reviews
                        @endif
                    </div>
                </section>
            </main>

            <aside id="htlfndr-right-sidebar" class="col-sm-12 col-md-4 col-lg-3 htlfndr-sidebar htlfndr-sidebar-in-right" role="complementary" style="margin-top: 30px">
                <p class="htlfndr-add-to-wishlist"></p>
                <div class="widget htlfndr-hotel-visit-card mt-3" >
                    <div class="htlfndr-widget-main-content htlfndr-widget-padding">
                        <div class="htlfndr-hotel-description">
                            <h4>{{$hostelInformation->first()->hostel_name}}</h4>
                            <h5 class="htlfndr-hotel-location"><a><i class="fa fa-map-marker"></i>{{$hostelInformation->first()->hostel_street}} {{$hostelInformation->first()->hostel_address_line}} ,{{$hostelInformation->first()->hostel_city}}</a></h5>
                        </div>
                        <div class="htlfndr-hotel-price"><span class="htlfndr-from">Estimate Rent</span> <span class="htlfndr-cost">{{$hostelInformation->first()->hostel_rent }}</span> </div> <!-- .htlfndr-hotel-price -->
                    </div>
                </div>

                <div class="widget htlfndr-near-properties">
                    <div class="htlfndr-widget-main-content">
                        <h3 class="widget-title">properties	near</h3>
                        @if(count($nearhostels) > 0)
                            @if(count($nearhostels) > 1)
                                @foreach ($nearhostels as $nearhostel)
                                    @if($hostelInformation->first()->hostel_id != $nearhostel->hostel_id)
                                        <a  href="{{ url('show', ['id'=> encrypt($nearhostel->hostel_id)])}}">
                                            <div class="htlfdr-hotel-post">
                                                <div class="htlfndr-post-inner htlfndr-table-view">
                                                    <div class="htlfndr-hotel-thumbnail">
                                                        @php
                                                        $directory = public_path().'/graphics/hostel'.($nearhostel->hostel_id);
                                                        if(is_dir($directory))
                                                        {
                                                            $path = "";
                                                            $dh = opendir($directory);
                                                            while (false !== ($fileName = readdir($dh))) 
                                                            {
                                                                if (is_file($directory."/".$fileName))
                                                                {
                                                                    $path = "/graphics/hostel".$nearhostel->hostel_id."/".$fileName;
                                                                    $data = '<img src="'.url($path).'" alt="hotel img" height="50" style="height: 50px"/>';
                                                                    break;
                                                                }
                                                            }
                                                            closedir($dh);
                                                            if($path == "")
                                                            {
                                                                $path = "/graphics/defaulthostelimage.jpg";
                                                                $data = '<img src="'.url($path).'" alt="hotel img" style="height: 200px"/>';
                                                            }
                                                        }
                                                        @endphp
                                                        {!!$data!!}
                                                    </div>
                                                    <div class="htlfndr-hotel-info">
                                                        <p>{{$nearhostel->hostel_name}}</p>
                                                        <p class="htlfndr-hotel-price"><span>{{$nearhostel->hostel_category}}</span></p>
                                                        <p class="htlfndr-hotel-price"><span>Rent</span>
                                                            <span>{{$nearhostel->hostel_rent}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            @else 
                                <a  href="{{ url('show', ['id'=> encrypt($nearhostels->first()->hostel_id)])}}">
                                    <div class="htlfdr-hotel-post">
                                        <div class="htlfndr-post-inner htlfndr-table-view">
                                            <div class="htlfndr-hotel-thumbnail">
                                                @php
                                                $directory = public_path().'/graphics/hostel'.($nearhostels->first()->hostel_id);
                                                if(is_dir($directory))
                                                {
                                                    $path = "";
                                                    $dh = opendir($directory);
                                                    while (false !== ($fileName = readdir($dh))) 
                                                    {
                                                        if (is_file($directory."/".$fileName))
                                                        {
                                                            $path = "/graphics/hostel".$nearhostels->first()->hostel_id."/".$fileName;
                                                            $data = '<img src="'.url($path).'" alt="hotel img" height="50" style="height: 50px"/>';
                                                            break;
                                                        }
                                                    }
                                                    closedir($dh);
                                                    if($path == "")
                                                    {
                                                        $path = "/graphics/defaulthostelimage.jpg";
                                                        $data = '<img src="'.url($path).'" alt="hotel img" style="height: 200px"/>';
                                                    }
                                                }
                                                @endphp
                                                {!!$data!!}
                                            </div>
                                            <div class="htlfndr-hotel-info">
                                                <p>{{$nearhostels->first()->hostel_name}}</p>
                                                <p class="htlfndr-hotel-price"><span>{{$nearhostels->first()->hostel_category}}</span></p>
                                                <p class="htlfndr-hotel-price"><span>Rent</span>
                                                    <span>{{$nearhostels->first()->hostel_rent}}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @else 
                            <span>No near hostel found</span>
                        @endif
                    </div>
                </div>
            </aside>
        </div>

        <div class="widget htlfndr-hotel-visit-card" style="margin-top: -70px; margin-bottom: 100px">
            @if((count($room->getRooms($hostelInformation->first()->hostel_id)) > 0) && ($available > 0))
                <form action="{{ url('bookHostel') }}" method="POST">
                    @csrf
                    <span class="ml-2 mt-2">Enter check in date</span>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="checkin"class="form-control"/>
                        </div>
                    </div>
                    <span class="ml-2 mt-2">Enter checkout date</span>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="checkout" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-sm-10">
                            <input type="hidden" name="hostelId" value="{{$hostelInformation->first()->hostel_id}}"/>
                            <button type="submit" class="btn btn-primary">book Now</a>
                        </div>
                    </div>
                    <span class="ml-2 mt-2 bg-error">@include('includes.messages')</span>
                </form>
            @else 
                <span class="text-danger font-weight-bold h4 pt-4">No space available</span>
            @endif
        </div>
	</div>
</div>
@endsection