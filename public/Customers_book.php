<?php 
$title = "customerbook"; include_once('layouts/header.php'); 
include_once('../private/file_roots.php');

 if(request_post()){
   $result = "";
   // session for form submission check

   if($_POST['customer'] != "" && (int)$_POST["Purchase_amount"] && (int)$_POST['Paid_Amount']){
   $namecheck =  $_POST['customer'];
  // check result if exist
  if(check_customer_exist_for_sales($namecheck)){
	$customer  = [];
	$customer['Name'] = $_POST['customer'];
	$customer['Purchase_amount'] = $_POST['Purchase_amount'];
	$customer['Paid_Amount'] = $_POST['Paid_Amount'];
	$customer['Date'] = $_POST['Date'];
	$re = insertdata('customerbook', $customer);

      echo "<div>" ?> 
      <script type="text/javascript">
      	function message(){
      		document.getElementById('message').style.display ="block";
      	}
      	setTimeout("message()", 500);
      	function hidemessage(){
      		document.getElementById('message').style.display = "none";
      	}
      	setTimeout("hidemessage()", 2000);
      </script>
<?php 
echo "</div>"; 
      }
  }
}

?>
<nav class="navbar nav bg-dark mb-3">
    <h3 class="m-auto m-2 text-danger"> Customer Book </h3>
</nav>
<form method="POST" action="">
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Vendor Record Saved!
   </h1>
   <div class="card col-md-5 m-auto mt-3 p-4 bg-danger">
    <div class="form-outline mb-2">
	<label>chose vendor</label>
     <select name="customer" class="form-control">
    <?php $result = select_data('customer'); 
      while ($data = mysqli_fetch_assoc($result)) {
        ?>
       <option name="customer"><?php echo $data['Name']; ?></option>
     <?php } ?>
       </select>
       </div>
         <div class="form-outline mb-2">
         	<label>Purchase Amount</label>
	<input type="text" name="Purchase_amount" class="form-control" required>
	     </div>
	      <div class="form-outline mb-2">
	      	<label>Paid_Amount</label>
	<input type="text" name="Paid_Amount" class="form-control" required>
	     </div>
	      <div class="form-outline mb-2">
	      	<label>Date</label>
	<input type="Date" name="Date" class="form-control" required>
	      </div>
    <input type="submit" name="customersubmit" class="btn btn-sm btn-primary">

</div>
</form>

  <nav class="nav navbar bg-success mt-4">
  <div class="text-right">
   <label class="text-right m-3 text-white">Search</label>
   <input id="search" type="search" name="search" class=" m-3" /> 
   </div>
  </nav>
<table class="table" id="table">
	<thead>
	 <tr>
	 	<td>S.No</td>
	 	<td>Customer_Name</td>
	 	<td>Action</td>
	 </tr>
	</thead>
	<tbody id="table" >
		<?php 
		$resultt = select_data('customer'); 
		while($customer = mysqli_fetch_assoc($resultt)){ ?>
		<tr>
			
			<td><?php echo $customer['Id'] ?></td>
			<td><?php echo $customer['Name'] ?></td>
			    <td><button class="btn btn-primary"><a class="change-st" href="customerbook.php?Inv=<?php echo $customer['Name'] ?>">View</a></button>
		   <button class="btn btn-danger"><a class="change-st" href="../private/delete.php?id=<?php echo $customer['Name']; ?>&table=invoice_lists">Delete</a></button> &nbsp;
      </td>
    </tr>
  <?php } ?>
    </tbody>
	</tbody>
</table>
<div class="card">
	<h3>This Record is Not added Please Add</h3>
	  <table class="table">
	  	<thead>
	  	 <tr>
	  	 	<td>S.No</td>
	  	 	<td>Invoice NO</td>
	  	 	<td>Action</td>
	  	 </tr>
	  	</thead>
	  	 <tbody>
	  	 	
	  	 	<?php
	  	 	$arrayrecord  = [];
	  	 	$i = 0;
	  	 	 $checkinv = select_data('invoice_lists'); 
	  	 	while($invcheck = mysqli_fetch_assoc($checkinv) ){ 

	  	 		?> 
	  	 		<?php $checkinv0 = select_data('customerbook'); 
	  	 	while($invcheck1 = mysqli_fetch_assoc($checkinv0) ){ ?> 
	  	 		<?php if($invcheck['Invoice_NO'] != $invcheck1['Invoice_No'] ) { ?>
                         <?php  
                           $i++;
                           $arrayrecord[$i] = $invcheck['Invoice_NO'];
                           $i++;
                           $arrayrecord[$i] = $invcheck1['Invoice_No'];
                          ?>
	  	 			  <?php	} } } ?>
	  	 	
	  	 		<?php if($arrayrecord != ""){
                     $listofdata = array_unique($arrayrecord);
                     foreach ($listofdata as $key => $value) {
                     	$checkinv = check_Customer_Inv_exit($value);
                     	if($checkinv){
                     		
                     	?>

                     <tr>
                     	<td><?php echo $value ?></td>
                     	<td><?php echo $value ?></td>
                     	<td>
                     		<button class="btn btn-sm btn-danger text-w"><a class="change-st" href="Invoice_Record_by_Id.php?Inv=<?php echo $value ?>" > View </a>
                     		</button>
                     	</td>
                     </tr>
                     	<?php
                     }
                     }
	  	 		} 

	  	 		?>


	  	 
	  	
	  	 
	
	  	 </tbody>
	  </table>
</div>
<?php include_once('layouts/footer.php'); ?>
<script type="text/javascript">
    var addSerialNumber = function () {
    var i = 0
    $('tbody tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index-i+1);
    });
};
addSerialNumber();
  </script>
  <script type="text/javascript">
    var $rows = $('#table tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

</script>