@extends('layouts.user_main')
@section('title', '- Profile') 
@section('styles')
<style> 
</style>
@stop 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">

        <div class="pull-left">
            <h2>Update Profile</h2>
        </div> 
    </div>
</div>


@if (count($errors) > 0)

<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif


{!! Form::model($user, ['method' => 'PATCH','route' => ['user.update', $user->userID], 'class' => 'form-horizontal']) !!}

@include('users.form')

{!! Form::close() !!}


@stop

@section('scripts')
<script>


</script>  
@stop