<div class="modal fade" id="viewdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div><!-- end .modal-header -->

            <div class="modal-body">  
                <input name='route' id='route' value='' type='hidden'>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card hovercard">
                                <div class="cardheader"> </div>
                                <div class="avatar">
                                    <img alt="" src="{{ asset('img/avatar-1.jpg') }}">
                                </div>
                                <div class="info">
                                    <div class="title" id="driverD">
                                        <span>Driver</span>
                                    </div>                                         
                                    <div class="desc" id='contactno'><i class="fa fa-phone"></i> <span>Contact No</span></div>
                                    <div class="desc" id='car'><i class="fa fa-car"></i> <span>Car Model </span></div>
                                </div>
                                <div class="line" style='position: inherit!important;'></div>
                                <div class="bottom" style="float: left; text-align: left; margin-top: 15px;">
                                    <h3> <b> <span id="pickupD"> <span>Woodlands</span></span> </b> -> <b> <span id="destD"> <span>Orchard</span></span> </b></h3> 
                                    Booked Seat(s) <i class="fa fa-user"></i> <span id="seats"><span>2</span></span>
                                    <div class="pull-right">
                                        <i class="fa fa-money"></i>  <span id="priceD"> <span>10</span></span>
                                    </div> 
                                    <i class="fa fa-calendar"></i> <span id="startendD"> <span>--</span></span>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>   
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
    </div><!-- end .modal-dialog -->
</div><!-- end .modal -->
