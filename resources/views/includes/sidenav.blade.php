<span id="sidenavcursor" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
 
<div id="mySidenav" class="container float-left bg-sidenav sidenav">
    <div style="margin-top: 30px;"></div>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul class="navbar-nav">
        @if(session('hostel')->status == 'Blocked')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fa fa-home mr-3 dis"></i>Dashboard</a>
            </li>

            <li class="nav-item text-light mt-3">
                <i class="fa fa-info-circle mr-3"></i>Hostel Information
            </li>

            <li class="nav-item text-light mt-4">
                <i class="fa fa-wifi mr-3"></i>Hostel Facilities
            </li>

            @if(!session('isManager'))
                <li class="nav-item text-light mt-4">
                    <i class="fa fa-users mr-3"></i>Hostel Manager
                </li>
            @else 
                <li class="nav-item text-light mt-4">
                    <i class="fa fa-users mr-3"></i>Leave Job
                </li>
            @endif

            @if(session('bookingRequest'))
            <li class="nav-item text-light mt-4">
                <i class="fa fa-key mr-3" aria-hidden="true"></i>Requests<span class="badge badge-pill badge-danger text-danger ml-1">.</span>
            </li>
            @else 
                <li class="nav-item text-light mt-4">
                    <i class="fa fa-key mr-3" aria-hidden="true"></i>Requests
                </li>
            @endif

            <li class="nav-item text-light mt-4">
               <i class="fa fa-bullhorn mr-3"></i>Hostel Rules
            </li>

            <li class="nav-item text-light mt-4">
                <i class="fa fa-bed mr-3" aria-hidden="true"></i>Hostel Rooms
            </li>

            <li class="nav-item text-light mt-4">
                <i class="fa fa-cutlery mr-3"></i>Mess Menu
            </li>

            <li class="nav-item text-light mt-4">
                <i class="fa fa-money mr-3"></i>Hosteller Dues
            </li>

            @if(session('complaint'))
                <li class="nav-item mt-2">
                    <a class="nav-link" href="{{ url('Complaint') }}"><i class="fa fa-edit mr-3"></i>Complaints<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Complaint') }}"><i class="fa fa-edit mr-3"></i>Complaints</a>
                </li>
            @endif

            @if(session('review'))
                <li class="nav-item text-light mt-3">
                    <i class="fa fa-star mr-3"></i>{{ __('Reviews ') }}<span class="badge badge-pill badge-danger text-danger ml-1">.</span>
                </li>
            @else 
                <li class="nav-item text-light mt-2">
                   <i class="fa fa-star mr-3"></i>{{ __('Reviews ') }}
                </li>
            @endif

            @if(session('query'))
                <li class="nav-item text-light mt-4">
                    <i class="fa fa-question-circle mr-3"></i>Queries<span class="badge badge-pill badge-danger text-danger ml-1">.</span>
                </li>
            @else 
                <li class="nav-item text-light mt-4">
                    <i class="fa fa-question-circle mr-3"></i>Queries
                </li>
            @endif
        @else 
            <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}"><i class="fa fa-home mr-3 dis"></i>Dashboard</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('hostelInformation') }}"><i class="fa fa-info-circle mr-3"></i>Hostel Information</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('getHostelFacilities') }}"><i class="fa fa-wifi mr-3"></i>Hostel Facilities</a>
            </li>

            @if(!session('isManager'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('getHostelManager') }}"><i class="fa fa-users mr-3"></i>Hostel Manager</a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('leaveHostel') }}"><i class="fa fa-users mr-3"></i>Leave Job</a>
                </li>
            @endif

            @if(session('bookingRequest'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('BookingRequest') }}"><i class="fa fa-key mr-3" aria-hidden="true"></i>Requests<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
            </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('BookingRequest') }}"><i class="fa fa-key mr-3" aria-hidden="true"></i>Requests</a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ url('Rules') }}"><i class="fa fa-bullhorn mr-3"></i>Hostel Rules</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('hostelRoom') }}"><i class="fa fa-bed mr-3" aria-hidden="true"></i>Hostel Rooms</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('Mess') }}"><i class="fa fa-cutlery mr-3"></i>Mess Menu</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('hostelDuesData') }}"><i class="fa fa-money mr-3"></i>Hosteller Dues</a>
            </li>

            @if(session('complaint'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Complaint') }}"><i class="fa fa-edit mr-3"></i>Complaints<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Complaint') }}"><i class="fa fa-edit mr-3"></i>Complaints</a>
                </li>
            @endif

            @if(session('review'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Review') }}"><i class="fa fa-star mr-3"></i>{{ __('Reviews ') }}<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Review') }}"><i class="fa fa-star mr-3"></i>{{ __('Reviews ') }}</a>
                </li>
            @endif

            @if(session('query'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Query') }}"><i class="fa fa-question-circle mr-3"></i>Queries<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('Query') }}"><i class="fa fa-question-circle mr-3"></i>Queries</a>
                </li>
            @endif
        @endif
        
    </ul>
</div>