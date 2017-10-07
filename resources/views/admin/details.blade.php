@extends('main')
@section('title', '- Details') 
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

        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="rides-list">

                <article class="ride-box clearfix">

                    <div class="ride-content">
                        <h3>Driver Registration Details</h3>
                    </div>

                    <ul class="ride-meta">

                        <li> Application Date : July 20, 2017 at 19:00 PM</li> <br>
                        <li> First Name : Anthony</li> <br>
                        <li> Last Name : Yeo</li> <br>
                        <li> Email : yeo.anthony@gmail.com</li> <br>
                        <li> Contact Number : 89126374</li> <br>
                        <li> License Number: S123456W</li> <br>
                        <li> Expiry Date : 12/12/2020</li> <br>
                        <li> Vehicle Plate Number: SJP315D</li> <br>
                        <li> Vehicle Model : BMW</li> <br>
                        <li> Vehicle Manufactured Years: 2016</li> <br>

                    </ul><!-- end .ride-meta -->

                </article><!-- end .ride-box -->

                
                <div class="clearfix">
                
                  <div class="reason"> Remarks:  <input type="text" name="reason"><br></div>
                 
                </div>
                <div class="post-pagination pagination-margin clearfix">

                    <div class="Approve pull-left">
                        <a href="#">
                            Approve
                            <i class="fa fa-chevron"></i>
                        </a>
                    </div>
                    <div class="Reject pull-right">
                        <a href="#">
                            Reject
                            <i class="fa fa-chevron"></i>
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

    $(function () {
        $('#datetimepicker1').datetimepicker();
    });

</script>


{!! HTML::script("js/Moment.js") !!}
{!! HTML::script("js/bootstrap.datetimepicker.js") !!}
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop