<?php
/**
 * Created on Mar 6, 2017
 * Time Created	: 2:10:55 PM
 * Filename		: login.blade.php
 *
 * @filesource	login.blade.php
 *
 * @author		wisnuwidi @gmail.com - 2017
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>

@extends('templates.default.master')

@section('content')

		<div class="login-area login-bg">
			<div class="container">
				<div class="login-box ptb--40">
					{!! Form::open(['route' => 'login_processor', 'class' => 'sign-in form-horizontal shadow rounded no-overflow']) !!}
						<div class="login-form-head">
							<div class="logo"><img src="{{ asset('assets/templates/default') }}/images/logo-almasjid.png" /></div>
							<h4>Sign In</h4>
						</div>
						<div class="login-form-body">
							<div class="form-gp">
								<label for="exampleInputEmail1">Email address</label>
								{!! Form::text('email', null, ['id' => 'exampleInputEmail1']) !!}
								<i class="ti-email"></i>
							</div>
							<div class="form-gp">
								<label for="exampleInputPassword1">Password</label>
								{!! Form::password('password', ['id' => 'exampleInputPassword1']) !!}
								<i class="ti-lock"></i>
							</div>
							<div class="row mb-4 rmber-area">
								<div class="col-6">
									<div class="custom-control custom-checkbox mr-sm-2">
										<input type="checkbox" class="custom-control-input" id="customControlAutosizing">
										<label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
									</div>
								</div>
								<div class="col-6 text-right">
									<a href="#">Forgot Password?</a>
								</div>
							</div>
							<div class="submit-btn-area">
								{!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg btn-block no-margin rounded', 'id' => 'login-btn']) !!}
							</div>
							<div class="form-footer text-center mt-5">
								<p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
		
		<!-- jquery latest version -->
		<script src="{{ asset('assets/templates/default') }}/js/vendor/jquery-2.2.4.min.js"></script>
		<!-- bootstrap 4 js -->
		<script src="{{ asset('assets/templates/default') }}/js/popper.min.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/bootstrap.min.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/owl.carousel.min.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/metisMenu.min.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/jquery.slimscroll.min.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/jquery.slicknav.min.js"></script>
		
		<!-- others plugins -->
		<script src="{{ asset('assets/templates/default') }}/css/plugins.js"></script>
		<script src="{{ asset('assets/templates/default') }}/js/scripts.js"></script>
		
@endsection