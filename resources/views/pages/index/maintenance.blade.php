<?php
/**
 * Created on Nov 7, 2018
 * Time Created	: 10:34:53 AM
 * Filename		: maintenance.blade.php
 *
 * @filesource	maintenance.blade.php
 *
 * @author		wisnuwidi@gmail.com - 2018
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>{{ $title }} | AL-MASJID</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">	
	
	<!-- Font -->	
	<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700%7CPoppins:400,500" rel="stylesheet"> -->
	
	<!-- Stylesheets -->	
	<link href="{{ asset('assets/templates/default') }}/maintenance/common-css/bootstrap.css" rel="stylesheet">	
	<link href="{{ asset('assets/templates/default') }}/maintenance/common-css/ionicons.css" rel="stylesheet">	
	<link rel="stylesheet" href="{{ asset('assets/templates/default') }}/maintenance/common-css/jquery.classycountdown.css" />		
	<link href="{{ asset('assets/templates/default') }}/maintenance/01-comming-soon/css/styles.css" rel="stylesheet">	
	<link href="{{ asset('assets/templates/default') }}/maintenance/01-comming-soon/css/responsive.css" rel="stylesheet">
</head>
<body>	
	<div class="main-area">
		<div class="container full-height position-static">			
			<section class="left-section full-height">
		
				<a class="logo" href="#"><img src="{{ $logo }}" alt="Logo"></a>
				
				<div class="display-table">
					<div class="display-table-cell">
						<div class="main-content">
							<h1 class="title"><b>{{ $title }}</b></h1>
							<p>{{ $description }}</p>
							
							@if ($subscribe_button >= 1)
							<div class="email-input-area">
								<form method="post">
									<input class="email-input" name="email" type="text" placeholder="Enter your email"/>
									<button class="submit-btn" name="submit" type="submit"><b>SUBSCRIBE</b></button>
								</form>
							</div><!-- email-input-area -->
							<p class="post-desc">{{ $subscribe_text }}</p>
							@endif
							
						</div><!-- main-content -->
					</div><!-- display-table-cell -->
				</div><!-- display-table -->
				
				<ul class="footer-icons">
					<li>Stay in touch : </li>
					<li><a href="#"><i class="ion-social-facebook"></i></a></li>
					<li><a href="#"><i class="ion-social-twitter"></i></a></li>
					<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
					<li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
					<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
				</ul>
		
			</section><!-- left-section -->
		
			<section class="right-section" style="background-image: url({{ $image }})">
			
				<div class="display-table center-text">
					<div class="display-table-cell">
						
						<div id="rounded-countdown">
							<div class="countdown" data-remaining-sec="{{ $time_durations }}"></div>
						</div>
						
					</div><!-- display-table-cell -->
				</div><!-- display-table -->
				
			</section><!-- right-section -->
		
		</div><!-- container -->
	</div><!-- main-area -->
	
	<!-- SCIPTS -->
	
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/jquery-3.1.1.min.js"></script>	
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/tether.min.js"></script>	
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/bootstrap.js"></script>	
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/jquery.classycountdown.js"></script>	
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/jquery.knob.js"></script>
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/jquery.throttle.js"></script>
	<script src="{{ asset('assets/templates/default') }}/maintenance/common-js/scripts.js"></script>
	
</body>
</html>