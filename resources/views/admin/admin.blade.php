@extends('layouts.user_main')
@section('title', '- Home') 
@section('styles')
{!! HTML::style("css/bootstrap.datetimepicker.css") !!}
<style>
    .ride-content{
        float: right;
    }
    .rides-list{
        padding-left: 30px;
    }
    .sendRequest{
        margin-top: 24px;
    }
    #datetimepicker1 fa{
        color:#63a599 ;   
    }
    #datetimepicker1{
        width: 100%;
    }
    .datetimepicker-cus{
        border : none; 
        background: #f4f1e3;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
        width: 2em;
    } 
    .search-content{
        margin: 0;
    }

</style>
@stop


@section('content')

<div class="container"> 
    <div class="row"> 

       <!-- <div class="col-md-6 col-sm-12 col-xs-12">
            <div id="googleMap" style="width:100%;height:500px;"></div> 

            @if(Auth::check())  
            <div class="field buttons sendRequest">
                <button type="submit" class="btn btn-lg blue-color">Send Request to Drivers</button>
            </div> 
            @else
            <a data-toggle="modal" data-target="#loginModal">
                <div class="field buttons sendRequest" >
                    <button type="submit" class="btn btn-lg blue-color">Send Request to Drivers</button>
                </div>
            </a> 
            @endif 
        </div> -->

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="rides-list">

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">New Driver Registration with Car Model</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date -->
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Details
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">New Driver Registration with Car Model</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date -->
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Details
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->
                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">New Driver Registration with Car Model</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date -->
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Details
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->
                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">New Driver Registration with Car Model</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date -->
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Details
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->
                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">New Driver Registration with Car Model</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 19:00 PM
                            </a>
                        </li><!-- end .ride-date -->
                        <li>
                            <a href="./admin/details">
                                <i class="fa fa-file"></i>
                                Details
                            </a>
                        </li>

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
   <div class="col-md-6 col-sm-12 col-xs-12">
       <canvas id="myCanvas" width="200" height="100" style="width:100%;height:500px;">
Your browser does not support the canvas element.
</canvas>

<script>
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "#FF0000";
ctx.fillRect(50,80,30,75);
ctx.fillText("Passengers",30,75);

ctx.fillStyle = "#9FA23A";
ctx.fillRect(100,80,30,75);
ctx.fillText("Drivers",100,75);
</script>
            
   </div>



    </div><!-- end .row -->
</div><!-- end .container -->

@stop


@section('scripts')
<script>


</script>
@stop