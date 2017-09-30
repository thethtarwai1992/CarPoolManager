@extends('main')
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
</style>
@stop
@section('search-for-rides')
<div class="col-md-12 col-sm-12 col-xs-12">

    <div class="search-content">

        <form action="" novalidate autocomplete="off" class="idealforms searchtours">

            <div class="row">

                <div class="col-md-3 col-sm-3 col-xs-12">
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

                <div class="col-md-3 col-sm-3 col-xs-12">

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

                <div class="col-md-3 col-sm-3 col-xs-12">

                    <div class="field">
                        <input name="event" type="text" placeholder="Date" class="datepicker">
                    </div>


                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">

                    <div class="field">
                        <select id="destination" name="destination">
                            <option value="default">Number of seats</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">

                    <div class="field buttons">
                        <button type="submit" class="btn btn-lg green-color">Search</button>
                    </div>

                </div>

            </div>


        </form>
    </div><!-- end .search-content -->

</div><!-- end .col-sm-12 -->
@stop

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>Scheduled</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="col-md-6 col-sm-12 col-xs-12">
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

                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3><a href="#">From Plovdiv to Sofia</a></h3> <i class="fa fa-money"></i> 6
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

                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    Read more
                                </a>
                            </li>

                        </ul><!-- end .ride-meta -->

                    </article><!-- end .ride-box -->

                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3><a href="#">From Milano to Rome</a></h3> <i class="fa fa-money"></i> 20
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

                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    Read more
                                </a>
                            </li>

                        </ul><!-- end .ride-meta -->

                    </article><!-- end .ride-box -->

                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3><a href="#">From Lyon to Paris</a></h3> <i class="fa fa-money"></i> 12
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

                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    Read more
                                </a>
                            </li>

                        </ul><!-- end .ride-meta -->

                    </article><!-- end .ride-box -->

                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3><a href="#">From Barcelona to Madrid</a></h3> <i class="fa fa-money"></i> 15
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

                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    Read more
                                </a>
                            </li>
                        </ul><!-- end .ride-meta -->

                    </article><!-- end .ride-box -->

                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3><a href="#">From Munich to Berlin</a></h3> <i class="fa fa-money"></i> 32
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

                            <li>
                                <a href="#">
                                    <i class="fa fa-file"></i>
                                    Read more
                                </a>
                            </li>

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

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->

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