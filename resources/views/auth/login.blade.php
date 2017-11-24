@extends('layouts.design')

@section('styles')
<style>
    .login-cus{
        padding-left: 10px;
        padding-right: 10px;
    }
 
</style>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default"> 

                <div class="panel-body">
                    <div class="log-header">
                        <span class="log-in">Log in</span>
                    </div>

                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group login-cus">

                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" checked="true" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">  
                                  <a class="pull-right" href="{{ route('password.request') }}"> Forgot Your Password?</a>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="field buttons">
                                <button type="submit" class="submit btn btn-primary">Log in</button> 
                            </div>

                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
