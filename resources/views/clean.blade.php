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
        <link rel="shortcut icon" href="{{ asset('images/shortcut.gif') }}">

        <!-- Bootstrap -->
        {!!  HTML::style("css/bootstrap.min.css") !!}
        <!-- Forms -->
        {!!  HTML::style("css/jquery.idealforms.css") !!}
        <!-- Select  -->
        {!!  HTML::style("css/jquery.idealselect.css") !!}
        <!-- Slicknav  -->
        {!!  HTML::style("css/slicknav.css") !!}
        <!-- Main style -->
        {!!  HTML::style("css/style.css") !!}

        <!-- Modernizr -->
        <script src="js/modernizr.js"></script>

        <!-- Fonts -->
        {!!  HTML::style("css/font-awesome.min.css") !!}
        <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('styles')
        <style type="text/css"> 
        </style>
    </head>

    <body>

        <header class="header">

            <div class="top-menu">

                <section class="container">
                    <div class="row">

                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="user-log">

                                <a data-toggle="modal" data-target="#loginModal">
                                    Log in
                                </a> /
                                <a data-toggle="modal" data-target="#regModal">
                                    Sign up
                                </a>

                            </div><!-- end .user-log -->
                        </div><!-- end .col-sm-4 -->

                        <div class="col-md-8 col-sm-8 col-xs-12">

                            <ul class="social-icons">
                                <li>
                                    <a class="facebook" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="twitter" href="#">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="google" href="#">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>

                        </div><!-- end .col-sm-8 -->

                    </div><!-- end .row -->
                </section><!-- end .container -->

            </div><!-- end .top-menu -->

            <div class="main-baner">

                <div class="fullscreen background parallax clearfix" style="background-image:url('img/tumblr_n7yhhvUQtx1st5lhmo1_1280.jpg');" data-img-width="1600" data-img-height="1064">

                    <div class="main-parallax-content">

                        <div class="second-parallax-content">

                            <section class="container">

                                <div class="row">

                                    <div class="main-header-container clearfix">

                                        <div class="col-md-7 col-sm-12 col-xs-12">

                                            <div class="logo">
                                                <h1>{{ config('constants.TITLE') }}</h1>
                                            </div><!-- end .logo -->

                                        </div><!-- end .col-sm-4 -->

                                        <div class="col-md-5 col-sm-8 col-xs-12">

                                            <nav id="nav" class="main-navigation">

                                                <ul class="navigation">
                                                    <li>
                                                        <a href="{{URL::to('/')}}">Home</a>
                                                    </li> 
                                                    <li>
                                                        <a href="{{URL::to('users/rides')}}">Rides</a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a href="events.html">Events</a>
                                                            </li>
                                                            <li>
                                                                <a href="single-post.html">Single post</a>
                                                            </li>
                                                            <li>
                                                                <a href="single-article.html">Single article</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="add-ride.html">Submit</a>
                                                    </li>
                                                    <li>
                                                        <a href="contact-page.html">Contact</a>
                                                    </li>
                                                </ul>

                                            </nav><!-- end .main-navigation -->

                                        </div><!-- end .col-md-8 -->

                                    </div><!-- end .main-header-container -->

                                    @yield('search-for-rides')

                                </div><!-- end .row -->

                            </section><!-- end .container -->

                        </div><!-- end .second-parallax-content -->

                    </div><!-- end .main-parallax-content -->

                </div><!-- end .background .parallax -->

            </div><!-- end .main-baner -->

        </header><!-- end .header -->

        <section class="main-content">

            <!-- Content -->
            @yield('content')
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
