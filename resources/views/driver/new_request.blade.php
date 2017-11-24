@extends('layouts.driver_main')
@section('title', '- Rides') 
@section('styles')
{!! HTML::style("css/table-view.css") !!} 
<style>
    #card_title{
        font-weight: bold;
        margin: 5px 30px 5px 0;
        border-bottom: 1px solid #ddd;
    }
    .card_desc{
        padding:5px;
        margin: 5px 5px 5px 0;
        width: 100%;
    }
    #card_subtitle{
        max-width:30px;
        padding-right: 30px;
        margin: 30px 30px 30px 0;
        font-weight: bold;
    }
    /* 
    Max width before this PARTICULAR table gets nasty
    This query will take effect for any screen smaller than 760px and also iPads specifically.
    */
    @media 
    only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px)  {

        /* Force table to not be like tables anymore */
        table, thead, tbody, th, td, tr { 
            display: block; 
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr { border: 1px solid #ccc; }

        td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
        }

        .main td:before { 
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
        }
        /*
Label the data
        */
       .main td:nth-of-type(1):before { content: "Booking #"; }
       .main td:nth-of-type(2):before { content: "From"; }
        .main td:nth-of-type(3):before { content: "Destination"; }
        .main td:nth-of-type(4):before { content: "Customer"; }
        .main td:nth-of-type(5):before { content: "Ride Date&Time"; }
        .main td:nth-of-type(6):before { content: "Total Fare"; }
        .main td:nth-of-type(7):before { content: "Settlement Price"; }
        .main td:nth-of-type(8):before { content: "Actions"; }


    </style>
    @stop 

    @section('content')

    <div class="container"> 
        <div class="row">  
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="page-sub-title textcenter">
                    <h2>New Ride Request</h2>     
                </div><!-- end .page-sub-title -->

                <table>
                    <thead>
                        <tr>
                            <th>Booking #</th>
                            <th>From</th>
                            <th>Destination  </th>
                            <th>Customer</th>
                            <th>Ride Date&Time</th>
                            <th>Total Fare</th>
                            <th>Settlement Price</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="main">
                        @if(count($tasks) > 0 )
    
                        @foreach ($tasks as $task)
                        <tr class="id{{ $task->booking_id}}">
                            <td>{{ $task->booking_id}}</td>
                            <td>{{ $task->pickup }}</td>
                            <td>{{ $task->destination }}</td>
                            <td>{{ $task->first_name }} {{ $task->last_name }}</td>
                            <td>{{ $task->route_datetime }}</td>
                            <td><i class="fa fa-money"></i> {{ $task->price }}</td>
                            <td><i class="fa fa-money"></i> {{ $task->price*0.9 }}</td>
                            <td>
                                <button type="button" class="btn btn-primary view" data-toggle="modal" data-id ={{ $task->booking_id}}>View</button>
                            </td>
                            <td> 
                                <button type="button" class="btn btn-danger accept" data-toggle="modal" data-id ={{ $task->booking_id}}>Accept</button>
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td scope="row" colspan="9">No Record Found.</td>

                        </tr>
                        @endif   
                    </tbody>
                </table>
            </div>
        </div><!-- end .row -->
    </div><!-- end .container -->

    @stop

    @section('modals')
    @include('driver/details_modal')
    @include('driver/accept_modal')
    @stop


    @section('scripts')
    <script type="text/javascript">
        $('.view').on('click', function (e) {
            var booking_id = $(this).data('id');
            //console.log('route' + route_id);
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('task/view') }}/" + booking_id,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#bookingID span').html(data['data']['booking_id']);
                    $('#name span').html(data['data']['name']);
                    $('#contactno span').html(data['data']['contactno']);
                    $('#priceD span').html(data['data']['price']);
                    $('#settlePriceD span').html(data['data']['price'] * 0.9);
                    $('#seats span').html(data['data']['seats']);
                    $('#pickupD span').html(data['data']['pickup']);
                    $('#destD span').html(data['data']['destination']);
                    $('#noteD span').html(data['data']['notes']);
                    $('#route').val(booking_id);
                    $('#viewModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

 $('.accept').on('click', function (e) {
            var booking_id = $(this).data('id');
            //console.log('route' + route_id);
            e.preventDefault();
              if (confirm('Are you sure to accept the booking?'))
            {
            $.ajax({
                type: "GET",
                url: "{{ URL::to('task/accept') }}/" + booking_id,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $("#acceptModal").modal('show');
                    $('.id' + booking_id).remove();
                    //$('#route').val(booking_id);
                    //$('#viewModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                    alert("fail");
                }
            });
        }else{
            close();
        }
        });

/*
        $(document).on('click', '.accept', function (e) {
            var id = $(this).val();
            //alert($(this).val()) 
            e.preventDefault();
            if (confirm('Are you sure to accept the booking?'))
            {

                $.ajax({
                    type: "get",
                    url: "{{url('driver/task/accept')}}",
                    data: {'id': id},
                    success: function (data)
                    {
                        $('.id' + id).remove();
                    }
                })
            } else {
                close();
            }
        })
        */

    </script>
    @stop