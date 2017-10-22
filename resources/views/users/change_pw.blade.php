@extends('layouts.user_main')
@section('title', '- Change Password') 
@section('styles')
<style> 
</style>
@stop 
@section('content')

<div class="container"> 
    <div class="row">   
        <div class='col-md-6'>
            <form method="POST" action="" class="form-horizontal"> 
                <h2>Change Password</h2>
                <input type="hidden" name="_token" value="">
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="name">Old Password</label>
                    <input type="password" name="oldpw" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">New Password</label>
                    <input type="password" name="newpw" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Confirm Password</label>
                    <input type="password" name="confirmpw" value="" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn fa-sign-in"></i> Update
                </button> 
            </form>
        </div> 

    </div><!-- end .row -->
</div><!-- end .container -->

@stop

@section('scripts')
<script>


</script>  
@stop