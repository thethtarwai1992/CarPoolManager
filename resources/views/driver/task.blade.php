@extends('layouts.driver_main')
@section('title', '- Rides') 
@section('styles')
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
    th{
        font-size: 100%;
        font-weight: bold;
        text-align: center;
        padding:5px;
        margin: 5px;
    }
    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
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

</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>All My Tasks</h2>     
            </div><!-- end .page-sub-title -->

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="5%" style="text-align:center">Booking #</th>
                        <th width="20%">From</th>
                        <th  width="20%">Destination  </th>
                        <th  width="10%">Customer</th>
                        <th  width="15%">Ride Date&Time</th>
                        <th  width="15%">Status</th>
                        <th  width="10%" colspan="2">Total Fare</th>
                        <th  width="10%" colspan="2">Settlement Price</th>
                        <th  width="15%" style="text-align:center" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tasks) > 0 )

                    @foreach ($tasks as $task)
                    <tr class="id{{ $task->booking_id}}">
                        <th scope="row" style="text-align:center">{{ $task->booking_id}}</th>
                        <td>{{ $task->pickup }}</td>
                        <td>{{ $task->destination }}</td>
                        <td>{{ $task->first_name }} {{ $task->last_name }}</td>
                        <td>{{ $task->route_datetime }}</td>
                        <td>{{ $task->b_status }}</td>
                        <td><i class="fa fa-money"></td><td>{{ $task->price }}</td>
                        <td><i class="fa fa-money"></td><td>{{ $task->price*0.9 }}</td>
                        <td style="text-align:center">
                            <button type="button" class="btn btn-primary view" data-toggle="modal" data-id ={{ $task->booking_id}}>View</a>
                           </td>
                        <td style="text-align:center"> 
                            @if( $task->b_status== "Scheduled")
                            <button type="button" class="btn btn-danger delete" data-toggle="modal" value={{ $task->booking_id}}>Cancel</button>
                             @else
                        <button type="button" class="btn btn-info"> N.A</button>
                             @endif  
                        </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <th scope="row" colspan="8">No Record Found.</th>

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
                 $('#settlePriceD span').html(data['data']['price']*0.9);
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
    })
    
</script>
@stop