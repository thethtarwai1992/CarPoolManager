<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="container"></div><div class="row"></div><div class="row"></div><div class="row"></div><div class="row"></div>ass="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="userID">Driver Details  <span>ID</span></h4>
            </div>
            <div class="modal-body">
                <h4 class="text-center">Driver Information.</h4>
                <table class="table table-striped" id="tblGrid">
                    <thead id="tblHead">
                        <tr>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Gender</th>
                              <th>Driving License No</th>
                            <th>Driving License Valid Till</th>
                            <th>Driver Register Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td id="name"><span></span></td>
                            <td id="contactno"><span></span></td>
                            <td id="email"><span></span></td>
                             <td id="gender"><span></span></td>
                             <td id="driving_license_no"><span></span></td>
                            <td id="driving_license_valid"><span></span></td>
                            <td id="driver_register_date"><span></span></td>
                        </tr>    
                    </tbody>
                </table>
                <div class="row"></div><div class="row"></div>
                <h4 class="text-center">Car Information.</h4>
                <table class="table table-striped" id="tblGrid">
                    <thead id="tblHead">
                        <tr>
                            <th>Car Plate No</th>
                            <th>Car Model</th>
                            <th>Capacity</th>
                            <th>Manufacture Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td id="plate_no"><span></span></td>
                            <td id="carModel"><span></span></td>
                            <td id="capacity"><span></span></td>
                             <td id="manufacture_year"><span></span></td>
                        </tr>    
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info " data-dismiss="modal">Close</button>
            </div>
   
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->