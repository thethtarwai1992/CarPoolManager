@extends('user_main')
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
                        <h4>Thet Htar Wai</h4>
                        <small><cite>Username: Thet Htar</cite></small>
                        <br><br>
                        <p>
                            <i class="fa fa-map-marker"></i> Singapore 
                            <br>
                            <i class="fa fa-envelope"></i> email@example.com
                            <br /> 
                        <i class="fa fa-phone"></i> 95321111
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