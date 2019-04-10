<?php
/**
 * Created on Mar 31, 2017
 * Time Created	: 5:05:08 PM
 * Filename		: index.blade.php
 *
 * @filesource	index.blade.php
 *
 * @author		wisnuwidi @gmail.com - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>
@extends('templates.default.admin.master')

@section('content')

	@if($breadcrumbs)
		{!! $breadcrumbs !!}
	@endif
	
	<div class="main-content-inner animated fadeInx">
		<div class="content-box">
				
			<!-- START ACTION BUTTON BLOCKs -->
			<?php $breakLine = false;?>
			@if (!empty($route_info->action_page))
				<?php $breakLine = '<br />';?>
			@endif
			@if (!empty($route_info->action_page))
			
			<div class="header white">
				<h3 class="panel-title header-list-panel">
					@foreach ($route_info as $info => $actions)
						@if (is_array($actions))
							@foreach ($actions as $action_label => $action_url)
							<?php 
								$button_info = 'btn-primary';
								if (true === str_contains($action_label, 'add')) {
									$button_info	= 'btn-warning';
									$action_class	= 'btn_create';
								} elseif (true === str_contains($action_label, 'back')) {
									$button_info	= 'btn-danger';
									$action_class	= 'btn_index';
								}
							?>
							
					<a href="{{ $action_url }}" class="btn {{ $button_info }} {{ $action_class }} btn-slideright button-app pull-right" style="margin:0 5px;">{{ ucwords($action_label) }}</a>
							@endforeach
						@endif
					@endforeach
					
					<?php 
					if (!empty($datatable_searchbox)) {
						echo $datatable_searchbox;
					}
					?>
				</h3>
			</div>
			
			@endif
			<!-- END ACTION BUTTON BLOCK -->
			
			<div class="body">
				@if ($errors->any())
				
				<div class="alert alert-danger animated fadeInDown alert-dismissable">
					<button type="button" class="close" data-dismiss="alert">
						<i class="fa fa-times"></i>
					</button>
					<strong><i class="fa fa-check"></i> WARNING</strong>
					<ul>
					@foreach ($errors->all() as $error)
					
						<li>{{ $error }}</li>
					@endforeach
					
					</ul>
				</div>
				
				@endif
				
				@foreach($content_page as $content)
					{!! $content !!}
				@endforeach
				
			</div>
		</div>
	</div>
@endsection
