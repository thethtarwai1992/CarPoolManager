<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div><!-- end .modal-header -->

            <div class="modal-body">
                <div class="log-header">
                    <span class="log-in">Log in</span>
                </div>

                <form class="form-horizontal" method="POST" action="{{ route('login') }}" style="padding-left: 20px; padding-right: 20px;">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class=""></label>

                        <div class="field">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class=""></label>

                         <div class="field">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

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
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">  
                            <a class="pull-right" data-toggle="modal" data-target="#regModal">Forgot Your Password?</a>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="field buttons">
                            <button type="submit" class="submit btn btn-primary">Log in</button> 
                        </div>

                    </div>
                    <div class="form-group">
                        <a href="#" class="log-facebook facebook"><i class="fa fa-facebook"></i>Facebook</a>
                    </div> 

                </form>  
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
    </div><!-- end .modal-dialog -->
</div><!-- end .modal -->

<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form action="register" method="post" novalidate autocomplete="off" class="idealforms reg">

                    <div class="log-header">
                        <span class="log-in">Sign up</span>
                    </div>

                    <div class="field">
                        <input name="username" type="text" placeholder="Username">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="email" type="email"  placeholder="E-Mail">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="phone" type="tel"  placeholder="Phone">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input type="password" name="password" placeholder="Password">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="confirmpass" type="password"  placeholder="Confirm Password">
                        <span class="error"></span>
                    </div>
                    <div class="field">
                        <input type="checkbox" name="driver" value="Yes"> Sign up as Driver
                    </div>                   
                    <div class="pull-right">
                        <a data-toggle="modal" data-target="#loginModal">Already have an account?</a>                            
                    </div>
                    <div class="field buttons">
                        <button type="submit" class="submit btn green-color ">Sign up</button> 
                    </div>

                    <div class="clearfix"></div>

                </form><!-- end .reg -->
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
    </div><!-- end .modal-dialog -->
</div><!-- end .modal -->