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
            <form method="POST" action="" class="form-horizontal"> 
                <h2>Update Profile</h2>
                    <input type="hidden" name="_token" value="">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Phone Number</label>
                        <input type="tel" name="tel" value="95321111" class="form-control">
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