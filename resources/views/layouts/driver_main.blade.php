<!DOCTYPE html> 
<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="{{ app()->getLocale() }}">  <!--<![endif]-->
    <head>

        <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>{{ config('constants.TITLE') }} @yield('title')</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Styles -->
        <link rel="shortcut icon" href="{{ asset('img/shortcut.gif') }}">

        <!-- Bootstrap -->
        {!!  HTML::style("css/bootstrap.min.css") !!}
         {!!  HTML::style("css/bootstrap-datetimepicker.min.css") !!}
        <!-- Forms -->
        {!!  HTML::style("css/jquery.idealforms.css") !!}
        <!-- Select  -->
        {!!  HTML::style("css/jquery.idealselect.css") !!}
        <!-- Slicknav  -->
        {!!  HTML::style("css/slicknav.css") !!}
        <!-- Main style -->
        {!!  HTML::style("css/style.css") !!}
      
        <!-- Modernizr -->
        {!! HTML::script("js/modernizr.js") !!} 

        <!-- Fonts -->
        <!--        {!!  HTML::style("css/font-awesome.min.css") !!}-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('styles')
        <style type="text/css"> 
            .main-navigation {
                margin: 0.4em 0 0;
            }
            .logo h1{
                font-size: 35px;
            }
            .not-fullscreen, .not-fullscreen .main-parallax-content, .fullscreen.not-overflow, .fullscreen.not-overflow .main-parallax-content{
                min-height: 500px;
            }
            .navbar-nav > li > a{
                color: #465057!important;
                font-size: 15px;
            }
            .container-fluid{
                float: right;
            }
            .navbar{
                margin-top: -11px!important;
                margin-bottom: -11px!important;
            }
            .nav .dropdown > a, .nav .dropdown > a:hover, .nav .dropdown > a:focus{
                background-color: transparent!important;
            } 
            .nav .open .dropdown-menu {
                min-width: 195px;
                background-color: #63a599;
                left : -32px;
            }
            .nav .dropdown-menu li a{                
                padding: 12px;
            }
            .nav .dropdown-menu li a:hover{   
                background-color: #465057;
                color: white;
            }
            .main-navigation ul > li ul{
                top: 86px;
            } 
            .main-header-container{
                margin: 2em 0;
            }            
            .log-facebook{
                width: 100%;
            }
            
            @media only screen and (min-width: 320px) and (max-width: 980px){
                .user-log { padding: 0.6em;}
                .logo h1 {font-size: 25px;}
                .page-sub-title h2{ font-size: 1em;}
                .main-header-container {margin: 1em 0;}
                .not-fullscreen, .not-fullscreen .main-parallax-content, .fullscreen.not-overflow, .fullscreen.not-overflow .main-parallax-content {min-height: 375px;}
                
                .ride-content{float: none;}
            }
            @media only screen and (min-width: 1186px) and (max-width: 1329px){
                .logo{ padding: 1.5em 1em; }
                .logo h1{ font-size: 35px;}
            }

            @media only screen and (min-width: 980px) and (max-width: 1186px){
                /*                 .logo{ padding: 1.5em 1em; }
                                 .logo h1{ font-size: 35px;}*/
                .main-header-container .col-md-5, .main-header-container .col-md-7{width: 100%;}
                .main-navigation{text-align: center;}

            }
        </style>
    </head>

    <body>

        <header class="header">

            <div class="top-menu">

                <section class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-6">
                            <div class="user-log">
                                @if(Auth::check())  
                                <nav class="navbar">
                                    <div class="container-fluid"> 
                                        <ul class="nav navbar-nav"> 
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user-o"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}  <span class="caret"></span></a>
                                                <ul class="dropdown-menu">
                                                   <li><a href="{{URL::to('driver/profile')}}">My Account</a></li>                
                                                    <li><a href="{{URL::to('/')}}">Switch to Passenger?</a></li>
                                                    <li><a href="{{URL::to('logout')}}">Log Out</a></li>
                                                </ul>
                                            </li> 
                                        </ul> 
                                    </div>
                                </nav>
                                @else
                                <a href = "{{ URL::to('/login') }}">
                                    Log in
                                </a> /
                                <a href = "{{ URL::to('/register') }}">
                                    Sign up
                                </a>         
                                @endif

                            </div><!-- end .user-log -->

                        </div><!-- end .col-sm-4 -->
                        <div class="col-md-8 col-sm-8 col-xs-6"> 
                            <ul class="social-icons"> 
                                <li>
                                    <a class="facebook" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                            </ul>

                        </div><!-- end .col-sm-8 -->

                    </div><!-- end .row -->
                </section><!-- end .container -->

            </div><!-- end .top-menu -->
 

            @if (Session::has('failure'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-warning"></i> Failure: {{ Session::get('failure') }}, Please try again.
                    </div>
                </div>
            </div>
            @endif

            @if (Session::has('success'))
            <div class="row">
                <div class="col-sm-12"> 
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-thumbs-up"></i> Success: {{ Session::get('success') }}
                    </div>
                </div>
            </div>
            @endif


            <div class="main-baner">

                <div class="background parallax clearfix" style="background-image:url({{ URL::asset('img/bg.jpg') }});" data-img-width="1600" data-img-height="1064">

                    <div class="main-parallax-content">

                        <div class="second-parallax-content">

                            <section class="container">

                                <div class="row">

                                    <div class="main-header-container clearfix">

                                        <div class="col-md-5 col-sm-12 col-xs-12">

                                            <div class="logo">
                                                <h1>{{ config('constants.TITLE') }}</h1>
                                            </div><!-- end .logo -->

                                        </div><!-- end .col-sm-4 -->

                                        <div class="col-md-7 col-sm-12 col-xs-12">

                                            <nav id="nav" class="main-navigation">

                                                <ul class="navigation">
                                                    <li>
                                                        <a href="{{URL::to('/')}}">Home</a>
                                                    </li> 
                                                    <li>
                                                        <a href="{{URL::to('driver/task')}}">Tasks</a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="{{URL::to('driver/scheduled')}}">Scheduled Booking</a>
                                                            </li>
                                                            <li>
                                                                <a href="{{URL::to('driver/new_request')}}">New Request</a>
                                                            </li> 
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="{{URL::to('driver/route')}}">Routes</a>
                                                    </li>
                                                    <li>
                                                        <a href="add-ride.html">FAQ</a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="contact-page.html">Contact</a>
                                                    </li>
                                                </ul>

                                            </nav><!-- end .main-navigation -->

                                        </div><!-- end .col-md-8 -->

                                    </div><!-- end .main-header-container -->

                                </div><!-- end .row -->

                            </section><!-- end .container --> 

                        </div><!-- end .second-parallax-content -->

                    </div><!-- end .main-parallax-content -->

                </div><!-- end .background .parallax -->

            </div><!-- end .main-baner -->

        </header><!-- end .header -->

        <section class="main-content">

            <!-- Content -->
            @yield('content', 'Content Not Available')
        </section><!-- end .main-content -->

        <footer id="footer">

            <div class="footer-copyright">

                <div class="container">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            Copyright by {{ config('constants.TITLE') }}
                        </div>

                    </div><!-- end .row -->
                </div><!-- end .container -->

            </div><!-- end .footer-copyright -->

        </footer><!-- end #footer -->

        @yield('modals') 
        <!-- Javascript -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Bootstrap -->
        {!! HTML::script("js/bootstrap.min.js") !!}
        <!-- Main jQuery -->
        {!! HTML::script("js/jquery.main.js") !!}
        <!-- Form -->
        {!! HTML::script("js/jquery.idealforms.min.js") !!}
        {!! HTML::script("js/jquery.idealselect.min.js") !!}
        {!! HTML::script("js/jquery-ui-1.10.4.custom.min.js") !!}
        <!-- Menu -->
        {!! HTML::script("js/hoverIntent.js") !!}
        {!! HTML::script("js/superfish.js") !!}
        <!-- Counter-Up  -->
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js")></script>
        {!! HTML::script("js/jquery.counterup.min.js") !!} 
        <!-- Rating  -->
        {!! HTML::script("js/bootstrap-rating-input.min.js") !!}
        <!-- Slicknav  -->
        {!! HTML::script("js/jquery.slicknav.min.js") !!}
        
        <script type="text/javascript">


        </script>


        <!-- Custom Scripts -->
        @yield('scripts')
    </body>
</html>
