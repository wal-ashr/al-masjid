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
$action_search	= url()->current();
$search_name	= encrypt('search');
?>

<div class="shadow">

	<?php if (true === isset($messages)) {?>
	<div class="row" style="position:fixed;top:0;right:190px;z-index:10;width:47%;margin-top:-3px;">
		<div class="col-md-12">
			<div class="alert alert-info animated fadeInDown alert-dismissable" style="margin-top:4px;margin-bottom:0 !important;padding:10px 20px 10px 10px;font-size:12px;">
				<button type="button" class="close" data-dismiss="alert" style="font-size: 8pt;">
					<i class="fa fa-times"></i>
				</button>
				
				@foreach ($messages as $message)
				<span class="alert-icon" style="width:22px;height:22px;"><i class="fa fa-bell-o" style="width:22px;height:22px;font-size:8pt;line-height: 22px"></i></span>{!! $message !!}
				@endforeach
			
			</div>
		</div>
	</div>
	<?php }?>

	<div class="header-area">
		<div class="row align-items-center">
			<!-- nav and search button -->
			<div class="col-md-6 col-sm-8 clearfix">
				<div class="nav-btn pull-left">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="search-box pull-left">
					<form method="GET" action="{{ $action_search }}">
						<input type="text" name="{{ $search_name }}" placeholder="Search..." required />
						<i class="ti-search"></i>
					</form>
				</div>
			</div>
			<!-- profile info & task notification -->
			<div class="col-md-6 col-sm-4 clearfix">
				<ul class="notification-area pull-right">
					<li id="full-view"><i class="ti-fullscreen"></i></li>
					<li id="full-view-exit"><i class="ti-zoom-out"></i></li>
					<li class="dropdown">
						<i class="ti-bell dropdown-toggle" data-toggle="dropdown">
							<span>2</span>
						</i>
						<div class="dropdown-menu bell-notify-box notify-box">
							<span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
							<div class="nofity-list">
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
									<div class="notify-text">
										<p>You have Changed Your Password</p>
										<span>Just Now</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
									<div class="notify-text">
										<p>New Commetns On Post</p>
										<span>30 Seconds ago</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
									<div class="notify-text">
										<p>Some special like you</p>
										<span>Just Now</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-comments-smiley btn-info"></i></div>
									<div class="notify-text">
										<p>New Commetns On Post</p>
										<span>30 Seconds ago</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-key btn-primary"></i></div>
									<div class="notify-text">
										<p>Some special like you</p>
										<span>Just Now</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
									<div class="notify-text">
										<p>You have Changed Your Password</p>
										<span>Just Now</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb"><i class="ti-key btn-danger"></i></div>
									<div class="notify-text">
										<p>You have Changed Your Password</p>
										<span>Just Now</span>
									</div>
								</a>
							</div>
						</div>
					</li>
					<li class="dropdown">
						<i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
						<div class="dropdown-menu notify-box nt-enveloper-box">
							<span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
							<div class="nofity-list">
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img1.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">Hey I am waiting for you...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img2.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">When you can connect with me...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img3.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">I missed you so much...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img4.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">Your product is completely Ready...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img2.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">Hey I am waiting for you...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img1.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">Hey I am waiting for you...</span>
										<span>3:15 PM</span>
									</div>
								</a>
								<a href="#" class="notify-item">
									<div class="notify-thumb">
										<img src="http://localhost/expresscode/page/assets/templates/default/images/author/author-img3.jpg" alt="image">
									</div>
									<div class="notify-text">
										<p>Aglae Mayer</p>
										<span class="msg">Hey I am waiting for you...</span>
										<span>3:15 PM</span>
									</div>
								</a>
							</div>
						</div>
					</li>
					<li class="settings-btn">
						<i class="ti-settings"></i>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- 
	<div class="page-title-area shadow">
		<div class="row align-items-center">
			<div class="col-sm-12">
				<div class="breadcrumbs-area clearfix">
					<h4 class="page-title pull-left">Dashboard</h4>
					<ul class="breadcrumbs pull-right">
						<li><a href="index.html">Home</a></li>
						<li><span>Dashboard</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	 -->
</div>
			