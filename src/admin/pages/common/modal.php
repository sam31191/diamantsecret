<!-- Edit Item Modal -->
<div id="promptEditItem" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span id="item_to_edit">Edit</span></h4>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="container">
            <div class="col-sm-12">
                <tbody>

                    <tr>
                        <td><span class="table-item-label" style="display:none;">Category</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_category" name="category" class="select-style" hidden>
                                    <option value="">Category</option>
                                    <option value="1">Ring</option>
                                    <option value="2">Earring</option>
                                    <option value="3">Pendant</option>
                                    <option value="4">Necklace</option>
                                    <option value="5">Bracelet</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Subcategory</span> </td>
                        <td>
                            <div class="table-item">
                                
                                <select id="edit_ring_subcategory" name="ring_subcategory" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $query = $pdo->prepare("SELECT * FROM `ring_subcategory` WHERE `category_id` = 1");
                                    $query->execute();
                                    if ( $query->rowCount() > 0 ) {
                                        $query = $query->fetchAll();
                                        foreach ( $query as $option ) {
                                            echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item-label"><span class="table-item-label">Name</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_product_name" name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Price</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_product_price" name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.,]{1}[0-9]{2,2}" title="Format: 100.00">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Discount</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_discount" name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Pieces in Stock</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_pieces_in_stock" name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Days for Shipment</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_days_for_shipment" name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Total Gold Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_total_gold_weight" name="total_gold_weight" type="text" class="form-control" placeholder="Total Gold Weight (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Total Carat Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_total_carat_weight" name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Carat Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_color_stone_carat" name="color_stone_carat" type="text" class="form-control" placeholder="Color Stone Carat (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Number of Stones</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_no_of_stones" name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Number of Colored Stones</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_no_of_color_stones" name="no_of_color_stones" type="text" class="form-control" placeholder="Color Stones (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Diamond Shape</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_diamond_shape" name="diamond_shape" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
                                    $diamShapes->execute();
                                    if ( $diamShapes->rowCount() > 0 ) {
                                        foreach ( $diamShapes->fetchAll() as $option ) {
                                            echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Shape</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_color_stone_shape" name="color_stone_shape" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
                                    $diamShapes->execute();
                                    if ( $diamShapes->rowCount() > 0 ) {
                                        foreach ( $diamShapes->fetchAll() as $option ) {
                                            echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Clarity</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_clarity" name="clarity" class="select-style" required>
                                    <option value="">Select</option>
                                    <option value="FL">FL</option>
                                    <option value="IF">IF</option>
                                    <option value="VVS1">VVS1</option>
                                    <option value="VVS2">VVS2</option>
                                    <option value="VS1">VS1</option>
                                    <option value="VS2">VS2</option>
                                    <option value="SI1">SI1</option>
                                    <option value="SI2">SI2</option>
                                    <option value="SI3">SI3</option>
                                    <option value="I1">I1</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_color" name="color" class="select-style" required>
                                    <option value="">Select</option>
                                    
                                    <?php 
                                    $fetchAvailableColors = $pdo->prepare("SELECT * FROM color");
                                    $fetchAvailableColors->execute();
                                    if ( $fetchAvailableColors->rowCount() > 0) {
                                        foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
                                            echo '<option value="'. $availableColors["id"] .'">'. $availableColors["color"] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Diamond Color</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_diamond_color" name="diamond_color" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $fetchAvailableColors = $pdo->prepare("SELECT * FROM diamond_color");
                                    $fetchAvailableColors->execute();
                                    if ( $fetchAvailableColors->rowCount() > 0) {
                                        foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
                                            echo '<option value="'. $availableColors["id"] .'">'. $availableColors["diamond_color"] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Material</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_material" name="material" class="select-style" required>
                                    <?php 
                                    $query = $pdo->prepare("SELECT * FROM `materials`");
                                    $query->execute();
                                    if ( $query->rowCount() > 0 ) {
                                        $query = $query->fetchAll();
                                        foreach ( $query as $entry ) {
                                            echo '<option value="'. $entry['id'] .'">'. $entry['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Gold Quality</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_gold_quality" name="gold_quality" type="text" class="form-control" placeholder="Gold Quality">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Type</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_color_stone_type" name="color_stone_type" type="text" class="form-control" placeholder="Color Stone Type">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Height</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_height" name="height" type="text" class="form-control" placeholder="Height (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Width</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_width" name="width" type="text" class="form-control" placeholder="Width (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Length</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_length" name="length" type="text" class="form-control" placeholder="Length (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Country</span></td>
                        <td>
                            <div class="table-item">
                                <select id="edit_country_id" name="country_id" class="select-style" required>
                                    <option value="">Select</option>
                                    <option value="1">Austria</option>
                                    <option value="2">Belgium</option>
                                    <option value="3">Bulgaria</option>
                                    <option value="4">Croatia</option>
                                    <option value="5">Cyprus</option>
                                    <option value="6">Czech Republic</option>
                                    <option value="7">Denmark</option>
                                    <option value="8">Estonia</option>
                                    <option value="9">Finland</option>
                                    <option value="10">France</option>
                                    <option value="11">Germany</option>
                                    <option value="12">Greece</option>
                                    <option value="13">Hungary</option>
                                    <option value="14">Ireland</option>
                                    <option value="15">Italy</option>
                                    <option value="16">Latvia</option>
                                    <option value="17">Lithuania</option>
                                    <option value="18">Luxembourg</option>
                                    <option value="19">Malta</option>
                                    <option value="20">Netherlands</option>
                                    <option value="21">Poland</option>
                                    <option value="22">Portugal</option>
                                    <option value="23">Romania</option>
                                    <option value="24">Slovakia</option>
                                    <option value="25">Slovenia</option>
                                    <option value="26">Spain</option>
                                    <option value="27">Sweden</option>
                                    <option value="28">UK</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        Company
                        <td>
                            <div class="table-item">
                                <select id="edit_company_id" name="company_id" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
                                    $getCompanies->execute();

                                    if ( $getCompanies->rowCount() > 0 ) {
                                        foreach ( $getCompanies as $company ) {
                                            echo '<option value="'. $company['id'] .'" >'. $company['company_name'] .'</option>';
                                        }
                                    } else {
                                        echo '<option value="0">N/A</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Internal ID</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_internal_id" name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
                            </div>
                        </td>
                    </tr>
                    <div id="ringExclusiveEditDiv">
                    <tr>
                        <td> <span class="table-item-label">Ring Size</span></td>
                        <td>
                            <div class="table-item">
                                <input id="edit_ring_size" name="ring_size" type="text" class="form-control" placeholder="Ring Size, Numbers separator (,) 50,51,52, / Range, separator (-) 55-60" required>
                            </div>
                        </td>
                    </tr>
                    </div>
                    <tr>
                        <td> <span class="table-item-label">Lab Grown Diamond</span> </td>
                        <td>
                            <div class="table-item">
                                <input type="radio" name="lab_grown" required  id="edit_lab_grown" value="1">Yes<br>
                                <input type="radio" name="lab_grown" required  required  id="edit_lab_grown" value="0">No
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="table-item-label">Description</span>
                        </td>
                        <td>
                            <div class="table-item">
                                <textarea id="edit_description" name="description" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="table-item-label">Description (French)</span>
                        </td>
                        <td>
                            <div class="table-item">
                                <textarea id="edit_description_french" name="description_french" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </div>  
        </div>
      </div>
      <div class="modal-footer">
        <input id="unique_key" name="unique_key" hidden/>
        <button type="submit" class="btn btn-custom" name="editItem" id="editItem" >Submit</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Edit Item Modal END -->
<!-- Add Item Modal -->
<div id="promptAddItem" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New</span></h4>
      </div>
      <form method="post" enctype="multipart/form-data" id="addItemForm" action="post.php">
      <div class="modal-body">
        <div class="container">
            <div class="col-sm-12">
                <tbody>

                    <tr>
                        <td><span class="table-item-label">Category</span></td>
                        <td>
                            <div class="table-item">
                                <select id="category" name="category" class="select-style" required onchange="selectCategory(this.value)">
                                    <option value="">Category</option>
                                    <option value="1">Ring</option>
                                    <option value="2">Earring</option>
                                    <option value="3">Pendant</option>
                                    <option value="4">Necklace</option>
                                    <option value="5">Bracelet</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Subcategory</span> </td>
                        <td>
                            <div class="table-item">
                                
                                <select id="ring_subcategory" name="ring_subcategory" class="select-style" required disabled>
                                    <option value="">Select Category First</option>
                                
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <td class="table-item-label"><span class="table-item-label">Name</span></td>
                        <td>
                            <div class="table-item">
                                <input id="product_name" name="product_name" type="text" class="form-control" placeholder="Product Name (50 Characters)" required maxlength="50" pattern=".{0,50}" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Price</span></td>
                        <td>
                            <div class="table-item">
                                <input id="product_price" name="product_price" type="text" class="form-control" placeholder="Product Price € (Decimal Number)" required pattern="[0-9]{1,}[.,]{1}[0-9]{2,2}" title="Format: 100.00">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Discount</span></td>
                        <td>
                            <div class="table-item">
                                <input id="discount" name="discount" type="text" class="form-control" placeholder="Discount % (Number)" pattern="[0-9]{1,2}" title="0 - 99%">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Pieces in Stock</span></td>
                        <td>
                            <div class="table-item">
                                <input id="pieces_in_stock" name="pieces_in_stock" type="text" class="form-control" placeholder="Stock (Number)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Days for Shipment</span></td>
                        <td>
                            <div class="table-item">
                                <input id="days_for_shipment" name="days_for_shipment" type="text" class="form-control" placeholder="Shipment (Number)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Total Gold Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="total_gold_weight" name="total_gold_weight" type="text" class="form-control" placeholder="Total Gold Weight (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Total Carat Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="total_carat_weight" name="total_carat_weight" type="text" class="form-control" placeholder="Total Carat (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Carat Weight</span></td>
                        <td>
                            <div class="table-item">
                                <input id="color_stone_carat" name="color_stone_carat" type="text" class="form-control" placeholder="Color Stone Carat (Decimal Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Number of Stones</span></td>
                        <td>
                            <div class="table-item">
                                <input id="no_of_stones" name="no_of_stones" type="text" class="form-control" placeholder="Stones (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Number of Colored Stones</span></td>
                        <td>
                            <div class="table-item">
                                <input id="no_of_stones" name="no_of_color_stones" type="text" class="form-control" placeholder="Color Stones (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Diamond Shape</span></td>
                        <td>
                            <div class="table-item">
                                <select id="diamond_shape" name="diamond_shape" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
                                    $diamShapes->execute();
                                    if ( $diamShapes->rowCount() > 0 ) {
                                        foreach ( $diamShapes->fetchAll() as $option ) {
                                            echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Shape</span></td>
                        <td>
                            <div class="table-item">
                                <select id="color_stone_shape" name="color_stone_shape" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $diamShapes = $pdo->prepare("SELECT * FROM `diamond_shape`");
                                    $diamShapes->execute();
                                    if ( $diamShapes->rowCount() > 0 ) {
                                        foreach ( $diamShapes->fetchAll() as $option ) {
                                            echo '<option value="'. $option['id'] .'">'. $option['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Clarity</span></td>
                        <td>
                            <div class="table-item">
                                <select id="clarity" name="clarity" class="select-style" required>
                                    <option value="">Select</option>
                                    <option value="FL">FL</option>
                                    <option value="IF">IF</option>
                                    <option value="VVS1">VVS1</option>
                                    <option value="VVS2">VVS2</option>
                                    <option value="VS1">VS1</option>
                                    <option value="VS2">VS2</option>
                                    <option value="SI1">SI1</option>
                                    <option value="SI2">SI2</option>
                                    <option value="SI3">SI3</option>
                                    <option value="I1">I1</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color</span></td>
                        <td>
                            <div class="table-item">
                                <select id="color" name="color" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $fetchAvailableColors = $pdo->prepare("SELECT * FROM color");
                                    $fetchAvailableColors->execute();
                                    if ( $fetchAvailableColors->rowCount() > 0) {
                                        foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
                                            echo '<option value="'. $availableColors["id"] .'">'. $availableColors["color"] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Diamond Color</span></td>
                        <td>
                            <div class="table-item">
                                <select id="diamond_color" name="diamond_color" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $fetchAvailableColors = $pdo->prepare("SELECT * FROM diamond_color");
                                    $fetchAvailableColors->execute();
                                    if ( $fetchAvailableColors->rowCount() > 0) {
                                        foreach ( $fetchAvailableColors->fetchAll() as $availableColors ) {
                                            echo '<option value="'. $availableColors["id"] .'">'. $availableColors["diamond_color"] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><span class="table-item-label">Material</span></td>
                        <td>
                            <div class="table-item">
                                <select id="material" name="material" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $query = $pdo->prepare("SELECT * FROM `materials`");
                                    $query->execute();
                                    if ( $query->rowCount() > 0 ) {
                                        $query = $query->fetchAll();
                                        foreach ( $query as $entry ) {
                                            echo '<option value="'. $entry['id'] .'">'. $entry['category'] .'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Gold Quality</span></td>
                        <td>
                            <div class="table-item">
                                <input id="gold_quality" name="gold_quality" type="text" class="form-control" placeholder="Gold Quality">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Color Stone Type</span></td>
                        <td>
                            <div class="table-item">
                                <input id="color_stone_type" name="color_stone_type" type="text" class="form-control" placeholder="Color Stone Type">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Height</span></td>
                        <td>
                            <div class="table-item">
                                <input id="height" name="height" type="text" class="form-control" placeholder="Height (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Width</span></td>
                        <td>
                            <div class="table-item">
                                <input id="width" name="width" type="text" class="form-control" placeholder="Width (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Length</span></td>
                        <td>
                            <div class="table-item">
                                <input id="length" name="length" type="text" class="form-control" placeholder="Length (Number)">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Country</span></td>
                        <td>
                            <div class="table-item">
                                <select id="country_id" name="country_id" class="select-style" required>
                                    <option value="">Select</option>
                                    <option value="1">Austria</option>
                                    <option value="2">Belgium</option>
                                    <option value="3">Bulgaria</option>
                                    <option value="4">Croatia</option>
                                    <option value="5">Cyprus</option>
                                    <option value="6">Czech Republic</option>
                                    <option value="7">Denmark</option>
                                    <option value="8">Estonia</option>
                                    <option value="9">Finland</option>
                                    <option value="10">France</option>
                                    <option value="11">Germany</option>
                                    <option value="12">Greece</option>
                                    <option value="13">Hungary</option>
                                    <option value="14">Ireland</option>
                                    <option value="15">Italy</option>
                                    <option value="16">Latvia</option>
                                    <option value="17">Lithuania</option>
                                    <option value="18">Luxembourg</option>
                                    <option value="19">Malta</option>
                                    <option value="20">Netherlands</option>
                                    <option value="21">Poland</option>
                                    <option value="22">Portugal</option>
                                    <option value="23">Romania</option>
                                    <option value="24">Slovakia</option>
                                    <option value="25">Slovenia</option>
                                    <option value="26">Spain</option>
                                    <option value="27">Sweden</option>
                                    <option value="28">UK</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        Company
                        <td>
                            <div class="table-item">
                                <select id="company_id" name="company_id" class="select-style" required>
                                    <option value="">Select</option>
                                    <?php 
                                    $getCompanies = $pdo->prepare("SELECT * FROM `company_id`");
                                    $getCompanies->execute();

                                    if ( $getCompanies->rowCount() > 0 ) {
                                        foreach ( $getCompanies as $company ) {
                                            echo '<option value="'. $company['id'] .'" >'. $company['company_name'] .'</option>';
                                        }
                                    } else {
                                        echo '<option value="0">N/A</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Internal ID</span></td>
                        <td>
                            <div class="table-item">
                                <input id="internal_id" name="internal_id" type="text" class="form-control" placeholder="Internal ID (Mixed Characters)" required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Ring Size <i class="fa fa-info-circle" data-toggle="tooltip" title="Only Applies to Rings"></i></span></td>
                        <td>
                            <div class="table-item">
                                <input id="ring_size" name="ring_size" type="text" class="form-control" placeholder="Ring Size, Numbers separator (,) 50,51,52, / Range, separator (-) 55-60" >
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td> <span class="table-item-label">Lab Grown Diamond</span> </td>
                        <td>
                            <div class="table-item">
                                <input type="radio" name="lab_grown" required  id="lab_grown" value="1">Yes<br>
                                <input type="radio" name="lab_grown" required  id="lab_grown" value="0">No
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-item-label">Images</span></td>
                        <td>
                            <div class="table-item">
                                <input type="file" class="" id="usr" name="itemImage[]" multiple required>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="table-item-label">Description</span>
                        </td>
                        <td>
                            <div class="table-item">
                                <textarea id="description" name="description" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="table-item-label">Description (French)</span>
                        </td>
                        <td>
                            <div class="table-item">
                                <textarea id="description_french" name="description_french" class="form-control" style="width:100%" placeholder="Description Goes Here (250 Characters)"  maxlength="250"></textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </div>  
        </div>
      </div>
      <div class="modal-footer">
        <input id="unique_key" name="unique_key" hidden/>
        <button type="submit" class="btn btn-custom" name="addItem" id="addItem" >Submit</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Item Modal END -->

<!-- Modal -->
<div id="promptManageImages" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Manage Images</h4>
      </div>
      <div class="modal-body">
        <div id="manageImageDiv" class="container">
            
        </div>
        <!--<div class="container">
            <fieldset>
                <legend>Add New Images</legend>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="addImageTo">
                    <input type="text" class="form-control" name="addURLTo" style="margin:5px;" placeholder="Place image URL here (Seperate with comma (,) )">
                    <button class="btn btn-custom" style="float:right;" id="addNewImagesID" name="addNewImages" >Add Image</button>
                </form>
            </fieldset>
        </div>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="promptDeleteImage" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Caution</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
      <input id="deleteImagekey" name="unique_key" hidden>
      <div class="modal-body">
        <div class="container" style="text-align:center;">
            <img id="imageToDelete" src="" style="max-height:35vh;" />
            <h4>You are about to permanently delete this image
            <br>Are you sure you want to perform this action?</h4>
            <br>
            <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
        </div>
      </div>
      <div class="modal-footer">
        <button id="imageToDeleteID" type="submit" class="btn btn-custom" name="deleteImage" value="">Delete</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="promptRemoveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Caution</h4>
      </div>
      <form method="post" enctype="multipart/form-data">
      <input id="remove_category" name="category" hidden>
      <div class="modal-body">
        <div class="container">
            <h4>You are about to permanently delete <strong id="itemToRemove">This</strong>
            <br>Are you sure you want to perform this action?</h4>
            <br>
            <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5>
        </div>
      </div>
      <div class="modal-footer">
        <button id="removeModalActionButton" type="submit" class="btn btn-custom" name="removeItem" value="">Remove</button>
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div id="promptBulkRemoveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to permanently delete <strong id="itemsToRemove">This</strong>
            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
            <br>
            <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input id="removeModalActionButton" type="submit" class="btn btn-custom" name="bulkManage" value="delete" form="bulkManage" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="promptRemoveAll" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to permanently delete <strong id="categoryToRemove" style="text-transform:capitalize;">This</strong>
            <br>Are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
            <br>
            <h5><div class="alert alert-error">Warning: This action can not be undone.</div></h5> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <form method="post">
      <div class="modal-footer">
        <input id="removeAll" name="removeAll" value="" hidden="" />
        <input type="submit" class="btn btn-custom"  />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div id="promptSiteManagement" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Manage Access</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4 style="border-bottom: solid thin #ddd; padding-bottom: 10px; margin: 10px 5%;"><span id="manageAccessItem"></span> </h4>
            <form id="manageAccessForm" action="post.php" method="post">
                <input name="unique_key" value="" hidden />
                <table class="table table-condensed table-custom">
                    <thead>
                        <th>Domain Name</th>
                        <th>Access</th>
                    </thead>
                    <tbody>
                        <?php 
                        $getSites = $pdo->prepare("SELECT * FROM tb_websites");
                        $getSites->execute();

                        if ( $getSites->rowCount() > 0 ) {
                            foreach ( $getSites->fetchAll() as $website ) {
                                echo '<tr><td>'. $website['label'] .'</td><td><input id="'. $website['token'] .'" name="'. $website['token'] .'" type="checkbox" /></td></tr>';
                            } 
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input type="submit" class="btn btn-custom" name="manageSiteAccess" form="manageAccessForm" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="promptBulkDisable" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to disable <strong id="itemsToDisable">This</strong>
            <br>Note: Disabled items do not appear in the front-end of <strong>any</strong> site, are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input type="submit" class="btn btn-custom" name="bulkManage" value="disable" form="bulkManage" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="promptBulkEnable" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Caution</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4>You are about to disable <strong id="itemsToEnable">This</strong>
            <br>Note: Enabled items would appear in the front-end of <strong>any</strong> site they are allowed in, are you sure you want to perform this action?</h4> <!-- Bulk Delete Modal -->
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input type="submit" class="btn btn-custom" name="bulkManage" value="enable" form="bulkManage" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="promptBulkAccessManagement" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content"> <!-- Bulk Delete Modal -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button> <!-- Bulk Delete Modal -->
        <h4 class="modal-title">Note: This changes access for every items selected</h4> <!-- Bulk Delete Modal -->
      </div>
      <input id="remove_category" name="category" hidden>
      <div class="modal-body"> <!-- Bulk Delete Modal -->
        <div class="container">
            <h4 style="border-bottom: solid thin #ddd; padding-bottom: 10px; margin: 10px 5%;"><span id="bulkManageAccessItem"></span> </h4>
            <table class="table table-condensed table-custom">
                <thead>
                    <th>Domain Name</th>
                    <th>Access</th>
                </thead>
                <tbody>
                    <?php 
                    $getSites = $pdo->prepare("SELECT * FROM tb_websites");
                    $getSites->execute();

                    if ( $getSites->rowCount() > 0 ) {
                        foreach ( $getSites->fetchAll() as $website ) {
                            echo '<tr><td>'. $website['label'] .'</td><td><input form="bulkManage" id="'. $website['token'] .'" name="site['. $website['token'] .']" type="checkbox" /></td></tr>';
                        } 
                    }
                    ?>
                </tbody>
            </table>
        </div>
      </div> <!-- Bulk Delete Modal -->
      <div class="modal-footer">
        <input type="submit" class="btn btn-custom" name="bulkManage" value="access" form="bulkManage" />
        <button type="button" class="btn btn-custom" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>