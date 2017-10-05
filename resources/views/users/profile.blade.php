@extends('main')
@section('title', '- Profile') 
@section('styles')
<style> 
</style>
@stop 
@section('content')

<div class="container"> 
    <div class="row">   
        <div class="col-md-6 col-sm-12 col-xs-12">
             
        </div>

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

</script> 
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop