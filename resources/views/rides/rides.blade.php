@extends('layouts.design')
@section('title', '- Rides') 
@section('metatags')
@if($booked)
<meta http-equiv="refresh" content="15" >
@endif
@stop
@section('styles')
{!! HTML::style("css/view-details-custom.css") !!} 
{!! HTML::style("css/loading.css") !!} 
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
        padding: 0;
        padding-bottom: 10px;
    } 
    #floading-panel {
        position: absolute;
        top: 10px;
        left: 35%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
        width : 200px;
    }
    #output-price{
        font-size: 11px;
        float: left;
    } 
    #output{
        font-size: 10px;
        float: right;
    } 
    
    #loading { display: none; }
    #colorstar1 { color: #2cc062;}
    form.idealforms.searchtours .field{
        padding: 0 0.03em!important;
    }
</style>
@stop 

@section('content')
<!--Need to check if user refresh or not after click send for request-->
<div class="loading" id='loading' @if($booked) style="display: block!important;" @endif> </div>

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
 
                        {{ csrf_field() }}
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field"> 
                                <input id="pickup" placeholder="Pickup Address" onFocus="geolocate()" type="text">
                            </div> 
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field"> 
                                <input id="destination" placeholder="Destination Address" onFocus="geolocate()" type="text">
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 col-xs-6">

                            <div class="field">
                                <select id="seats" name="numberOfseats">
                                    <option value="0">Seats</option>
                                    @for($i = 1; $i <5 ; $i++)
                                    <option>{{ $i }}</option> 
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="field">
                                <input name="date" type="text" value="{{ date("d-m-Y") }}" placeholder="Date" class="datepicker" disabled>
                            </div> 
                        </div> 
                </form>
            </div><!-- end .search-content -->
        </div> 
        <div class="col-md-6 col-sm-12 col-xs-12">

            <div id="floading-panel">
                <span id="output-price">Estimated Price</span> 
                <span id="output"></span>
            </div>
            <div id="googleMap" style="width:100%;height:500px;"></div> 


            @if(Auth::check())  
            <div class="field buttons sendRequest">
                <button type="submit" id="request" class="btn btn-lg blue-color">Send Request to Drivers</button>
            </div> 
            @else
            <a href ="{{ URL::to('login') }}">
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
                        <h3>  Book from Today's Posts </h3>
                    </div>

                </div><!-- end .post-pagination -->                   

                <div class="clearfix"></div> 
                @if(count($driverposts) > 0 )

                @foreach ($driverposts as $post)
                @if(Auth::check())
                <a href="#" class="view" data-toggle="modal" data-id ={{ $post->route_id }}> 
                    @else 
                    <a href ="{{ URL::to('login') }}">
                        @endif
                        <article class="ride-box clearfix">

                            <div class="ride-content">
                                <h3> <b> {{ $post->pickup }} </b> <i class="fa fa-arrow-right" aria-hidden="true"></i> <b> {{ $post->destination }}</b></h3> 

                                <i class="fa fa-money"></i>  {{ App\Http\Controllers\RouteController::getPrice($post->pickup,$post->destination ) }}
                                <!--<i class="fa fa-calendar"></i> {{ $post->start }} -->

                            </div>
                            <div class="pull-right">
                                Available Seat(s) <i class="fa fa-user"></i> {{ $post->available_seats }}  
                            </div> 
                        </article><!-- end .ride-box -->
                    </a>
                    @endforeach 
                    @else
                    <article class="ride-box clearfix">
                        <div class="ride-content">
                            Sorry, currently no post from our drivers.
                        </div>
                    </article> 
                    @endif

            </div><!-- end .events-list -->

        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('modals')
@include('rides/view_modal')
@stop

@section('scripts')
<script>
    var pick ;
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
    
    function calculatePrice($distance, $duration){
        var km =$distance / 1000;
        var min =$duration / 60;
        return (km + min)/3.5 + 2;
    }

    $("#request").click(function (e) { //alert($("#seats").val());
        var seats = $("#seats").val();
        var pick = $("#pickup").val();
        var dest = $("#destination").val();
        var token = $("input[name='_token']").val();
        //console.log("Seats :" + seats + ", Price :" + price + ", Start: " + pick + ", End: " + dest);
        e.preventDefault();
        if (seats != 0 && price && pick && dest) {
            $.ajax({
                type: "POST",
                url: "{{ URL::to('rides/request') }}",
                dataType: 'json',
                data: {
                    seats: seats,
                    price: price,
                    pick: pick,
                    dest: dest,
                    _token: token
                },
                success: function (result) {
                    console.log(result);
                    //$('#loading').css("display", "block");
                    alert('Finding driver for you!');
                    window.location.reload();
                },
                error: function (result) {
                    console.log(result['responseJSON']['message']);
                    alert('Error occurred! Please try again.');
                }
            });
        } else {
            alert("Please fill up necessary data!");
        }
    });

    $('.view').on('click', function (e) {
        var route_id = $(this).data('id');
        //alert(route_id);
        //console.log('route' + route_id);
        e.preventDefault();
        $.ajax({
            url: "{{ URL::to('route/view') }}/" + route_id,
            dataType: 'json',
            cache: false,
            success: function (data) {
                console.log(data);

                $('#driverD span').html(data['data']['name']);
                $('#contactno span').html(data['data']['contactno']);
                $('#car span').html(data['data']['car']);
                $('#priceD span').html(data['data']['price']);
                $('#seats span').html(data['data']['seats']);
                $('#pickupD span').html(data['data']['pickup']);
                $('#destD span').html(data['data']['destination']);
                $('#datetimeD span').html(data['data']['datetime']);

                $('#route').val(route_id);
                $('#priceInput').val(data['data']['price']);
                                                                    
                var stars="";                                                    
                for(var i = 1; i <= data['data']['star'] ; i++)  {
                    stars += '<i class="glyphicon .glyphicon-star glyphicon-star"></i>';
                   // console.log("stars " + i + " " + stars);
                }                 
                
                for(var i = 1; i <=  data['data']['empty']  ; i++)  {
                    stars += '<i class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></i>';
                } 
                $('#colorstar1 span').html(stars); 
                $('#details').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    $('button.book').on('click', function (e) {
        var ava_seat = $('#seats span').text();
        var booking_seats = $("#booking_seats").val();
        if (booking_seats > ava_seat) {
            alert("Your booking seats is more than " + ava_seat + " available seat(s)!");
            return false;
        } else if (booking_seats == 0) {
            alert("Please select your booking seats!");
            return false;
        } else {
            //alert ("OK " + booking_seats);
            return true;
        }

    }); 
</script> 
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&libraries=places&callback=myMap"></script>

@stop