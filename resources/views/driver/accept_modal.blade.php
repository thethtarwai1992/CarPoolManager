<!-- View Modal -->
<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          
            <form action=""  method="POST" enctype="multipart/form-data">

                <input name='booking' id='booking' value='' type='hidden'>
                
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Good Job! You have accepted ride successfully. </p>
                    <p>View the booking details at "Scheduled Booking" page. Click <a href="{{URL::to('driver/scheduled')}}">link</a></p>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End of View Modal -->
