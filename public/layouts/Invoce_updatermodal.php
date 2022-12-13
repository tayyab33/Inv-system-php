<?php

   if(request_post()){
   	if(isset($_POST['Date'])){
   	   $invoice_List_Updater = [];
   	   $invoice_List_Updater['Id'] = $_POST['Id'];
   	   $invoice_List_Updater['Invoice_NO'] = $_POST['Invoice_NO'];
       $invoice_List_Updater['Customer_Name'] = $_POST['Customer_Name'];
       $invoice_List_Updater['Date'] = $_POST['Date'];
       $result = updata_data_invoices('invoice_lists', $invoice_List_Updater);
   }
   }
 
?>
<div class="modal" id="Invoce_Updater<?php echo $data['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Invoice</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>
   	<input type="hidden" name="Id" class="text-box" id="Id" value="<?php echo $data['Id'] ?>">
    <div class="form-outline mb-2">
        <label>Invoice No</label>
		<input type="text" name="Invoice_NO" class="form-control" id="Invoice_NO" value="<?php echo $data['Invoice_NO'] ?>">
  </div>
  <div class="form-outline mb-2">
       <label class="form-label" for="name">Select Customer Name</label>
  <select name="Customer_Name" id="Customer_Name" class="form-control">
     <?php $resultcustomer = select_data('customer'); while ($dataresult = mysqli_fetch_assoc($resultcustomer)) {?>
      <option >walking customer</option>
   <option name="Customer_Name" selected="seleted" id="Customer_Name"><?php echo $dataresult['Name'] ?></option>
  <?php } ?>
  </select>
     </div>
      <div class="form-outline mb-2">
        <label>Date</label>
    <input type="Date" name="Date" class="form-control" id="Date" value="<?php echo $data['Date'] ?>">
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
