<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="container"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="bookingID">Booking Details  <span>ID</span></h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Customer Information</h4>
                <table class="table table-striped" id="tblGrid">
                    <thead id="tblHead">
                        <tr>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Gender</th>
                              <th>Pick Up</th>
                            <th>Destination</th>
                            <th>Ride Date & Time</th>
                            <th>No. of Pax</th>
                            <th>Total Fare</th>
                            <th>Settlement Price </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td id="name"><span></span></td>
                            <td id="contactno"><i class="fa fa-phone"></i><a href="tel: <span></span>"><span></span></a></td>
                            <td id="email"><span></span></td>
                             <td id="gender"><span></span></td>
                            <td id="pickupD"> <span></span></td>
                            <td id="destD">  <span></span></td>
                            <td id="route_datetime">  <span></span></td>
                            <td id="seats"><i class="fa fa-user"></i><span></span></td>
                             <td id="priceD"><i class="fa fa-money"></i><span></span></td>
                              <td id="settlePriceD"><i class="fa fa-money"></i><span></span></td>
                        </tr>    
                    </tbody>
                </table>
                <div class="row"></div><div class="row"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info " data-dismiss="modal">Close</button>
            </div>
   
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->