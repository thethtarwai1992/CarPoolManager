@extends('layouts.design')
@section('title', '- My Rides') 
@section('styles')
<style> 
    @media only screen and (min-width: 992px){
        .rides-list{
            margin-left: 15%;
            margin-right: 15%;
        }
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>My Rides</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->  

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="rides-list">  

                <div class="clearfix"></div>

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b>Woodlands</b> to <b>Bishan</b></a></h3> <i class="fa fa-money"></i> 16
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2014 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date --> 

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b>Orchard</b> to <b>Bugis</b></a></h3> <i class="fa fa-money"></i> 8
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 18, 2014 at 06:00 AM
                            </a>
                        </li><!-- end .ride-date --> 

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b>Kranji</b> to <b>Boon Lay</b></a></h3> <i class="fa fa-money"></i> 24
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 15, 2014 at 20:00 PM
                            </a>
                        </li><!-- end .ride-date --> 

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b>Red Hill</b> to <b>Paya Laber</b></a></h3> <i class="fa fa-money"></i> 20
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 10, 2014 at 09:00 AM
                            </a>
                        </li><!-- end .ride-date --> 

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b>Jurong East</b> to <b>Pioneer</b></a></h3> <i class="fa fa-money"></i> 12
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 08, 2014 at 22:00 PM
                            </a>
                        </li><!-- end .ride-date --> 


                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <div class="clearfix"></div>

                <div class="post-pagination pagination-margin clearfix">

                    <div class="next pull-right">
                        <a href="#">
                            Next
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>

                </div><!-- end .post-pagination -->

            </div><!-- end .events-list -->

        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop
