@extends('layouts.design')
@section('title', '- Rides') 
@section('styles')
<style>
    .ride-content h3{
        font-size: 14px;
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
    #floading-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
        width : 40%;
    }
    #output-price, #output{
        font-size: 10px;
        float: right;
    }
    .output-text{
        float: left;
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>Now</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="search-content">

                <form action="" novalidate autocomplete="off" class="idealforms searchtours">

                    <div class="row">

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field"> 
                                <input id="pickup" placeholder="Pickup Address" onFocus="geolocate()" type="text"></input>
                            </div> 
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field"> 
                                <input id="destination" placeholder="Destination Address" onFocus="geolocate()" type="text"></input>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <select id="" name="numberOfseats">
                                    <option value="default">Number of seats</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                <input name="event" type="text" placeholder="Date" class="datepicker">
                            </div> 
                        </div>

                    </div> 
                </form>
            </div><!-- end .search-content -->
        </div> 
        <div class="col-md-6 col-sm-12 col-xs-12">

            <div id="floading-panel">
                <span class="output-text"><i class="fa fa-taxi"></i> Standard Taxi </span>
                <span id="output-price"></span> <br>
                <span id="output"></span>
            </div>
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
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="rides-list"> 

                <div class="post-pagination pagination-margin clearfix">

                    <div class="text-center">
                        <h3>  Book from Today's Schedule rides</h3>
                    </div>

                </div><!-- end .post-pagination -->                   

                <div class="clearfix"></div>

                @if(count($driverposts) > 0 )

                @foreach ($driverposts as $post)
               <article class="ride-box clearfix">
                    <div class="ride-content">
                        <h3><a href="#">From <b> {{ $post->pickup }} </b> to <b> {{ $post->destination }}</b></a></h3> 
                        <i class="fa fa-money"></i> {{ $ride->price }} 
                    </div>

                    <ul class="ride-meta">
                        <li class="ride-date">
                            <a href="#" class="tooltip-link" data-original-title="Date" data-toggle="tooltip">
                                <i class="fa fa-calendar"></i>
                                {{ $ride->created_at }}  
                            </a>
                        </li><!-- end .ride-date --> 

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
            </div><!-- end .events-list -->

        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('scripts')
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