<div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New</h4>
              </div>
              <form method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="container">

                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon"> Name </span>
                        <input name="name" type="text" class="form-control" placeholder="Item Name" required>
                      </div>
                    </div>

                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon"> Price </span>
                        <input name="price" type="text" class="form-control" placeholder="Hint: 999.99" pattern="[0-9]{1,9}[.][0-9]{2}" title="(9.99)(499.99)" required>
                      </div>
                    </div>

                    <div class="col-sm-5">
                      <div class="input-group">
                        <span class="input-group-addon"> Discount </span>
                        <input name="discount" type="text" class="form-control" placeholder="Hint: 10" pattern="[0-9]{1,2}" title="1 - 99">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> Stone </span>
                        <input name="stone" type="text" class="form-control" placeholder="Diamond / Emerald etc">
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> Stone Weight</span>
                        <input name ="stone_weight" type="text" class="form-control" placeholder="Carat (Hint: 1.0)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon"> No. of Stones </span>
                        <input name="num_of_stones" type="text" class="form-control" placeholder="No. of Stones" pattern="[0-9]{1,3}" title="1 - 999">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Material </span>
                        <input name="material" type="text" class="form-control" placeholder="Gold / White Gold etc">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Material Weight</span>
                        <input name ="material_weight" type="text" class="form-control" placeholder="Carat (Hint: 24)" pattern="[0-9]{1,5}">
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Prod. Height </span>
                        <input name="height" type="text" class="form-control" placeholder="Height (Hint: 1.5)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="input-group">
                        <span class="input-group-addon"> Prod. Length</span>
                        <input name ="length" type="text" class="form-control" placeholder="Length (Hint: 1.5)" pattern="[0-9]{1,5}.[0-9]{1,2}">
                      </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <div class="input-group">
                        <span class="input-group-addon"> Images </span>
                        <input type="file" class="" id="usr" name="itemImage[]" multiple required>
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