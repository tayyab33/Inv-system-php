<?php

   if(request_post()){
   	if($_POST['customersubmit']){
   	   $invoice_List_Updater = [];
   	   $invoice_List_Updater['Id'] = $_POST['Id'];
       $invoice_List_Updater['Sales_Stock'] = $_POST['Sales_Stock'];
       $invoice_List_Updater['Product_Name'] = $_POST['Product_Name'];
      $result = updata_data_stock_invoice('invoice_lists', $invoice_List_Updater);

   }
   }
 
?>
<div class="modal" id="Invoiceupdate<?php echo $data['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Invoice Date</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>
   <h1>Only Stock Update</h1>
   	<input type="hidden" name="Id" class="text-box" id="Id" value="<?php echo $data['Id'] ?>">
       <div class="form-outline mb-2">
    <label>Updata Stock</label>
  <input type="text" name="Sales_Stock" class="form-control m-2" id="Sales_Stock" value="<?php echo $data['Sales_Stock'] ?>">
    </div>
   <input type="hidden" name="Product_Name" class="text-box" id="Product_Name" value="<?php echo $data['Product_Name'] ?>" readonly>

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
