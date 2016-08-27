
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="container">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Name</label></div>
                          <input type="text" class="form-control" id="usr" autofocus placeholder="Item Name" name="itemName" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Value</label></div>
                          <div class="col-sm-12"><input class="form-control" id="usr" autofocus placeholder="Item Value" min="00" name="itemValue" required></div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Discount</label></div>
                          <div class="col-sm-12"><input type="number" class="form-control" id="usr" autofocus placeholder="0" min="00" max="99" name="discount"></div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                          <div class="col-sm-12"><label for="usr">Item Image</label></div>
                          <input type="file" class="form-control" id="usr" name="itemImage[]" multiple required>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-custom" name="addItem" >Submit</button>
                <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>