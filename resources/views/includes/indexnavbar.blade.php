<header class="top-area">
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="logo">
                        <img src="{{ url('../resources/indexpageresources/images/gallery/logo.png') }}" alt="logo" style=" height: 80px;">
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse">		  
                            <ul class="nav navbar-nav navbar-right">
                                @guest
                                    <li> <a href="{{ url('index') }}">Home</a></li></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('register') }}">register</a></li>
                                @else
                                    <li><a href="{{ url('dashboard') }}">Dashboard(<span class="font-weight-bold">{{Auth::user()->name}})</span></a></li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-border"></div>
        </div>
    </div>
</header>