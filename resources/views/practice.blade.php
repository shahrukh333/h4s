<!DOCTYPE html>
<html class="no-js"  lang="en">

	<head>
		<!-- META DATA -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<!--font-family -->
		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

		<!-- TITLE OF SITE -->
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
		<!-- favicon img -->
		<link rel="shortcut icon" type="image/icon" href="{{ url('graphics/favicon.png') }}"/>

		<!--font-awesome.min.css-->
		<link rel="stylesheet" href="{{ asset('css/indexcss/font-awesome.min.css') }}" /> 

		<!--animate.css -->
		<link rel="stylesheet" href="{{ asset('css/indexcss/animate.css') }}" />

		<!--hover.css -->
		<link rel="stylesheet" href="{{ asset('css/indexcss/hover-min.css') }}">

		

		<!--owl.carousel.css -->
        <link rel="stylesheet" href="{{ asset('css/indexcss/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/indexcss/owl.theme.default.min.css') }}"/>

		<!-- range css-->
        <link rel="stylesheet" href="{{ asset('css/indexcss/jquery-ui.min.css') }}" />

		<!--bootstrap.min.css-->
		<link rel="stylesheet" href="{{ asset('css/indexcss/bootstrap.min.css') }}" />

		<!-- bootsnav -->
		<link rel="stylesheet" href="{{ asset('css/indexcss/bootsnav.css') }}"/>

		<!--style.css-->
		<link rel="stylesheet" href="{{ asset('css/indexcss/style.css') }}" />

		<!--responsive.css-->
		<link rel="stylesheet" href="{{ asset('css/indexcss/responsive.css') }}" />

    </head>
    
    <body>
        @include('includes.indexnavbar')
        <!--about-us start -->
        <section id="home" class="about-us">

            <div class="container">
                <div class="about-us-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="single-about-us">
                                <div class="about-us-txt">
                                                <!-- main-menu Start -->
                                </div><!--/.about-us-txt-->
                            </div><!--/.single-about-us-->
                        </div><!--/.col-->
                        <div class="col-sm-0">
                            <div class="single-about-us">
                                
                            </div><!--/.single-about-us-->
                        </div><!--/.col-->
                    </div><!--/.row-->
                </div><!--/.about-us-content-->
            </div><!--/.container-->
        </section><!--/.about-us-->
        <!--about-us end -->
    
        <!--travel-box start-->
        <section  class="travel-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-travel-boxes">
                            <div id="desc-tabs" class="desc-tabs">

                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation">
                                        <a href="#hostels" aria-controls="hostels" role="tab" data-toggle="tab">
                                            <i class="fa fa-building"></i>
                                            hostel
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

                                                        <h2>destination</h2>

                                                        <div class="travel-select-icon">
                                                            <select class="form-control ">
                                                                    <option valucitye="default">enter your destination </option><!-- /.option-->
                                                                    <option value="Islamabad">Islamabad</option><!-- /.option-->
                                                                    <option value="Lahore">Lahore</option><!-- /.option-->
                                                                    <option value="kharachi">kharachi</option><!-- /.option-->

                                                            </select><!-- /.select-->
                                                        </div><!-- /.travel-select-icon -->

                                                        <div class="travel-select-icon">
                                                            <h2>Category</h2>
                                                            <select class="form-control ">
                                                                    <option value="default">Select your hostel Category</option><!-- /.option-->
                                                                    <option value="Male-hostel">Male-hostel</option><!-- /.option-->
                                                                    <option value="Female-hostel">female-hostel</option><!-- /.option-->                                                                    
                                                            </select><!-- /.select-->
                                                        </div><!-- /.travel-select-icon -->

                                                    </div><!--/.single-tab-select-box-->
                                                </div><!--/.col-->

                                                <div class="col-lg-2 col-md-3 col-sm-4">
                                                    <div class="single-tab-select-box">
                                                        <h2>check in</h2>
                                                        <div class="travel-check-icon">
                                                            <form action="#">
                                                                <input type="date" name="check_in" class="form-control" data-toggle="datepicker" placeholder="12 -01 - 2017 ">
                                                            </form>
                                                        </div><!-- /.travel-check-icon -->
                                                    </div><!--/.single-tab-select-box-->
                                                </div><!--/.col-->

                                                <div class="col-lg-2 col-md-1 col-sm-4">
                                                    <div class="single-tab-select-box">
                                                        <h2>duration</h2>
                                                        <div class="travel-select-icon">
                                                            <select class="form-control ">
                                                                    <option value="default">5</option><!-- /.option-->
                                                                    <option value="10">10</option><!-- /.option-->
                                                                    <option value="15">15</option><!-- /.option-->
                                                                    <option value="20">20</option><!-- /.option-->
                                                            </select><!-- /.select-->
                                                        </div><!-- /.travel-select-icon -->
                                                    </div><!--/.single-tab-select-box-->
                                                </div><!--/.col-->

                                                <div class="col-lg-2 col-md-1 col-sm-4">
                                                    <div class="single-tab-select-box">
                                                        <h2>people</h2>
                                                        <div class="travel-select-icon">
                                                            <select class="form-control ">
                                                                    <option value="default">1</option><!-- /.option-->
                                                                    <option value="2">2</option><!-- /.option-->
                                                                    <option value="4">4</option><!-- /.option-->
                                                                    <option value="8">8</option><!-- /.option-->
                                                            </select><!-- /.select-->
                                                        </div><!-- /.travel-select-icon -->
                                                    </div><!--/.single-tab-select-box-->
                                                </div><!--/.col-->

                                            </div><!--/.row-->

                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="travel-budget">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-4">
                                                                <h3>budget : </h3>
                                                            </div><!--/.col-->
                                                            <div class="co-md-9 col-sm-8">
                                                                <div class="travel-filter">
                                                                    <div class="info_widget">
                                                                        <div class="price_filter">
                                                                            
                                                                            <div id="slider-range"></div><!--/.slider-range-->

                                                                            <div class="price_slider_amount">
                                                                                <input type="text" id="amount" name="price"  placeholder="Add Your Price" />
                                                                            </div><!--/.price_slider_amount-->
                                                                        </div><!--/.price-filter-->
                                                                    </div><!--/.info_widget-->
                                                                </div><!--/.travel-filter-->
                                                            </div><!--/.col-->
                                                        </div><!--/.row-->
                                                    </div><!--/.travel-budget-->
                                                </div><!--/.col-->
                                                <div class="clo-sm-7">
                                                    <div class="about-btn travel-mrt-0 pull-right">
                                                        <button  class="about-view travel-btn">
                                                            search	
                                                        </button><!--/.travel-btn-->
                                                    </div><!--/.about-btn-->
                                                </div><!--/.col-->
                                            </div><!--/.row-->
                                        </div><!--/.tab-para-->
                                    </div><!--/.tabpannel-->
                    </div><!--/.col-->
                </div><!--/.row-->
            </div><!--/.container-->
        </section><!--/.travel-box-->
            <!--travel-box end-->
            
            <!--galley start-->
        <section id="gallery" class="gallery">
            <div class="container">
                <div class="gallery-details">
                    <div class="gallary-header text-center">
                        <h2>
                            Top destination
                        </h2>
                        <p>
                            
                        </p>
                    </div><!--/.gallery-header-->
                    <div class="gallery-box">
                        <div class="gallery-content">
                                <div class="filtr-container">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g1.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    Islamabad
                                                </a>
                                                <p><span>15 places</span></p>
                                            </div><!-- /.item-title -->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                        <div class="col-md-6">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g2.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    karachi
                                                </a>
                                                <p><span>9 places</span></p>
                                            </div> <!-- /.item-title-->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                        <div class="col-md-4">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g3.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    Lahore
                                                </a>
                                                <p><span>10 places</span></p>
                                            </div><!-- /.item-title -->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                        <div class="col-md-4">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g4.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    Rawalpindi
                                                </a>
                                                <p><span>9 places</span></p>
                                            </div> <!-- /.item-title-->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                        <div class="col-md-4">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g5.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    Attock
                                                </a>
                                                <p><span>12 places</span></p>
                                            </div> <!-- /.item-title-->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                        <div class="col-md-8">
                                            <div class="filtr-item">
                                            <img src="{{ url('../resources/indexpageresources/images/gallery/g6.jpg') }}" alt="portfolio image"/>
                                            <div class="item-title">
                                                <a href="#">
                                                    faisalabad
                                                </a>
                                                <p><span>6 places</span></p>
                                            </div> <!-- /.item-title-->
                                        </div><!-- /.filtr-item -->
                                        </div><!-- /.col -->

                                    </div><!-- /.row -->

                                </div><!-- /.filtr-container-->
                        </div><!-- /.gallery-content -->
                    </div><!--/.galley-box-->
                </div><!--/.gallery-details-->
            </div><!--/.container-->
        </section><!--/.gallery-->
            <!--gallery end-->
    
            
    
            <!--packages start-->
            <section id="pack" class="packages">
                <div class="container">
                    <div class="gallary-header text-center">
                        <h2>
                            Top Hostels
                        </h2>
                        <p>
                             
                        </p>
                    </div><!--/.gallery-header-->
                    <div class="packages-content">
                        <div class="row">
    
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p1.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3>Islamabad <span class="pull-right">14499</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Girls Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i>  Near Comsat  
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  laundry
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>75 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
    
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p2.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3>Lahore <span class="pull-right">9999</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Boys Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i>  Near LUMS
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  laundry
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>44 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
                            
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p3.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3>Islamabad <span class="pull-right">11999</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Boys Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i>  Near Nust
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  laundry
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>41 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
                            
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p4.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3> Faisalabad<span class="pull-right">17999</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Boys Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i> Arid University
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  laundary
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>33 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
                            
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p5.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3>Karachi <span class="pull-right">11999</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Boys Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i>karachi university
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  transportation
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>25 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
                            
                            <div class="col-md-4 col-sm-6">
                                <div class="single-package-item">
                                    <img src="{{ url('../resources/indexpageresources/images/packages/p6.jpg') }}" alt="package-place">
                                    <div class="single-package-item-txt">
                                        <h3>Attock <span class="pull-right">8999</span></h3>
                                        <div class="packages-para">
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i> Boys Hostel
                                                </span>
                                                <i class="fa fa-angle-right"></i>  Near Comsats
                                            </p>
                                            <p>
                                                <span>
                                                    <i class="fa fa-angle-right"></i>  laundary
                                                </span>
                                                <i class="fa fa-angle-right"></i>  food facilities
                                             </p>
                                        </div><!--/.packages-para-->
                                        <div class="packages-review">
                                            <p>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <span>22 review</span>
                                            </p>
                                        </div><!--/.packages-review-->
                                        <div class="about-btn">
                                            <button  class="about-view packages-btn">
                                                book now
                                            </button>
                                        </div><!--/.about-btn-->
                                    </div><!--/.single-package-item-txt-->
                                </div><!--/.single-package-item-->
    
                            </div><!--/.col-->
    
                        </div><!--/.row-->
                    </div><!--/.packages-content-->
                </div><!--/.container-->
    
            </section><!--/.packages-->
            <!--packages end-->
            @include('includes.indexfooter')
    
            <script src="{{ asset('js/indexjs/jquery.js') }}"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
    
            <!--modernizr.min.js-->
            
    
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