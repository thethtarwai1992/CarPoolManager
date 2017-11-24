@extends('layouts.design')
@section('title', '- Driver Register') 
@section('styles')
{!! HTML::style("css/bootstrap.datetimepicker.css") !!} 
<style>
    .ride-content{
        float: right;
    }
    .rides-list{
        padding-left: 30px;
    }
    .sendRequest{
        margin-top: 24px;
    } 
    .search-content{
        margin: 0;
    } 
    .route_title{
        text-align: center;
    }
     #datetimepicker1 fa{
        color:#63a599 ;   
    }
    #datetimepicker1{
        width: 100%; 
    }
    .datetimepicker-cus{
        border : none; 
        background: #f4f1e3;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
        width: 2em;
    } 
        #colorstar1 { color: #2cc062;}
    .timepicker-picker span.glyphicon {
        color :#63a599!important;
    }

    .timepicker-picker .btn:hover{
        background: transparent!important;
    }
</style>
@stop 

@section('content')

<div class="container"> 
    <div class="row">  
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="page-sub-title textcenter">
                <h2>Register as Driver</h2>
                <div class="line"></div>
            </div><!-- end .page-sub-title -->

        </div><!-- end .col-md-12 col-sm-12 col-xs-12 -->
            
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form action="register/store" novalidate autocomplete="off" class="idealforms reg" method="post">
                     {{ csrf_field() }}
                    <div class="field">
                        <input name="plateNo" type="text" placeholder="Car Plate No">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="model" type="text"  placeholder="Car Model">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="maxPass" type="text"  placeholder="Max. of Passengers">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input type="text" name="manufactureYear" placeholder="Manufacture Year">
                        <span class="error"></span>
                    </div>

                    <div class="field">
                        <input name="licenseNo" type="text"  placeholder="Driving License No">
                        <span class="error"></span>
                    </div>
                    <div class="field">
                         <div class='input-group date' id=''>
                        <input type='text' placeholder="Driving License Valid Till" id="" name="expiryDate" class="form-control datepicker"/>
                        <span class="input-group-addon ">
                            <span class="fa fa-calendar-o" style="color :#63a599;"></span>
                        </span>
                         </div> 
                        <span class="error"></span>
                    </div>                
                    
                    <div class="field buttons">
                        <button type="submit" class="submit btn green-color ">Submit</button> 
                    </div>

                    <div class="clearfix"></div>

                </form><!-- end .reg -->
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
   
</div><!-- end .modal -->
        </div> 
</div><!-- end .container -->

@stop

@section('scripts')
<script>
  $(function () { 
        $('.datepicker').datepicker({});
    });
    </script> 
{!! HTML::script("js/Moment.js") !!}
{!! HTML::script("js/bootstrap.datetimepicker.js") !!}
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop