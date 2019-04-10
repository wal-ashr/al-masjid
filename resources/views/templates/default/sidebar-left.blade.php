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
<div class="sidebar-menu">
	<div class="sidebar-header">
		<div class="logo">
			<a href="{{ URL::to('admin')}}"><img class="logo" src="{{ $logo }}" alt="{{ $appName }}" /></a>
		</div>
	</div>
	
	@if($sidebar_content)
	{!! $sidebar_content !!}
	@endif
	
	<nav class="menu-inner">
		@foreach($menu_sidebar as $menu)
		{!! $menu !!}
		@endforeach
	</nav>
</div>