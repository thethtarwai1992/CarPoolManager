@extends('layouts.design')
@section('title', '- Rides') 
@section('styles')
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
    .search-content{
        margin: 0;
    } 
    .route_title{
        text-align: center;
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>My Routes</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="search-content">

                <form action="postRoute" novalidate autocomplete="off" class="idealforms searchtours" method="post">

                    <div class="row">

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                <select id="pickup" name="pickup">
                                    <option value="default">Pickup Point</option>
                                    <option value="orchard, sg">Orchard</option>
                                    <option value="woodlands, sg">Woodlands</option>
                                    <option value="taiseng, sg">Tai Seng</option> 
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <select id="destination" name="destination">
                                    <option value="default">Destination</option>
                                    <option value="orchard, sg">Orchard</option>
                                    <option value="woodlands, sg">Woodlands</option>
                                    <option value="taiseng, sg">Tai Seng</option> 
                                </select>
                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                             <div class="field">
                                <input name="event" type="text" placeholder="Date" class="datepicker">
                            </div> 
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                 <select id="time" name="Time">
                                    <option value="default">6:00 AM</option>
                                    <option value="1">6:10 AM</option>
                                    <option value="2">6:20 AM</option>
                                    <option value="3">6:30 AM</option>
                                    <option value="4">6:40 AM</option>
                                    <option value="4">6:50 AM</option>
                                </select>
                                
                            </div> 
                        </div>
                        
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                <button type="submit" class="submit btn green-color" style="width: 45%;">Post</button>
                            </div>
                            
                        </div>

                    </div> 
                </form>
            </div><!-- end .search-content -->
        </div> 
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div id="googleMap" style="width:100%;height:500px;"></div> 
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="rides-list"> 
                <h2 class="route_title">My Routes</h2>
                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From Boon Lay to Jurong East</a></h3>
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
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Cancel
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From Jurong East to Boon Lay</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 20, 2017 at 07:30 AM
                            </a>
                        </li><!-- end .ride-date -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Cancel
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From Jurong East Lay to Orchard</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 22, 2017 at 8:00 AM
                            </a>
                        </li><!-- end .ride-date -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Cancel
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From Orchard to Jurong East</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                July 22, 2017 at 18:00 PM
                            </a>
                        </li><!-- end .ride-date -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Cancel
                            </a>
                        </li>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From Jurong East to Woodlands</a></h3>
                    </div>

                    <ul class="ride-meta">

                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                September 16, 2017 at 7:00 AM
                            </a>
                        </li><!-- end .ride-date -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Cancel
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
    
    $("#timepicker").timepicker();
   
</script> 
 {!! HTML::script("js/jquery.timepicker.min.js") !!}
 {!! HTML::script("js/jquery.timepicker.min.css") !!}
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop