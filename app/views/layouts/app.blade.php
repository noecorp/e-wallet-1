<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>E-Wallet | {{ $title or 'dashboard' }}</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

        <link href="{{ url('public/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/simple-line-icons/simple-line-icons.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/uniform/css/uniform.default.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('public/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{url('public/css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url('public/css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('public/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{url('public/css/themes/light.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('public/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        
        @yield('head')
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-md">
		<div class="page-header navbar navbar-fixed-top">
			<div class="page-header-inner ">
				
				<div class="page-logo">
                    <h3>
                    	<a href="{{ url('/') }}" class="font-lobster admin-logo" style="padding-left: 0px">
	                        E-Wallet
	                    </a>
                    </h3>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>

                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
    
                    <div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"> {{ Auth::user()->name }} </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="{{ AppHelpers::getImageUrl(Auth::user()->featuredImage,40,40) }}" width="40" height="40" />
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="{{ url('/') }}">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
						</ul>
                    </div>
                </div><!-- end of page-top -->

			</div><!-- end of page-header-inner-->
		</div><!-- end of page-header -->

		<div class="clearfix"> </div>

		<div class="page-container">
            
            @if(Auth::user()->role == 1)

            @include('layouts.sidebar')

            @endif

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

            	<div class="page-content {{ Auth::user()->role == 0? 'user-page':'' }}">
                    {{ Flash::get() }}
                    @yield('content')

            	</div>
				
				<!-- BEGIN PAGE BASE CONTENT -->

            </div><!-- end of page-content-wrapper -->
       	</div><!-- end of page-container -->
		
		<script src="{{ url('public/plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ url('public/scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ url('public/scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('public/scripts/demo.min.js') }}" type="text/javascript"></script>
        {{-- <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> --}}
        
        <script src="{{ url('public/scripts/script.js') }}"></script>

        @yield('footer')

    </body>
</html>