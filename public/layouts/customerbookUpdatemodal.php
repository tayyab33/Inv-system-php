<?php

   if(request_post()){
   	if($_POST['customersubmit']){
   	   $update = [];
   	   $update['Id'] = $_POST['customerId'];
   	   $update['Customer_Paid'] = $_POST['Customer_Paid'];
   	   $update['Purchase_amount'] = $_POST['Purchase_amount'];
   	   $result = update_data('customerbook', $update);
   }
   }
 
?>
<div class="modal" id="customerbook<?php echo $customer['Id'] ?>" aria-hidden="true">
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
   	<input type="hidden" name="customerId" class="text-box" id="updateId" value="<?php echo $customer['Id'] ?>">
		<input type="text" name="Purchase_amount" class="text-box" id="updatename" value="<?php echo $customer['Purchase_amount'] ?>">
		<input type="text" name="Customer_Paid" class="text-box" id="updatecontact" value="<?php echo $customer['Customer_Paid'] ?>">
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
