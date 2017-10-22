@extends('layouts.design')
@section('title', '- Tasks') 
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
                <h2>My Tasks</h2>
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
                                <th class="col-md-3 col-sm-6">Date & Time.</th>
                                <th class="col-md-3 col-sm-6">Status</th>
                                <th class="col-md-3 col-sm-6">Action</th>
                            </tr>

                            <tr>
                                <td class="col-md-3 col-sm-6">Boon Lay</td>
                                <td class="col-md-3 col-sm-6">Novena </td>
                                <td class="col-md-3 col-sm-6">Alan Lee</td>
                                <td class="col-md-3 col-sm-6">July 20, 2017 at 19:00 PM</td>
                                <td class="col-md-3 col-sm-6">Fulfilled</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>   
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Boon Lay</td>
                                <td class="col-md-3 col-sm-6">Orchard</td>
                                <td class="col-md-3 col-sm-6">Jean</td>
                                <td class="col-md-3 col-sm-6">October 08, 2017 at 08:30 AM</td>
                                <td class="col-md-3 col-sm-6">Scheduled</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a>  <a href="#">Cancel</a></td>   
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Orchard</td>
                                <td class="col-md-3 col-sm-6">Lakeside </td>
                                <td class="col-md-3 col-sm-6">James</td>
                                <td class="col-md-3 col-sm-6">September 06, 2017 at 08:00 AM</td>
                                <td class="col-md-3 col-sm-6">Cancel</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>   
                            </tr>
                            <tr>
                                <td class="col-md-3 col-sm-6">Boon Lay</td>
                                <td class="col-md-3 col-sm-6">Woodlands </td>
                                <td class="col-md-3 col-sm-6">Apyt</td>
                                <td class="col-md-3 col-sm-6">October 07, 2017 at 09:00 AM</td>
                                <td class="col-md-3 col-sm-6">Ongoing</td>
                                <td class="col-md-3 col-sm-6"><a href="#">View</a></td>   
                            </tr>
                        </table>

                    </div> 
                </form>
            </div><!-- end .search-content -->
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

    $("#timepicker").timepicker();

</script> 
{!! HTML::script("js/jquery.timepicker.min.js") !!}
{!! HTML::script("js/jquery.timepicker.min.css") !!}
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop