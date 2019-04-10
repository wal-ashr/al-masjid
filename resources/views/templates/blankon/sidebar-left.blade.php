<?php
/**
 * Created on Mar 31, 2017
 * Time Created	: 5:37:12 PM
 * Filename		: sidebar.left.blade.php
 * 
 * @filesource	sidebar.left.blade.php
 * 
 * @author		wisnuwidi @gmail.com - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>
<aside id="sidebar-left" class="sidebar-circle">
	@if($sidebar_content)
	{!! $sidebar_content !!}
	@endif

	@foreach($menu_sidebar as $menu)
	{!! $menu !!}
	@endforeach

	<div id="tour-10" class="sidebar-footer hidden-xs hidden-sm hidden-md">
		<a id="setting" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Setting"><i class="fa fa-cog"></i></a>
		<a id="fullscreen" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
		<a id="lock-screen" data-url="page-signin.html" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Lock Screen"><i class="fa fa-lock"></i></a>
		<a id="logout" data-url="page-lock-screen.html" class="pull-left" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
	</div>
</aside>