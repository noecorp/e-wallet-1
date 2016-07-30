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
        <link href="{{ url('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('plugins/simple-line-icons/simple-line-icons.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('plugins/bootstrap/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('plugins/uniform/css/uniform.default.css') }} " rel="stylesheet" type="text/css" />
        <link href="{{ url('plugins/bootstrap-switch/css/bootstrap-switch.min.css') }} " rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{url('css/components-md.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{url('css/plugins-md.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{url('css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{url('css/themes/light.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{url('css/custom.min.css') }}" rel="stylesheet" type="text/css" />
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
                    	<a href="{{ url('/') }}">
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
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form" action="page_general_search_2.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
                    <div class="top-menu">
						<ul class="nav navbar-nav pull-right">
							<li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"> Nick </span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                                    <img alt="" class="img-circle" src="{{ url('img/avatar9.jpg') }}" />
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="page_user_login_1.html">
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
            
            @include('layouts.sidebar')

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">

            	<div class="page-content">
                    
                    @yield('content')

            	</div>
				
				<!-- BEGIN PAGE BASE CONTENT -->

            </div><!-- end of page-content-wrapper -->
       	</div><!-- end of page-container -->
		
		<script src="{{ url('plugins/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/js.cookie.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{ url('scripts/app.min.js') }}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{ url('scripts/layout.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('scripts/demo.min.js') }}" type="text/javascript"></script>
        {{-- <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script> --}}
        
        @yield('footer')

    </body>
</html>