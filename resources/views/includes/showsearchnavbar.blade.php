<header>
	<div class="htlfndr-top-header">
		<div class="navbar navbar-default htlfndr-blue-hover-nav">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#htlfndr-first-nav">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="htlfndr-logo navbar-brand" href="{{url('/')}}">
						<img src="{{ url('../resources/indexpageresources/images/gallery/logo.png') }}" alt="logo" style=" height: 50px; margin-left: 10px">
					</a>
				</div>
				<div class="collapse navbar-collapse navbar-right" id="htlfndr-first-nav">
					<ul class="nav navbar-nav htlfndr-singup-block">
					@guest
						<li id="htlfndr-singup-link">
							<a href="{{url('/')}}" data-toggle="modal"><span>Home</span></a>
						</li>
						<li id="htlfndr-singin-link">
							<a href="{{route('login')}}" data-toggle="modal" data-target=""><span>Login</span></a>
						</li>

						<li id="htlfndr-singin-link">
							<a href="{{route('register')}}" data-toggle="modal" data-target=""><span>Register</span></a>
						</li>
					@else
						<li> <li><a href="{{ url('dashboard') }}">Dashboard(<span class="font-weight-bold">{{Auth::user()->name}})</span></a></li></li>
					@endguest
					</ul>
				</div>
			</div>
		</div>
	</div>
	<noscript><h2>You have JavaScript disabled!</h2></noscript>
</header> 