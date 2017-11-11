<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div><!-- end .modal-header -->

            <div class="modal-body"> 

                <form action="{{ URL::to("book") }}" method="POST" autocomplete="off" class="idealforms">

                    {{ csrf_field() }}
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
                                        Available Seat(s) <i class="fa fa-user"></i> <span id="seats"><span>2</span></span>
                                        <div class="pull-right">
                                            <i class="fa fa-money"></i>  <span id="priceD"> <span>10</span></span>
                                        </div> 

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div> 

                    <div class="field col-md-6">
                        <select id="booking_seats" name="booking_seats">
                            <option value="0">Number of seats</option>
                            @for($i = 1; $i <5 ; $i++)
                            <option>{{ $i }}</option> 
                            @endfor
                        </select>
                    </div>
                    <div class="field buttons">
                         @if(Auth::check())  
                        <button type="submit" class="book btn btn-primary">Book</button> 
                          @else
                          <a href ="{{ URL::to('login') }}" class="book btn btn-primary">Book</a>
                        @endif
                    </div> 
                </form><!-- end .login -->
            </div><!-- end .modal-body -->

        </div><!-- end .modal-content -->
    </div><!-- end .modal-dialog -->
</div><!-- end .modal -->
