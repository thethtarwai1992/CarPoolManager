@extends('layouts.main')
@section('title', '- Home')
@section('styles') 
<style>
    #floading-panel {
        position: absolute;
        top: 10px;
        left: 33%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
        width : 50%;
    }
    #output-price{
        font-size: 11px;
        float: left;
    } 
    #output{
        font-size: 10px;
        float: right;
    } 
    
</style>
@section('content')
<div class="container">
    <div class="row">

        <div class="page-content">

            <div class="services clearfix">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="page-sub-title textcenter">
                        <h2>Services</h2>
                        <div class="line"></div>
                    </div><!-- end .page-sub-title -->

                </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->

                <div class="col-md-4 col-sm-4 col-xs-12">

                    <article class="service">

                        <i class="fa fa-car"></i>

                        <h3>Share your ride</h3>
                        <p>Are you getting sick of traveling alone and spent so much money on gas? Share your ride today,and forget about this problems.</p>


                    </article><!-- end .service -->

                </div><!-- end .col-md-4 -->

                <div class="col-md-4 col-sm-4 col-xs-12">

                    <article class="service">

                        <i class="fa fa-users"></i>

                        <h3>Find new friends</h3>
                        <p>Finding new friends is easier than ever,nothing makes better friendship than spending few hours casually chatting with some interesting people.</p>

                    </article><!-- end .service -->

                </div><!-- end .col-md-4 -->

                <div class="col-md-4 col-sm-4 col-xs-12">

                    <article class="service">

                        <i class="fa fa-map-marker"></i>

                        <h3>Go to new places</h3>
                        <p> Find some new favourite place to chill out,you have no longer got excuse for not travelling and discovering. </p>

                    </article><!-- end .service -->

                </div><!-- end .col-md-4 -->

            </div><!-- end .services -->

            <div class="clearfix"></div>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="page-sub-title textcenter">
                    <h2>Pricing</h2>
                    <div class="line"></div>
                </div><!-- end .page-sub-title -->

            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="col-md-4 col-sm-12 col-xs-12">

                    <form action="" novalidate autocomplete="off" class="idealforms searchtours"> 
                        <div class="col-md-12 col-sm-3 col-xs-12">

                            <div class="field"> 
                                <input id="pickup" placeholder="Pickup Address" onFocus="geolocate()" type="text">
                            </div> 
                        </div>

                        <div class="col-md-12 col-sm-3 col-xs-12">
                            <div class="field"> 
                                <input id="destination" placeholder="Destination Address" onFocus="geolocate()" type="text">
                            </div>
                        </div>
<!--
                        <div class="col-md-12 col-sm-3 col-xs-12">
                            <div class="field buttons">
                                <button type="submit" class="btn btn-lg green-color">Get a fare estimate</button>
                            </div>
                        </div>-->
                    </form>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div id="floading-panel"> 
                        <span id="output-price">Estimated Price</span> 
                        <span id="output"></span>
                    </div>

                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>

            </div><!-- end .col-md-12 -->

            <div class="clearfix"></div>

            <div class="last-rides">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <!--                    <div class="page-sub-title textcenter">
                                            <h2>How it works</h2>
                                            <div class="line"></div>
                                        </div> end .page-sub-title -->

                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">


                    <div class="clearfix"></div>



                </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->

            </div><!-- end .last-rides -->


        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('scripts')
<script>
    var pick;
    var dest;
    var price = 0;
    var outputDiv = document.getElementById('output');
    var outputPrice = document.getElementById('output-price');
    var directionsService, directionsDisplay;
    var autocompletePickup, autocompleteDest;
    var typingTimer;                //timer identifier
    var doneTypingInterval = 3000;  //time in ms (5 seconds)

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
                pick = "default";
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });
        $("#destination").keyup(function () {
            clearTimeout(typingTimer);
            if ($('#destination').val()) {
                dest = "default";
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        });
        directionsDisplay.setMap(map);
    }
    function doneTyping() {
        if (pick && dest) {

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
            if (status == 'OK') {
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
                //alert('Error was: ' + status);
                return false;
            } else {
                outputDiv.innerHTML = '';
                outputPrice.innerHTML = '';
                var results = response.rows[0].elements;
                console.log(results[0].distance);
                console.log(results[0].duration);
                outputDiv.innerHTML += results[0].distance.text + ' in ' +
                        results[0].duration.text + '<br>';
                price = calculatePrice(results[0].distance.value, results[0].duration.value);
                outputPrice.innerHTML += 'SGD: ' + price.toFixed(1);
                return true;

            }
        });
    }

    function calculatePrice($distance, $duration) {
        var km = $distance / 1000;
        var min = $duration / 60;
        return (km + min) / 3.5 + 2;
    }


</script> 
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&libraries=places&callback=myMap"></script>

@stop