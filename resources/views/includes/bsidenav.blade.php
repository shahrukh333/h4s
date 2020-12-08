
<span id="sidenavcursor" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

<div id="mySidenav" class="container float-left bg-sidenav sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}"><i class="fa fa-home mr-3"></i>Dashboard</a>
        </li>

        @if(session('notification'))
            <li class="nav-item">
                <a class="nav-link" href="{{ url('myNotifications') }}"><i class="fa fa-bell mr-3"></i>{{ __('Notifications') }}<span class="badge badge-pill badge-danger text-danger ml-1">.</span></a>
            </li>
        @else 
            <li class="nav-item">
                <a class="nav-link" href="{{ url('myNotifications') }}"><i class="fa fa-bell mr-3"></i>{{ __('Notifications') }}</a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/booking') }}"><i class="fa fa-tasks mr-3"></i>Manage Booking</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('hostelRules') }}"><i class="fa fa-calendar mr-3"></i>Show Hostel Rules</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('hostelMessMenu') }}"><i class="fa fa-cutlery mr-3"></i>Show Mess Menu</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('myHostelDues') }}"><i class="fa fa-money mr-3"></i>Show My Dues</a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
              <i class="fa fa-pencil-square-o mr-3"></i>
              <span>Complaint</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a style="color:black" class="ml-3 nav-link" href="{{ url('hostelComplaint') }}">Register Complaint</a>
                <a style="color:black" class="ml-3 nav-link" href="{{ url('myComplaints') }}">My Complaints</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
              <i class="fa fa-star mr-3"></i>
              <span>Review</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a style="color:black" class="ml-3 nav-link" href="{{ url('reviewHostel') }}">Register Review</a>
                <a style="color:black" class="ml-3 nav-link" href="{{ url('myReviews') }}"></i>My Reviews</a>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true">
              <i class="fa fa-question-circle mr-3"></i>
              <span>Query</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <a style="color:black" class="ml-3 nav-link" href="{{ url('registerQuery') }}">Register Query</a>
                <a style="color:black" class="ml-3 nav-link" href="{{ url('myQueries') }}">My Queries</a>
            </div>
        </li>

    </ul>

</div>