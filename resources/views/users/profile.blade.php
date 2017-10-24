@extends('layouts.user_main')
@section('title', '- Profile') 
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
                        <img src="{{ asset('img/avatar-1.jpg') }}" alt="" class="img-rounded img-responsive" />
                    </div>
                    <div class="col-sm-6 col-md-8">
                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h4>
                        <small><cite>Username: {{ Auth::user()->name }}</cite></small>
                        <br>
                        @if(Auth::user()->is_driver) <small><cite> <i class="fa fa-car"></i> Driver</cite></small> @endif
                        <br>
                        <p>
                            <i class="fa fa-map-marker"></i> Singapore 
                            <br>
                            <i class="fa fa-envelope"></i> {{ Auth::user()->email }}
                            <br /> 
                        <i class="fa fa-phone"></i> {{ Auth::user()->contactNO }}
                            <br />
                        </p>

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