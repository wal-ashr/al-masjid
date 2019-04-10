<?php
/**
 * Created on Mar 31, 2017
 * Time Created	: 5:18:08 PM
 * Filename		: header.blade.php
 *
 * @filesource	header.blade.php
 *
 * @author		wisnuwidi @gmail.com - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>
<header id="header">
	<?php if (true === isset($messages)) {?>
		<div class="row" style="position:fixed;top:0;right:170px;z-index: 10;">
			<div class="col-md-12">
				<div class="alert alert-success animated fadeInDown alert-dismissable" style="margin-top:4px;margin-bottom:0 !important;margin-left:10px;padding:10px 20px 10px 10px;">
					<button type="button" class="close" data-dismiss="alert" style="font-size: 8pt;">
						<i class="fa fa-times"></i>
					</button>
					
					@foreach ($messages as $message)
					<span class="alert-icon" style="width:22px;height:22px;"><i class="fa fa-bell-o" style="width:22px;height:22px;font-size:8pt;line-height: 22px"></i></span> &nbsp; {!! $message !!}
					@endforeach
				
				</div>
			</div>
		</div>
    <?php }?>
	
	<div class="header-left">
		<div class="navbar-minimize-mobile left">
			<i class="fa fa-bars"></i>
		</div>
		<div class="navbar-header">
			<a id="tour-1" class="navbar-brand" href="{{ URL::to('admin')}}">
				<img class="logo" src="{{ $logo }}" alt="{{ $appName }}" />
			</a>
		</div>
		<div class="clearfix"></div>
	</div>
	
	<div class="header-right">
		<div class="navbar navbar-toolbar">
			<ul class="nav navbar-nav navbar-left">
				<li class="navbar-minimize">
					<a href="javascript:void(0);" title="Minimize sidebar">
						<i class="fa fa-bars"></i>
					</a>
				</li>
			    
			</ul>
			
			@foreach($menu_account as $menuAccount)
			{!! $menuAccount !!}
			@endforeach
		</div>
	</div>
</header>