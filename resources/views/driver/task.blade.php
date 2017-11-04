@extends('layouts.driver_main')
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
                                <th class="col-md-3 col-sm-6">Contact No.</th>
                                <th class="col-md-3 col-sm-6">Ride Date</th>
                                <th class="col-md-3 col-sm-6">Status</th>
                                <th class="col-md-3 col-sm-6">Fare</th>
                                <th class="col-md-3 col-sm-6">Action</th>
                            </tr>
                             @if(count($tasks) > 0 )

                            @foreach ($tasks as $task)
                            <tr>
                                <td class="col-md-3 col-sm-6">{{ $task->pick_up_point }} </td>
                                <td class="col-md-3 col-sm-6">{{ $task->destination_point }}  </td>
                                <td class="col-md-3 col-sm-6">{{ $task->first_name }} {{ $task->last_name }} </td>
                                @if( $task->b_status != "Canceled" || $task->b_status != "Closed")
                                <td class="col-md-3 col-sm-6"><a href="tel: $task->contactNO">{{ $task->contactNO }} </a> </td>
                                @else
                                <td class="col-md-3 col-sm-6">{{ $task->contactNO }}********</td>
                                @endif
                                <td class="col-md-3 col-sm-6">{{ $task->route_datetime }} </td>
                                <td class="col-md-3 col-sm-6">{{ $task->b_status }} </td>
                                 <td class="col-md-3 col-sm-6"><i class="fa fa-money"></i>{{ $task->price }} </td>
                                <td class="col-md-3 col-sm-6">
                                @if( $task->b_status== "Scheduled")
                                <a href="task/cancel/{{$task->booking_id}}">Cancel</a>
                                @else
                                N.A
                                 @endif        
                                 
                                </td>   
                            </tr>
                             @endforeach
                @else
                <tr>
                                <td class="col-md-3 col-sm-6">
                        No Record Found.
                    </td>   
                            </tr>
                @endif         
                       
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