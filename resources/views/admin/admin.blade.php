@extends('main')
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
    var pick = "default";
    var dest = "default";
    function myMap() {
        var marker = null;

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        var mapProp = {
            center: new google.maps.LatLng(1.290270, 103.851959),
            zoom: 11
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
        var infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                //infoWindow.setPosition(pos);
                //infoWindow.setContent('Your Location');
                //infoWindow.open(map);
                map.setCenter(pos);
                map.setZoom(15);
                marker = new google.maps.Marker({
                    position: pos,
                    draggable: false,
                    animation: google.maps.Animation.DROP
                });

                marker.setMap(map);

            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

        if ($("#pickup").change(function () {
            pick = $(this).val();
            if (pick !== "default" && dest !== "default") {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
            }

        }))
            if ($("#destination").change(function () {
                dest = $(this).val();
                if (pick !== "default" && dest !== "default") {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                }

            }))
                directionsDisplay.setMap(map);
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        directionsService.route({
            origin: document.getElementById('pickup').value,
            destination: document.getElementById('destination').value,
            travelMode: 'DRIVING'
        }, function (response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

</script>


{!! HTML::script("js/Moment.js") !!}
{!! HTML::script("js/bootstrap.datetimepicker.js") !!}
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop