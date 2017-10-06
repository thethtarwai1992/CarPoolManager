<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div><!-- end .modal-header -->

            <div class="modal-body">
                <form action="{{ URL::to("home/login") }}" method="POST" novalidate autocomplete="off" class="idealforms login">

                    <div class="log-header">
                        <span class="log-in">Log in</span>
                    </div>

                    <div class="field">
                        <input name="phone" type="tel" placeholder="Phone Number">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input type="password" name="password" placeholder="Password">
                        <span class="error"></span>
                    </div>
                    
                    <div class="pull-right">
                        <a data-toggle="modal" data-target="#regModal">Create a new account?</a>
                            
                    </div>
                    
                    <div class="field buttons">
                        <button type="submit" class="submit btn green-color">Log in</button> 
                    </div>
 
                    <a href="#" class="log-facebook facebook"><i class="fa fa-facebook"></i>Facebook</a>

                    <div class="clearfix"></div>

                </form><!-- end .login -->
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
                <form action="" novalidate autocomplete="off" class="idealforms reg">

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