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

                <form action="route/store" novalidate autocomplete="off" class="idealforms searchtours" method="post">
                    {{ csrf_field() }}
                    <div class="row">

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                <input id="pickup" placeholder="Pickup Address" onFocus="geolocate()" type="text" name="pickup"></input>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <input id="destination" placeholder="Destination Address" onFocus="geolocate()" type="text" name="destination"></input>
                            </div>

                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <input name="dateTime" type="text" placeholder="Date" class="datetimepicker" >
                            </div> 
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <input id="seats" placeholder="Seats" type="text" name="seats"></input>
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
            <div class="rides-list"> 
                <h2 class="route_title">My Routes</h2>
                @if(count($routes) > 0 )

                @foreach ($routes as $route)
                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3><a href="#">From <b> {{ $route->pick_up_point }} </b> to <b> {{ $route->destination_point }}</b></a></h3> 
                        <i class="fa fa-money"></i> {{ $route->price }} 
                    </div>

                    <ul class="ride-meta">
                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                {{ $route->created_date }}  
                            </a>
                        </li><!-- end .ride-date --> 
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                Edit
                            </a>
                        </li> <!-- end .edit route info. 3 days in advance for updating info  -->

                        <li>
                            <a href="{{URL::to('route/cancel/')}}">
                                <i class="fa fa-file"></i>
                                Cancel
                            </a>
                        </li>
                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->
                @endforeach
                @else
                <article class="ride-box clearfix">
                    <div class="ride-content">
                        No Record Found.
                    </div>
                </article> 
                @endif         

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
<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
                                    $('.datetimepicker').datetimepicker({
                                        //language:  'fr',
                                        minDate: 0,
                                        weekStart: 1,
                                        todayBtn: 1,
                                        autoclose: 1,
                                        todayHighlight: 1,
                                        startView: 2,
                                        forceParse: 0,
                                        showMeridian: 1
                                    });
</script>  
<script>
    var pick = "default";
    var dest = "default";
    var outputDiv = document.getElementById('output');
    var outputPrice = document.getElementById('output-price');
    var directionsService, directionsDisplay;
    var autocompletePickup, autocompleteDest;
    var typingTimer;                //timer identifier
    var doneTypingInterval = 5000;  //time in ms (5 seconds)

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocompletePickup.setBounds(circle.getBounds());
                autocompleteDest.setBounds(circle.getBounds());
            });
        }
    }

    function myMap() {
        autocompletePickup = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('pickup')),
                {types: ['geocode']});
        autocompletePickup.setComponentRestrictions({'country': ['sg']});
        autocompleteDest = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('destination')),
                {types: ['geocode']});
        autocompleteDest.setComponentRestrictions({'country': ['sg']});

        var marker = null;

        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer;

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
        $("#pickup").keyup(function () {
            clearTimeout(typingTimer);
            if ($('#pickup').val()) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });
        $("#destination").keyup(function () {
            clearTimeout(typingTimer);
            if ($('#destination').val()) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });
        directionsDisplay.setMap(map);
    }
    function doneTyping() {
        if (pick && dest) {
            console.log("ok");
            calculateAndDisplayRoute(directionsService, directionsDisplay);
            calculateDistance();
        }
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

    function calculateDistance() {
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
            origins: [document.getElementById('pickup').value],
            destinations: [document.getElementById('destination').value],
            travelMode: 'DRIVING',
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        }, function (response, status) {
            if (status !== 'OK') {
                alert('Error was: ' + status);
            } else {
                outputDiv.innerHTML = '';
                outputPrice.innerHTML = '';
                var results = response.rows[0].elements;
                console.log(results[0].distance.text);
                console.log(results[0].duration.text);
                outputDiv.innerHTML += results[0].distance.text + ' in ' +
                        results[0].duration.text + '<br>';
                outputPrice.innerHTML += 'SGD: 10';


            }
        });
    }
</script> 
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&libraries=places&callback=myMap"></script>

@stop