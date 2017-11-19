<!-- View Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          
            <form action="{{URL::to('driver/task/cancel')}}"  method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                <input name='booking' id='booking' value='' type='hidden'>
                
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to cancel the booking? </p>
                    <p>Your ranking may be downgraded. </p>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="card hovercard">
                                    <div class="cardheader"> </div>
                                    <div class="info"> 
                                        <div>
                                            <fieldset class="form-group">
                                                <legend>Select Cancellation Reasons:</legend>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="reasons" id="" value=" Car Under Maintenance" checked="">
                                                        Car Under Maintenance
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="reasons" id="" value=" Unable to fulfill ride due to unexpected reasons(accident,sick)">
                                                        Unable to fulfill ride due to unexpected reasons(accident,sick)
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="reasons" id="" value="Others">
                                                        Others
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile"><strong>Submit Support Doc </strong>(File Type: jpeg, bmp, png; Max. Size 2MB)</label>
                                                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name="supportDoc">
                                                @if (count($errors) > 0)
                                                         @foreach ($errors->all() as $error)
                                           <span class="help-block">
                                               <li><strong style="color:red">{{ $error }}</strong></li>
                                           </span>
                                      @endforeach
                                      @endif
                                                </div>
                                            </fieldset>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div> 
                </div>
                <div class="modal-footer">        
                    <button  type="submit" class="cancel btn btn-danger" >Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- End of View Modal -->
