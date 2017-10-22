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
     th{
        font-size: 100%;
        font-weight: bold;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>Ride Now</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->
         <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="search-content">

                <form action="" novalidate autocomplete="off" class="idealforms searchtours">

                    <div class="row">
                        <table>
                            <tr>
                                <th class="col-md-3 col-sm-6" id="title">From</th>
                                <th class="col-md-3 col-sm-6">Destination</th>
                                <th class="col-md-3 col-sm-6">Customer</th>    
                                <th class="col-md-3 col-sm-6">No. of Pax</th>
                                <th colspan="2" class="col-md-3 col-sm-6" style="text-align: center;">Action</th>
                            </tr>

                            <tr>
                                <td class="col-md-3 col-sm-6">Woodlands</td>
                                <td class="col-md-3 col-sm-6">Orchard </td>
                                <td class="col-md-3 col-sm-6">Janice</td>
                                <td class="col-md-3 col-sm-6">1</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>
                                <td class="col-md-3 col-sm-6"><a href="#">Accept</a></td>   
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Boon Lay</td>
                                <td class="col-md-3 col-sm-6">Orchard</td>
                                <td class="col-md-3 col-sm-6">Jean</td>
                                <td class="col-md-3 col-sm-6">2</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>
                                <td class="col-md-3 col-sm-6"><a href="#">Accept</a></td>   
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Orchard</td>
                                <td class="col-md-3 col-sm-6">Lakeside </td>
                                <td class="col-md-3 col-sm-6">James</td>
                                <td class="col-md-3 col-sm-6">1</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>
                                <td class="col-md-3 col-sm-6"><a href="#">Accept</a></td>  
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Boon Lay</td>
                                <td class="col-md-3 col-sm-6">Woodlands </td>
                                <td class="col-md-3 col-sm-6">Apyt</td>
                                <td class="col-md-3 col-sm-6">1</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>
                                <td class="col-md-3 col-sm-6"><a href="#">Accept</a></td> 
                            </tr>
                        </table>

                    </div> 
                </form>
            </div><!-- end .search-content -->
        </div> 
        
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div id="googleMap" style="width:100%;height:500px;"></div> 
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="rides-list"> 
                <article class="ride-box clearfix">
                    <h3>From Woodlands to Orchard</h3>
                   

                    <ul class="ride-meta">

                        <li class="ride-date">
                               Estimated Fare:  <i class="fa fa-money"></i> 6
                  
                        </li><!-- end .ride-date -->

                        <li class="ride-people">
                                <i class="fa fa-user"></i>
                                1
                        </li><!-- end .ride-people -->

                        <li>
                                <i class="fa fa-user"></i>
                                Janice
                        </li>
                          <li>
                           
                                <i class="fa fa-file"></i>
                                Note: Wait at Woodlands Shopping Centre Taxi Stand.Thank you! 
                        `</li>
                         
                    </ul><!-- end .ride-meta -->
                    
                    <br>
                  <div class="field">
                                <button type="submit" class="submit btn green-color" style="width: 45%;">Accept</button>
                 </div>
                </article><!-- end .ride-box -->
               
                <div class="clearfix"></div>
                
              
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

</script> 
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop