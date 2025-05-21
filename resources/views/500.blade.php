<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from drtheme.ditsolution.net/html/host-it/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2023 05:49:23 GMT -->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>500</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="56x56" href="{{ asset('assets/frontend/images/fav-icon/favicon.png') }}">
	<!-- bootstrap CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" type="text/css" media="all">
	<!-- carousel CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}" type="text/css" media="all">	
	<!-- animate CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}" type="text/css" media="all">	
	<!-- animated-text CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/animated-text.css') }}" type="text/css" media="all">	
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}" type="text/css" media="all">	
	<!-- font-flaticon CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}" type="text/css" media="all">	
	<!-- template-custom CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/template-custom.css') }}" type="text/css" media="all">	
	<!-- meanmenu CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/meanmenu.min.css') }}" type="text/css" media="all">	
	<!-- Main Style CSS -->
	<link rel="stylesheet"  href="{{ asset('assets/frontend/css/style.css') }}" type="text/css" media="all">
	<!-- transitions CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/owl.transitions.css') }}" type="text/css" media="all">
	<!-- venobox CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/venobox/venobox.css') }}" type="text/css" media="all">
	<!-- responsive CSS -->
	<link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}" type="text/css" media="all">
	<!-- modernizr js -->	
	<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>	
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.9.1/font/bootstrap-icons.css">
</head>
	{{-- <body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;"> --}}
	<style>
    .text {
  flex: 1 0 0%;
  margin-left: 12%;
  margin-top: 5%;
}
#color{
    font-weight: bold;
  color: rgb(135, 50, 131);
}
    </style>
<body>   

<!--==================================================-->
<!----------------- Start Header menu ------------------>
<!--==================================================-->
@include('frontend.layouts.navbar')

<!-- Host Lux Mobile Menu  -->
{{-- <div class="mobile-menu-area sticky d-sm-block d-md-block d-lg-none ">
	<div class="mobile-menu">
		<nav class="hostlux_menu">
			<ul class="nav_scroll">
				<li><a href="index-2.html">Home</a></li>
				<li><a href="about.html">About</a></li>
				<li><a href="hosting.html">Hosting</a></li>
				<li><a href="index-2.html">Pages<span><i class="bi bi-chevron-down"></i></span></a>
					<ul class="sub-menu">
						<li><a href="about.html">about</a></li>
						<li><a href="service.html">service</a></li>
						<li><a href="domain.html">domain</a></li>
						<li><a href="hosting.html">hosting</a></li>
						<li><a href="register.html">register</a></li>
						<li><a href="blog.html">blog</a></li>
						<li><a href="blog-details.html">blog-details</a></li>
						<li><a href="pricing.html">pricing</a></li>
						<li><a href="contact.html">contact</a></li>
					</ul>
				</li>
				<li><a href="domain.html">Domain</a>
				</li>
				<li><a href="contact.html">Contact Us</a>
				</li>
			</ul>
		</nav>
	</div>
</div> --}}
<!--==================================================-->
<!----------- End Header menu ------------------>
<!--==================================================-->  


<!--==================================================-->
<!----------- Start Banner Area ------------------>
<!--==================================================-->
	{{-- @yield('frontend-content') --}}
    <div class="row mb-5">
    <div class="text col">
        <h1>Page Not <span style="color: #fd7e14;">Found</span></h1>
        <p>We can't seem to find the page you're looking for. Please check the URL for any typos.</p>
        <ul class="menu">
          <li><a href="/" id='color'>Go to Homepage</a></li>
          <li><a href="/about" id='color'>Visit our Blog</a></li>
          <li><a href="/contact" id='color'>Contact support</a></li>
        </ul>
      </div>
      <div class="col">
        
        <h1 style="margin-top: 5%;font-size: 230px;">500!</h1>
    
        {{-- <img class="image" src="public/uploads\500.png" alt="500" style="height: 400px;width: 400px;"> --}}
        
    </div>
    </div>
<!--==================================================-->
<!----------- End Application Area ------------------>
<!--==================================================-->

<!--==================================================-->
<!----------- End Domain  Area ------------------>
<!--==================================================-->



<!--==================================================-->
    @include('frontend.layouts.footer')

<!--==================================================-->
<!----------- End Footer  Area ------------------>
<!--==================================================-->

<!--==================================================-->
<!-- Start Search Popup Area -->
<!--==================================================-->
<div class="search-popup">
	<button class="close-search style-two"><i class="fas fa-times"></i></button>
	<button class="close-search"><i class="fas fa-arrow-up"></i></button>
	<form method="post" action="#">
		<div class="form-group">
			<input type="search" name="search-field" value="" placeholder="Search Here" required="">
			<button type="submit"><i class="fas fa-search"></i></button>
		</div>
	</form>
</div>
<!--==================================================-->
<!-- End Search Popup Area -->
<!--==================================================-->



<!--==================================================-->
<!-- Start scrollup section Section -->
<!--==================================================-->
<div class="prgoress_indicator active-progress">
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
		<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 270.456;"></path>
	</svg>
</div>

<script type="text/javascript">
	var BASE_URL = "{{ url('/') }}";
	</script>
<!--==================================================-->
<!-- Start scrollup section Section -->
<!--==================================================-->
</div>
	<!-- jquery js -->	
	<script src="{{ asset('assets/frontend/js/vendor/jquery-3.6.2.min.js') }}"></script>
	<!-- bootstrap js -->	
	<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
	<!-- carousel js -->
	<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
	<!-- counterup js -->
	<script src="{{ asset('assets/frontend/js/jquery.counterup.min.js') }}"></script>
	<!-- waypoints js -->
	<script src="{{ asset('assets/frontend/js/waypoints.min.js') }}"></script>
	<!-- wow js -->
	<script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
	<!-- imagesloaded js -->
	<script src="{{ asset('assets/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
	<!-- venobox js -->
	<script src="{{ asset('assets/frontend/venobox/venobox.js') }}"></script>
	<!--  animated-text js -->	
	<script src="assets/js/animated-text.js') }}"></script>
	<!-- venobox min js -->
	<script src="{{ asset('assets/frontend/venobox/venobox.min.js') }}"></script>
	<!-- isotope js -->
	<script src="{{ asset('assets/frontend/js/isotope.pkgd.min.js') }}"></script>
	<!-- jquery meanmenu js -->	
	<script src="{{ asset('assets/frontend/js/jquery.meanmenu.js') }}"></script>
	<!-- jquery scrollup js -->	
	<script src="{{ asset('assets/frontend/js/jquery.scrollUp.js') }}"></script>
	<!-- theme js -->	
	<script src="{{ asset('assets/frontend/js/theme.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/jquery.barfiller.js') }}"></script>
	<!-- jquery js -->	

	<script src="{{ asset('js/cdnFiles/validate.min.js') }}"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	@yield('frontend-footer')

  </body>

<!-- Mirrored from drtheme.ditsolution.net/html/host-it/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Dec 2023 05:50:02 GMT -->
</html>