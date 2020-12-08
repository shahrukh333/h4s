@extends('layouts.showsearchlayout')
@section('content')
<div class="htlfndr-loader-overlay"></div>
<div class="htlfndr-wrapper">
	<!-- Start of main content -->
	<div class="container" style="margin-top: 20px"> 
		<div class="htlfndr-steps">
			<ul class="htlfndr-progress">
				<li><a href="{{url('/')}}">
					<span class="htlfndr-step-number">1</span> <span class="htlfndr-step-description">Index</span></a>
				</li>
				<li class="htlfndr-active-step">
					<span class="htlfndr-step-number">2</span> <span class="htlfndr-step-description">Search</span>
				</li>
			</ul>
		</div>
		<div class="row" style=" margin-top:50px ;">
			<aside  class="col-sm-4 col-md-3 col-lg-3 htlfndr-sidebar htlfndr-sidebar-in-left" role="complementary">
				<div class="htlfndr-modify-search-aside widget">
					<h3 class="widget-title">modify search</h3>
					<div class="htlfndr-widget-content">
						<form action="{{ url('searchsidebar') }}" method="POST" id="search-hotel">
							@csrf
							<label for="htlfndr-city" class="htlfndr-input-label">Your destination</label>
							<div id="htlfndr-input-1" class="htlfndr-input-wrapper">
								<input type="text" name="hostelcity" id="htlfndr-city" class="search-hotel-input" placeholder="Enter city name" />
							</div>
								<label for="htlfndr-price-show" class="htlfndr-input-label">Price</label>
								<div id="htlfndr-price-slider" name="price" ></div>
								<input type="text" id="htlfndr-price-show"   name="price" readonly />
								<input type="hidden" name="htlfndr-price-start" id="htlfndr-price-start" value="1000"/>
								<input type="hidden" name="htlfndr-price-stop" id="htlfndr-price-stop" value="50000"/>
								<p class="htlfndr-input-label">Hostel Category</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-apartment" name="Category[]" value="Male Hostel" />
									<label for="htlfndr-check-apartment">Male Hostel</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-hostel" name="Category[]" value="Female Hostel" />
									<label for="htlfndr-check-hostel">Female Hostel</label>
								</p>
								<p class="htlfndr-input-label">Facilities</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-wi-fi" name="Facilities[]"     value="wifi" />
									<label for="htlfndr-check-wi-fi">Wi-Fi</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-television" name="Facilities[]"     value="mess" />
									<label for="htlfndr-check-television">Mess</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-wi-fi" name="Facilities[]"     value="cctv_camera" />
									<label for="htlfndr-check-wi-fi">CCTV camera</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-television" name="Facilities[]"     value="laundry" />
									<label for="htlfndr-check-television">Laundry</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-wi-fi" name="Facilities[]"     value="power_backup" />
									<label for="htlfndr-check-wi-fi">Power Backup</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-television" name="Facilities[]"     value="daily_clean" />
									<label for="htlfndr-check-television">Daily Clean</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-television" name="Facilities[]"     value="geyser" />
									<label for="htlfndr-check-television">Geyser</label>
								</p>
								<p class="htlfndr-checkbox-line">
									<input type="checkbox" id="htlfndr-check-wi-fi" name="htlfndr-check-wi-fi" value="parking"  />
									<label for="htlfndr-check-wi-fi">Parking</label>
								</p>
								<input type="submit" value="Search" class="btn-primary"/>
							</form>
						</div>
				</div>
			</aside>
			<main class="col-sm-8 col-md-9 col-lg-9 htlfndr-search-result htlfndr-grid-view" role="main">
				@if (count($results) > 0)
					@if(count($results) > 1)
						@foreach ($results as $result)
							<div class="col-md-4 col-sm-6">
								<div class="single-package-item" style="border: 1px solid pink">
									@php
										$directory = public_path().'/graphics/hostel'.($result->hostel_id);
										if(is_dir($directory))
										{
											$path = "";
											$dh = opendir($directory);
											while (false !== ($fileName = readdir($dh))) 
											{
												if (is_file($directory."/".$fileName))
												{
													$path = "/graphics/hostel".$result->hostel_id."/".$fileName;
													$data = '<img src="'.url($path).'" alt="hotel img" height="100" style="height: 200px"/>';
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
									<div class="single-package-item-txt">
										<h5 style="padding-top: 5px;">{{$result->hostel_name}} <span class="pull-right">Rs{{$result->hostel_rent}}</span></h5>
										<div class="packages-para">
											<p>
												<span><i class="fa fa-angle-double-right"></i>{{$result->hostel_city}}</span>
												<span><i class="fa fa-angle-double-right"></i> {{$result->hostel_province}}</span>
											</p>
											<p><span><i class="fa fa-angle-double-right"></i>  {{$result->hostel_category}}</span>
												<i class="fa fa-angle-double-right"></i>Rs{{$result->hostel_rent}}
											</p>
										</div>
										<div class="about-btn">
											<a class="about-view packages-btn" href="{{url('searchShow',['id' => encrypt($result->hostel_id)])}}">book now</a>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@else 
						<div class="col-md-4 col-sm-6">
							<div class="single-package-item" style="border: 1px solid pink">
								@php
									$directory = public_path().'/graphics/hostel'.($results->first()->hostel_id);
									if(is_dir($directory))
									{
										$path = "";
										$dh = opendir($directory);
										while (false !== ($fileName = readdir($dh))) 
										{
											if (is_file($directory."/".$fileName))
											{
												$path = "/graphics/hostel".$results->first()->hostel_id."/".$fileName;
												$data = '<img src="'.url($path).'" alt="hotel img" height="100" style="height: 200px"/>';
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
								<div class="single-package-item-txt">
									<h5 style="padding-top: 5px;">{{$results->first()->hostel_name}} <span class="pull-right">Rs{{$results->first()->hostel_rent}}</span></h5>
									<div class="packages-para">
										<p>
											<span><i class="fa fa-angle-double-right"></i>{{$results->first()->hostel_city}}</span>
											<span><i class="fa fa-angle-double-right"></i> {{$results->first()->hostel_province}}</span>
										</p>
										<p><span><i class="fa fa-angle-double-right"></i>  {{$results->first()->hostel_category}}</span>
											<i class="fa fa-angle-double-right"></i>Rs{{$results->first()->hostel_rent}}
										</p>
									</div>
									<div class="about-btn">
										<a class="about-view packages-btn" href="{{url('searchShow',['id' => encrypt($results->first()->hostel_id)])}}">book now</a>
									</div>
								</div>
							</div>
						</div>
					@endif
				@else
				<div class="col-md-4 col-sm-6">
					<h3>No record found</h3> 
				</div>
				@endif
			</main>
		</div>
	</div>
</div>
@endsection