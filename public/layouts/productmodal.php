<?php

   if(request_post()){
   	if(isset($_POST['productsubmit'])){
   	   $update = [];
   	   $update['Id'] = $_POST['productId'];
   	   $update['Name'] = $_POST['updatename'];
   	   $update['updatePrice'] = $_POST['updatePrice'];
       $update['updatesales'] = $_POST['updatesales'];
       $update['category'] = $_POST['category'];
   	   $result = update_data('product', $update);
   }
   }
 
?>
<div class="modal" id="product<?php echo $product['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>
    
   	<input type="hidden" name="productId" class="form-control" id="updateId" value="<?php echo $product['Id'] ?>">
     <div class="form-outline mb-2">
    <label>Update Name</label>
		<input type="text" name="updatename" class="form-control" id="updatename" value="<?php echo $product['Product_Name'] ?>">
     </div>
       <div class="form-outline mb-2">
    <label>Update Purchase Price</label>
		<input type="text" name="updatePrice" class="form-control"  id="updatecontact" value="<?php echo $product['Product_Price'] ?>">
  </div>
    <div class="form-outline mb-2">
    <label>Update Sales Price</label>
			<input type="text" name="updatesales" class="form-control" id="updatecontact" value="<?php echo $product['Product_Sales_Price'] ?>">
			</div>
       <div class="form-outline mb-2">
    <label>Update Category</label>
			<select name="category" class="form-control">
      <?php $resul = select_data('category'); 
      while ($dat = mysqli_fetch_assoc($resul)) {
        ?>
       <option name="category"><?php echo $dat['Name']; ?> </option>
     <?php } ?>
    </select>
     </div>
       <input type="submit" name="productsubmit" class="btn btn-sm btn-primary">

       </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
