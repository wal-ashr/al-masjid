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
	<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
	<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
	<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
	
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
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="{{ asset('assets/templates/default') }}/global/plugins/bower_components/html5shiv/dist/html5shiv.min.js"></script>
        <script src="{{ asset('assets/templates/default') }}/global/plugins/bower_components/respond-minmax/dest/respond.min.js"></script>
        <![endif]-->
	</head>
	
	<body class="page-session page-header-fixed page-sidebar-fixed page-footer-fixed page-sound">
		<!--[if lt IE 9]><p class="upgrade-browser">Upps!! You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" target="_blank">upgrade your browser</a> to improve your experience.</p><![endif]-->
	
	@if (Auth::check())
		@include('templates.default.header')
		@include('templates.default.sidebar-left')
	@endif
	
	@yield('content')
	
	@if (Auth::check())
	
		<div id="back-top" class="animated pulse circle">
            <i class="fa fa-angle-up"></i>
        </div>
        
	@foreach($script_css_bottom as $css_bottom)
	{!! $css_bottom !!}
	@endforeach
	
	@foreach($script_default_js as $default_js)
	{!! $default_js !!}
	@endforeach
	
	@foreach($script_js_bottom as $js_bottom)
	{!! $js_bottom !!}
	@endforeach
	
	@endif
	</body>
</html>