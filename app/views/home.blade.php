<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>E-wallet | {{ $title or 'name' }}</title>
	
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

	<link href="{{ url('public/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/plugins/simple-line-icons/simple-line-icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link href="{{ url('public/plugins/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
	
	<link href="{{url('public/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="home">
	<nav class="navbar home-navbar">
	 	<div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		      	<a class="navbar-brand" href="{{ url('/') }}">E-wallet</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav navbar-right">
			        <li class="active"><a href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a></li>
			        <li><a href="#learn-more" rel="goToPanel">Learn More</a></li>
			        <li><a href="{{ url('/login') }}">Login</a></li>
		      	</ul>
		    </div><!-- /.navbar-collapse -->
	  	</div><!-- /.container-fluid -->
	</nav>
	<div class="window-width window-height big-tile virgin-america-gradient">
		<div class="caption">
			<div class="big-logo">E-Wallet</div>
			<p>A Simple Online Platform to Manage Your Online Money</p>
			<br/>
			<a href="#learn-more" rel="goToPanel"	 class="caption-btn">Learn More</a>
		</div>
	</div>
	<div class="section" id="learn-more">
		<div class="container">
			<h1 class="section-title">About <span class="font-lobster">E-wallet</span></h1>
			<div class="clearfix row icon-boxes">
				<div class="col-md-6 icon-box">
					<div class="box-icon">
						<i class="icon-cloud-upload"></i>
					</div>
					<div class="box-content">
						<h3 class="box-title">Make Deposit</h3>
						<div class="box-description">
							<p>Lorem ipsum dolor sit amet, mea an meliore patrioque, cum ei dolor legere perpetua, mel putant adipisci gloriatur ne. In quot constituto nam, ut abhorreant deseruisse nec. Qui cu duis vitae. No vel diam duis euripidis.</p>
						</div>
					</div>
				</div>
				
				<div class="col-md-6 icon-box">
					<div class="box-icon">
						<i class="icon-cloud-download"></i>
					</div>
					<div class="box-content">
						<h3 class="box-title">Make Withdrawal</h3>
						<div class="box-description">
							<p>Lorem ipsum dolor sit amet, mea an meliore patrioque, cum ei dolor legere perpetua, mel putant adipisci gloriatur ne. In quot constituto nam, ut abhorreant deseruisse nec. Qui cu duis vitae. No vel diam duis euripidis.</p>
						</div>
					</div>
				</div>

				<div class="col-md-6 icon-box">
					<div class="box-icon">
						<i class="icon-directions"></i>
					</div>
					<div class="box-content">
						<h3 class="box-title">Transfer Money</h3>
						<div class="box-description">
							<p>Lorem ipsum dolor sit amet, mea an meliore patrioque, cum ei dolor legere perpetua, mel putant adipisci gloriatur ne. In quot constituto nam, ut abhorreant deseruisse nec. Qui cu duis vitae. No vel diam duis euripidis.</p>
						</div>
					</div>
				</div>

				<div class="col-md-6 icon-box">
					<div class="box-icon">
						<i class="icon-wallet"></i>
					</div>
					<div class="box-content">
						<h3 class="box-title">Online Wallet</h3>
						<div class="box-description">
							<p>Lorem ipsum dolor sit amet, mea an meliore patrioque, cum ei dolor legere perpetua, mel putant adipisci gloriatur ne. In quot constituto nam, ut abhorreant deseruisse nec. Qui cu duis vitae. No vel diam duis euripidis.</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div><!-- end of section -->

	<footer>
		<div class="container">
			<div class="col-md-6">
				Made With <i class="icon-heart"></i> By Mohammed Manssour
			</div>
			<div class="col-md-6 text-right">
				All Rights Reserved For <span class="font-lobster">E-wallet</span>
			</div>
		</div>
	</footer>
	
	<script src="{{ url('public/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('public/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('public/scripts/home.js') }}"></script>
</body>
</html>
