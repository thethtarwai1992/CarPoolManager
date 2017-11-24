<!-- View Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                {{ csrf_field() }}
                <input name='booking' id='booking' value='' type='hidden'>
                
                <div class="modal-header">
                    <h4 class="modal-title" id="title"><span>Title</span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="msg1"><span></span></p>
                    <p id="msg2"><span></span></p>
                </div>
                <div class="modal-footer">        
                    <a href="{{URL::to('driver/task/update')}}"><button  type="button" class="btn btn-primary" >Confirm</button></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End of View Modal -->
