@extends('layouts.driver_main')
@section('title', '- Driver Info') 
@section('styles')
<style> 
</style>
@stop 
@section('content')

<div class="container"> 
    <div class="row">   
        <div class='col-md-6'>
            <form class="form-horizontal">
                <fieldset>

                    <!-- Form Name -->
                    <legend>User Profile</legend>

                    <div class="col-sm-6 col-md-4">
                        <img src="{{ asset('img') }}/{{ Auth::user()->photo }}" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h4> 
                        <br>
                        @if(Auth::user()->is_driver) <small><cite> <i class="fa fa-car"></i> Driver</cite></small> @endif
                        <br>
                        <div class="row">
                        <table>      
                            <tr><td> <i class="fa fa-map-marker"></i> </td><td>Singapore</td></tr>          
                            <tr><td>  <i class="fa fa-envelope"></i> </td><td>{{ Auth::user()->email }}</td></tr>
                            <tr> <td> <i class="fa fa-phone"></i> </td><td>{{ Auth::user()->contactNO }}</td></tr>
                            <tr><td>  <i class="fa fa-id-card"></i> </td><td>{{$driverData->driving_license_no}}</td></tr>
                            <tr> <td>  <i class="fa fa-calendar-o"></i> </td><td>{{ $driverData->driving_license_valid_till }}</td></tr>
                             <tr><td>  <i class="fa fa-info-circle"></i> </td><td>{{ $driverData->plate_no }}</td></tr>
                            <tr> <td>  <i class="fa fa-car"></i>  </td><td>{{ $driverData->model }}</td></tr>
                        </table>
                        </div>
                    </div>
                </fieldset>
            </form>


        </div>

    </div>


</div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('scripts')
<script>


</script>  
@stop