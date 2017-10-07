@extends('main1')
@section('title', '- Rides') 
@section('styles')
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
                <form action="" novalidate autocomplete="off" class="idealforms reg">


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

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8C6FwkrdwpY3ZR7tJ7J3C1Yq-IUf1nZk&callback=myMap"></script>
@stop