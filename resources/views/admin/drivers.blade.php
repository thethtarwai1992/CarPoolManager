@extends('layouts.user_main')
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
        td:nth-of-type(1):before { content: "User ID"; }
        td:nth-of-type(2):before { content: "Name"; }
        td:nth-of-type(3):before { content: "Driver License No"; }
        td:nth-of-type(4):before { content: "Driving License Valid Till"; }
        td:nth-of-type(5):before { content: "Driver Register Date"; }
        td:nth-of-type(6):before {content:"Car Plate No";}
        td:nth-of-type(7):before { content: "Car Model"; }
        td:nth-of-type(8):before { content: "Contact No."; }
        td:nth-of-type(9):before { content: "Actions"; }

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
                <h2>Drivers List</h2>     
            </div><!-- end .page-sub-title -->

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>        
                        <th>Driver License No </th>
                        <th>Driving License Valid Till</th>
                        <th>Driver Register Date</th>
                        <th>Car Plate No</th>
                        <th>Car Model</th>
                        <th>Contact No.</th>
                        <th>Status</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($results) > 0 )

                    @foreach ($results as $result)
                    <tr class="id{{ $result->userID}}">
                        <td># {{ $result->userID}}</td>
                        <td>{{ $result->first_name}}{{ $result->last_name}}</td>
                        <td>{{ $result->driving_license_no }}</td>
                        <td>{{ $result->driving_license_valid_till }}</td>
                        <td>{{ $result->driver_register_date }}</td>
                        <td>{{ $result->plate_no }}</td>
                        <td>{{ $result->model }}</td>
                        <td>{{ $result->contactNO }}</td>
                         <td>{{ $result->status }}</td>
                        <td>
                            @if( $result->status== "Pending")
                                <button type="button" class="btn btn-success update" data-toggle="modal" value={{  $result->driving_license_no}}>Active </button>
                            @else
                                <button type="button" class="btn btn-success update" data-toggle="modal" value={{  $result->driving_license_no}}>Disable </button>
                            @endif          
                        </td>
                        <td> 
                            <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">More Actions
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="view" href="#" data-toggle="modal" data-id ={{ $result->driving_license_no}}>View Details</a></li>
                                        <li class="divider"></li>
                                        <li><a class="delete" href="#" data-toggle="modal" value={{ $result->driving_license_no}}>Delete Record</a></li>     
                                    </ul>
                                </div>
                        </td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td scope="row" colspan="10">No Record Found.</td>

                </tr>
                @endif   
                </tbody>
            </table>
        </div>
    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('modals')
@include('admin/details_modal')
@stop


@section('scripts')
<script type="text/javascript">
$('.view').on('click', function (e) {
        var driving_license_no = $(this).data('id');
        //console.log('route' + route_id);
        e.preventDefault();
        $.ajax({
            url: "{{ URL::to('admin/drivers/view') }}/" + driving_license_no,
            dataType: 'json',
            cache: false,
            success: function (data) {
                console.log(data);
                $('#userID span').html(data['data']['userID']);
                $('#name span').html(data['data']['name']);
                $('#contactno span').html(data['data']['contactno']);
                $('#email span').html(data['data']['email']);
                 $('#gender span').html(data['data']['gender']);
                $('#driving_license_no span').html(data['data']['driving_license_no']);
                $('#driving_license_valid span').html(data['data']['driving_license_valid']);
                $('#carModel span').html(data['data']['carModel']);
                $('#plate_no span').html(data['data']['plate_no']);
                $('#capacity span').html(data['data']['capacity']);
                $('#driver_register_date span').html(data['data']['driver_register_date']);
                $('#manufacture_year span').html(data['data']['manufacture_year']);
                $('#route').val(driving_license_no);
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
            var driving_license_no = $(this).data('id');
            e.preventDefault();
            $.ajax({
                url: "{{ URL::to('admin/drivers/update') }}/" + driving_license_no,
                dataType: 'json',
                cache: false,
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
        
     
</script>
@stop