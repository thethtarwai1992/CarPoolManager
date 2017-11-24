@extends('layouts.design')
@section('title', '- My Rides') 
@section('styles') 
{!! HTML::style("css/view-details-custom.css") !!} 
<style> 
    @media only screen and (min-width: 992px){
        .rides-list{
            margin-left: 15%;
            margin-right: 15%;
        }
    }
    #colorstar1 { color: #2cc062;}
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>My Rides</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->  

        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="rides-list">  

                <div class="clearfix"></div>

                @if(count($rides) > 0 )

                @foreach ($rides as $booking)
                <a href="#" class="viewdetails" data-toggle="modal" data-id ={{ $booking->booking_id }} data-status = {{ $booking->status }}> 
                    <article class="ride-box clearfix">

                        <div class="ride-content">
                            <h3> <b> {{ $booking->route->pickup }} </b> <i class="fa fa-arrow-right" aria-hidden="true"></i> <b> {{ $booking->route->destination }}</b></h3> 
                        </div>
                        <br>
                        <i class="fa fa-calendar-check-o"></i> Status: {{ $booking->status }}
                        <i class="fa fa-calendar"></i> {{ date('d-m-Y H:i A', strtotime($booking->request_time)) }} 
                        <div class="pull-right">
                            <i class="fa fa-money"></i>  ${{ $booking->price }}
                            Booked Seat(s) <i class="fa fa-user"></i> {{ $booking->seats }}  
                        </div> 
                    </article><!-- end .ride-box -->
                </a>  
                @endforeach
                @else
                <article class="ride-box clearfix">
                    <div class="ride-content">
                        No Record Found.
                    </div>
                </article> 
                @endif 

            </div><!-- end .events-list -->

        </div><!-- end .page-content -->

    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('modals')
@include('rides/details_modal')
@stop

@section('scripts')
<script>
    $('.viewdetails').on('click', function (e) {
        
        var booking_id = $(this).data('id');
        var status = $(this).data('status');
        
        if( status == 'Open'){
            alert("Finding Driver for you!")
            return false;
        }
        //console.log('route' + route_id);
        e.preventDefault();
        $.ajax({
            url: "{{ URL::to('bookings/view') }}/" + booking_id,
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
                $('#datetimeD span').html(data['data']['startend']); 
                var stars="";                                                    
                for(var i = 1; i <= data['data']['star'] ; i++)  {
                    stars += '<i class="glyphicon .glyphicon-star glyphicon-star"></i>';
                   // console.log("stars " + i + " " + stars);
                }                 
                
                for(var i = 1; i <=  data['data']['empty']  ; i++)  {
                    stars += '<i class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></i>';
                } 
                $('#colorstar1 span').html(stars); 
                $('#viewdetails').modal('show');
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

</script> 

@stop