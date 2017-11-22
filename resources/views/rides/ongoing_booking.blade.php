@extends('layouts.design')
@section('title', '- Ongoing') 
@section('metatags')
@if($booking)
<meta http-equiv="refresh" content="30" >
@endif
@stop
@section('styles')
{!! HTML::style("css/view-details-custom.css") !!}
<style>
    .modal{
        position: inherit!important;
        display: block;
    }
</style>
@stop
@section('content')  

@if($booking)
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-success alert-dismissable"> 
            @if($booking->status == 'Scheduled')
            <i class="fa fa-hourglass-half"></i> Driver is coming to you. Please sit back and relax.
            @elseif($booking->status == 'PickedUp')
            <i class="fa fa-cab"></i> You are on the way to your destination.
            @elseif($booking->status == 'Closed')             
            <i class="fa fa-check-circle"></i> Your ride is completed! You can share your feedback below!
            @endif
        </div>
    </div>
</div>

<div class="modal" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-body"> 

                <form action="" method="" autocomplete="off" class=""> 
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card hovercard">
                                    <div class="cardheader"> </div>
                                    <div class="avatar">
                                        <img alt="" src="{{ asset('img/female.jpg') }}">
                                    </div>
                                    <div class="info">
                                        <div class="title" id="driverD">
                                            <span>{{ $booking->driver->first_name }} {{ $booking->driver->last_name or ''}}</span>
                                        </div>                                         
                                        <div class="desc" id='contactno'><i class="fa fa-phone"></i> <span> {{ $booking->driver->contactNO or ''}}</span></div>
                                        <div class="desc" id='car'><i class="fa fa-car"></i> <span>{{ $booking->route->driverInfo->car->model }} {{ $booking->route->driverInfo->car->plate_no }} </span></div>
                                    </div>
                                    <div class="line" style='position: inherit!important;'></div>
                                    <div class="bottom" style="float: left; text-align: left; margin-top: 15px;">
                                        <h3> <b> <span id="pickupD"> <span>{{ $booking->route->pickup }}</span></span> </b><i class="fa fa-arrow-right" aria-hidden="true"></i> <b> <span id="destD"> <span>{{ $booking->route->destination }}</span></span> </b></h3> 
                                        Booked Seat(s) <i class="fa fa-user"></i> <span id="seats"><span>{{ $booking->seats }}</span></span>
                                        <div class="pull-right">
                                            <i class="fa fa-money"></i>  <span id="priceD"> <span>{{ $booking->price }}</span></span>
                                        </div> 

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> 
                    @if($booking->status == 'Scheduled')
                    <div class="field buttons"> 
                        <a href="{{ URL::to('booking/cancel') }}" class="confirm button btn btn-warning">Cancel your ride?</a> 
                    </div>        
                    @elseif($booking->status == 'Closed')
                    <div class="field buttons"> 
                        Rating
                    </div>   
                    @endif
                </form><!-- end .login -->
            </div><!-- end .modal-body -->

        </div><!-- end .        modal-content -->
    </div><!-- end .    modal-dialog -->
</div><!-- end .modal -->
@else
<div>
    There is no ongoing booking.

</div>

@endif
@stop

@section('scripts') 
<script>
    $("a.confirm").on('click', function (e) {
        e.preventDefault();
        var location = $(this).attr('href');
        if (confirm("Are you sure you want to cancel the ride?\nNote: You'll not be able to book again for 2 weeks if you cancelled 3 times in a month!") == true) {
            window.location.replace(location);
        }
    });
</script>  
@stop