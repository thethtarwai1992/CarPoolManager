<div class="container"> 
    <div class="row">   
        <div class='col-md-6'> 
            <div class="form-group">
                <label for="first_name">First Name</label>
                {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                <label for="phone_number">Contact Number</label>
                {!! Form::text('contactNO', null, array('placeholder' => 'Contact Number','class' => 'form-control')) !!}
            </div>
<!--            <div class="form-group">
                <label for="email">Email</label>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>-->
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-sign-in"></i> Update
            </button>  
        </div> 

    </div><!-- end .row -->
</div><!-- end .container --> 