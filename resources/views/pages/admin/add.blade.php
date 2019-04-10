@extends('templates.default.admin.master')

@section('content')
<section id="page-content">

	@if($breadcrumbs)
		{!! $breadcrumbs !!}
	@endif
	
	<div class="body-content animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="panel rounded shadow">
					<div class="panel-heading">
						<h3 class="panel-title">Page Blank</h3>
					</div>
					<div class="panel-body">
						@foreach($content_page as $content)
							{!! $content !!}
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="footer-content">
		<font title="{{ $configs->settings['email'] }}">&copy;</font>&nbsp;
		<a href="mailto:{{ $configs->settings['email'] }}" target="_blank">{{ $configs->settings['copyrights'] }}</a>, {{ $configs->settings['location'] }} {{ $configs->settings['location_abbr'] }}
	</footer>
</section>
@endsection
