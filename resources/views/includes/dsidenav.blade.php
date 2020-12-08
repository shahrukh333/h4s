<span id="sidenavcursor" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
<div id="mySidenav" class="container float-left bg-sidenav sidenav" style="height: 500px">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul class="navbar-nav">
        <li class="nav-item mt-4">
            <a class="nav-link" href="{{ url('dashboard') }}"><i class="fa fa-home mr-3"></i>Dashboard</a>
        </li>

        @if(Auth::user()->type != 'A')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('hostelRegistration') }}"><i class="fa fa-pencil-square-o mr-3"></i>Register Hostel</a>
            </li>

            @if(session('booking'))
                @if(session('bookingNotification'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('myBooking') }}"><i class="fa fa-tasks mr-3"></i>My Booking<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                    </li>
                @else 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('myBooking') }}"><i class="fa fa-tasks mr-3"></i>My Booking</a>
                    </li>
                @endif
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-tasks mr-3"></i>Book Hostel</a>
                </li>    
            @endif

        @else
            @if(session('complainedHostel'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('adminHostelComplaints') }}"><i class="fa fa-edit mr-3"></i>Hostel Complaints<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('adminHostelComplaints') }}"><i class="fa fa-edit mr-3"></i>Hostel Complaints</a>
                </li>
            @endif

            @if(session('warnedHostel'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('warnedHostels') }}"><i class="fa fa-edit mr-3"></i>Hostel Warnings<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('warnedHostels') }}"><i class="fa fa-edit mr-3"></i>Hostel Warnings</a>
                </li>
            @endif
            @if(session('blockedHostel'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('blockedHostels') }}"><i class="fa fa-home mr-3"></i>Blocked Hostels<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
                </li>
            @else 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('blockedHostels') }}"><i class="fa fa-home mr-3"></i>Blocked Hostels</a>
                </li>
            @endif
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ url('editprofile') }}"><i class="fa fa-cog mr-3"></i>Edit Profile</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out mr-3"></i>{{ __('Logout') }}
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>