@extends('main1')
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

                        <li class="ride-people">
                            <a href="#" class="tooltip-link" data-original-title="Number of seats" data-toggle="tooltip">
                                <i class="fa fa-user"></i>
                                1
                            </a>
                        </li><!-- end .ride-people --> 

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

                        <li class="ride-people">
                            <a href="#" class="tooltip-link" data-original-title="Number of seats" data-toggle="tooltip">
                                <i class="fa fa-user"></i>
                                4
                            </a>
                        </li><!-- end .ride-people --> 

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

                        <li class="ride-people">
                            <a href="#" class="tooltip-link" data-original-title="Number of seats" data-toggle="tooltip">
                                <i class="fa fa-user"></i>
                                3
                            </a>
                        </li><!-- end .ride-people --> 

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

                        <li class="ride-people">
                            <a href="#" class="tooltip-link" data-original-title="Number of seats" data-toggle="tooltip">
                                <i class="fa fa-user"></i>
                                2
                            </a>
                        </li><!-- end .ride-people -->

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

                        <li class="ride-people">
                            <a href="#" class="tooltip-link" data-original-title="Number of seats" data-toggle="tooltip">
                                <i class="fa fa-user"></i>
                                1
                            </a>
                        </li><!-- end .ride-people -->


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
    var outputDiv = document.getElementById('output');
    var outputPrice = document.getElementById('output-price');

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
                calculateDistance();
            }

        }))
            if ($("#destination").change(function () {
                dest = $(this).val();
                if (pick !== "default" && dest !== "default") {
                    calculateAndDisplayRoute(directionsService, directionsDisplay);
                    calculateDistance();
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
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop