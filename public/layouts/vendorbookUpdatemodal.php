<?php

   if(request_post()){
   	if($_POST['customersubmit']){
   	   $update = [];
   	   $update['Id'] = $_POST['vendorId'];
   	   $update['Payment_done'] = $_POST['Payment_done'];
   	   $update['Purchase_amount'] = $_POST['Purchase_amount'];
   	   $result = update_data('vendorbook', $update);
   }
   }
 
?>
<div class="modal" id="vendorbook<?php echo $vendor['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update vendor</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>
   
   	<input type="hidden" name="vendorId" class="text-box" id="updateId" value="<?php echo $vendor['Id'] ?>">
       <div class="form-outline mb-2">
    <label>Update Vendor Name</label>
		<input type="text" name="Purchase_amount" class="form-control" id="updatename" value="<?php echo $vendor['Purchase_amount'] ?>">
     </div>
        <div class="form-outline mb-2">
    <label>Update Vendor Name</label>
		<input type="text" name="Payment_done" class="form-control" id="updatecontact" value="<?php echo $vendor['Payment_done'] ?>">
       </div>
       <input type="submit" name="customersubmit" class="btn btn-sm btn-primary">

       </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
