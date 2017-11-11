<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div><!-- end .modal-header -->

            <div class="modal-body"> 

                <form action="{{ URL::to("book") }}" method="POST" autocomplete="off" class="idealforms">

                    <div class="log-header">
                        <span class="log-in">Route Details</span>
                    </div>
                    {{ csrf_field() }}

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
                                        <div class="desc" id='contactno'><span><i class="fa fa-phone"></i> Contact No</span></div>
                                        <div class="desc" id='car'><span><i class="fa fa-car"></i> Car Model </span></div>
                                    </div>
                                    <div class="bottom">
                                        <div class="col-md-12"> 
                                            Pickup point : <span id="pickupD"> Woodlands</span><br>
                                            Destination : <span id="destD"> Orchard</span> <br>
                                            Price : <span id="priceD"> 10</span><br>
                                            Seat left : <span id="seats">2</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> 

                    <div class="field buttons">
                        <button type="submit" class="submit btn btn-primary">Book</button> 
                    </div> 
                </form><!-- end .login -->
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
    </div><!-- end .modal-dialog -->
</div><!-- end .modal -->
