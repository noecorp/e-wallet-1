<html>
	<head>
		<title>E-wallet | {{ $title or 'name' }}</title>
	
		<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />

	    <link href="{{url('css/custom.css') }}" rel="stylesheet" type="text/css" />
	</head>
	<body class="p404 purple-gradient">
		<div class="p404-caption">
			<div class="font-lobster p404-notfound">
				<i class="icon-sad-face"></i> Page Not Found
			</div>
			<a href="{{ url('/') }}" class="btn btn-default" >Go To Home Page</a>
		</div>
	</body>
</html>