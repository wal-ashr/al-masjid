<?php
/**
 * Created on Mar 6, 2017
 * Time Created	: 2:13:37 PM
 * Filename		: master.blade.php
 *
 * @filesource	master.blade.php
 *
 * @author		wisnuwidi @gmail.com - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
	{{-- Manggil $this->data['meta_tags'] di BaseController; --}}
	@foreach($meta_tags as $meta)
	{!! $meta !!}
	@endforeach
	
	@foreach($script_default_css as $default_css)
	{!! $default_css !!}
	@endforeach	
	
	@foreach($script_css_top as $css_top)
	{!! $css_top !!}
	@endforeach
	
	@foreach($script_js_top as $js_top)
	{!! $js_top !!}
	@endforeach
</head>

<body class="page-sound">
	<!--[if lt IE 8]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->
	<div id="preloader"><div class="loader"></div></div>
	@if (Auth::check())
	<div class="page-container">
		@include('templates.default.admin.sidebar-left')
		<div class="main-content">
		@include('templates.default.admin.header')
	@endif
	
		@yield('content')
	
	@if (Auth::check())			
		</div>
		
		<footer>
			<div class="footer-area">
				<span class="pull-right">
					<span id="copyright"></span>&nbsp;
					<font title="{{ $configs->settings['email'] }}">&copy;</font>&nbsp;
					<a href="mailto:{{ $configs->settings['email'] }}" target="_blank">{{ $configs->settings['copyrights'] }}</a>, {{ $configs->settings['location'] }} {{ $configs->settings['location_abbr'] }}
				</span>
			</div>
		</footer>
	</div>

	<div id="back-top" class="circle show animated pulse">
		<i class="fa fa-angle-up"></i>
	</div>
	@include('templates.default.admin.offset')
	@endif
	
	@foreach($script_css_bottom as $css_bottom)
	{!! $css_bottom !!}
	@endforeach
	
	@foreach($script_default_js as $default_js)
	{!! $default_js !!}
	@endforeach
	
	@foreach($script_js_bottom as $js_bottom)
	{!! $js_bottom !!}
	@endforeach
 </body>

</html>