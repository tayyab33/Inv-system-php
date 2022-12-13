<?php

   if(request_post()){
  
   	   $update = [];
   	   $update['Id'] = $_POST['customerId'];
   	   $update['Name'] = $_POST['updatename'];
   	   $update['contact'] = $_POST['updatecontact'];
   	   $result = update_data('customer', $update);
   }

 
?>
<div class="modal" id="customer<?php echo $customer['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update customer</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>

   	<input type="hidden" name="customerId" class="form-control" id="updateId" value="<?php echo $customer['Id'] ?>">
   <div class="form-outline mb-2">
    <label>Update Name</label>
		<input type="text" name="updatename" class="form-control" id="updatename" value="<?php echo $customer['Name'] ?>">
  </div>
  <div class="form-outline mb-2">
    <label>Update Contact</label>
		<input type="text" name="updatecontact" class="form-control" id="updatecontact" value="<?php echo $customer['contact'] ?>">
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
