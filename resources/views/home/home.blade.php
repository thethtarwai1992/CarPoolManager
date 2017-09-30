@extends('main')
@section('title', '- Home')
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
                                <select id="destination" name="destination">
                                    <option value="default">From</option>
                                    <option>Sofia</option>
                                    <option>Plovdiv</option>
                                    <option>Hamburg</option>
                                    <option>Milano</option>
                                    <option>Paris</option>
                                    <option>Madrid</option>
                                    <option>Berlin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-3 col-xs-12">

                            <div class="field">
                                <select id="destination" name="destination">
                                    <option value="default">To</option>
                                    <option>Sofia</option>
                                    <option>Plovdiv</option>
                                    <option>Hamburg</option>
                                    <option>Milano</option>
                                    <option>Paris</option>
                                    <option>Madrid</option>
                                    <option>Berlin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-3 col-xs-12">
                            <div class="field buttons">
                                <button type="submit" class="btn btn-lg green-color">Get a fare estimate</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-8 col-sm-12 col-xs-12">
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>

            </div><!-- end .col-md-12 -->

            <div class="clearfix"></div>

            <div class="last-rides">

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div class="page-sub-title textcenter">
                        <h2>How it works</h2>
                        <div class="line"></div>
                    </div><!-- end .page-sub-title -->

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
    function myMap() {
        var marker = null;
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
                    animation: google.maps.Animation.DROP,
                });

                marker.setMap(map);

            }, function () {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }

    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop