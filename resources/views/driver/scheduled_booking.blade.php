@extends('layouts.driver_main')
@section('title', '- Rides') 
@section('styles')
<style>
    /* 
           Generic Styling, for Desktops/Laptops 
    */
    table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    /* Zebra striping */
    tr:nth-of-type(odd) { 
        background: #eee; 
    }
    th { 
        background: #333; 
        color: white; 
        font-weight: bold; 
        text-align: center; 
    }
    td, th { 
        padding: 6px; 
        border: 1px solid #ccc; 
        text-align: center; 
    }
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

        td:before { 
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
        td:nth-of-type(1):before { content: "Booking #"; }
        td:nth-of-type(2):before { content: "From"; }
        td:nth-of-type(3):before { content: "Destination"; }
        td:nth-of-type(4):before { content: "Customer"; }
        td:nth-of-type(5):before { content: "Ride Date&Time"; }
        td:nth-of-type(6):before { content: "Total Fare"; }
        td:nth-of-type(7):before { content: "Settlement Price"; }
        td:nth-of-type(8):before { content: "Actions"; }


    </style>
    @stop 

    @section('content')

    <div class="container"> 
        <div class="row">  
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="page-sub-title textcenter">
                    <h2>Scheduled Booking</h2>     
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
                    <tbody>
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
                                @if( $task->b_status== "Scheduled")
                                <button type="button" class="btn btn-success update" data-toggle="modal" value={{ $task->booking_id}}>Picked </button>
                                @elseif( $task->b_status== "PickedUp")
                                <button type="button" class="btn btn-success update" data-toggle="modal" value={{ $task->booking_id}}>Completed </button>
                                @endif       
                            </td>
                            <td>                    
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">More Actions
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="view" href="#" data-toggle="modal" data-id ={{ $task->booking_id}}>View Details</a></li>
                                        <li class="divider"></li>
                                        @if( $task->b_status== "Scheduled")
                                        <li><a class="delete" href="#" data-toggle="modal" value={{ $task->booking_id}}>Cancel Booking</a></li>
                                        @else
                                        <li class="disabled"><a href="#">Cancel Booking</a></li>
                                        @endif
                                    </ul>
                                </div>
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
    @include('driver/cancel_modal')
    @include('driver/update_modal')
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
                    $('#email span').html(data['data']['email']);
                    $('#gender span').html(data['data']['gender']);
                     $('#route_datetime span').html(data['data']['route_datetime']);
                    $('#priceD span').html(data['data']['price']);
                    $('#settlePriceD span').html(data['data']['price'] * 0.9);
                    $('#seats span').html(data['data']['seats']);
                    $('#pickupD span').html(data['data']['pickup']);
                    $('#destD span').html(data['data']['destination']);
                    //$('#noteD span').html(data['data']['notes']);
                    $('#route').val(booking_id);
                    $('#viewModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        $(document).ready(function () {
            $(".delete").click(function () {
                var booking_id = $(this).val();
                $('#booking').val(booking_id);
                $("#cancelModal").modal();
            });
        });

        $('.update').on('click', function (e) {
            var booking_id = $(this).val();
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('task/storeSessionData') }}/" + booking_id,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#title span').html(data['data']['title']);
                    $('#msg1 span').html(data['data']['msg1']);    
                     $('#msg2 span').html(data['data']['msg2']); 
                    $('#updateModal').modal('show');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });

        /*
         $(document).on('click','.delete',function(e){
         var id=$(this).val();
         //alert($(this).val())
         if(confirm('Are you sure to cancel the booking? Your ranking will be downgraded. Click "OK" to continue cancellation.'))
         {
         
         $.ajax({
         type    :   "get",
         url       :   "{{url('driver/task/cancel')}}",
         data    :   {'id' :id},
         success:function(data)
         {
         $('.id'+id).remove();
         }
         })
         }else{
         close();
         }
         })*/

    </script>
    @stop