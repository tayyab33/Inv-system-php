<?php 
$title = "vendorbook"; include_once('layouts/header.php'); 
include_once('../private/file_roots.php');

 if(request_post()){
   $result = "";
   // session for form submission check

   if($_POST['vendor'] != "" && (int)$_POST["Purchase_amount"] && (int)$_POST['Payment_done']){
   $namecheck =  $_POST['vendor'];

  // check result if exist
  if(check_vendor_exist_for_purchase($namecheck)){
  	echo "nice to meet you";
  	echo "hello";
	$vendor  = [];
	$vendor['vendor'] = $_POST['vendor'];
	$vendor['Purchase_amount'] = $_POST['Purchase_amount'];
	$vendor['Payment_done'] = $_POST['Payment_done'];
	$vendor['Date'] = $_POST['Date'];
	$re = insertdata('vendorbook', $vendor);

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
<nav class="navbar nav bg-dark mb-2">
    <h3 class="m-auto m-2 text-danger"> Vendor_book Page </h3>
</nav>
<form method="POST" action="">
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Vendor Record Saved!
   </h1>
   <div class="card col-md-5 m-auto mt-3 p-4 bg-danger">
    <div class="form-outline mb-2">
	<label>chose vendor</label>
     <select name="vendor" class="form-control">
    <?php $result = select_data('vendor'); 
      while ($data = mysqli_fetch_assoc($result)) {
        ?>
       <option name="vendor"><?php echo $data['Name']; ?></option>
     <?php } ?>
       </select>
    </div>
    <div class="form-outline mb-2">
    	<label>Purchase Amount</label>
	     <input type="text" name="Purchase_amount" class="form-control" required>
	  </div>
	  <div class="form-outline mb-2">
	  	<label>Payment Done</label>
	<input type="text" name="Payment_done" class="form-control" required>
	  </div>
	  <div class="form-outline mb-2">
	  	<label>Date</label>
	<input type="Date" name="Date" class="form-control" required>
	 </div>

 <input type="submit" name="vendorsubmit" class="btn btn-sm btn-primary mt-2">
</div>
</form>
 <nav class="nav navbar bg-success mt-4">
  <div class="text-right">
   <label class="text-right m-3 text-white">Search</label>
   <input id="search" type="search" name="search" class=" m-3" /> 
   </div>
  </nav>
<table class="table">
	<thead>
	 <tr>
	 	<td>S.No</td>
	 	<td>Vendor_Name</td>
	 	<td>Action</td>
	 </tr>
	</thead>
	<tbody id="table" >
		<?php 
		$resultt = select_data('vendor'); 
		while($vendor = mysqli_fetch_assoc($resultt)){ ?>
		<tr>
			
			<td><?php echo $vendor['Id'] ?></td>
			<td><?php echo $vendor['Name'] ?></td>
			    <td><button class="btn btn-primary"><a class="change-st" href="vendorbook.php?Inv=<?php echo $vendor['Name'] ?>">View</a></button></td>
		    <td><button class="btn btn-danger"><a class="change-st" href="../private/delete.php?id=<?php echo $vendor['Name']; ?>&tablei=purchase_products">Delete</a></button> &nbsp;
      </td>
    </tr>
  <?php } ?>
    </tbody>
	</tbody>
</table>
<div class="card bg-danger p-3">
	<h3 class="text-white m-auto p-2">This Record is Not added Please Add</h3>
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
	  	 	 $checkinv = select_data('purchase_products'); 
	  	 	while($invcheck = mysqli_fetch_assoc($checkinv) ){ 

	  	 		?> 
	  	 		<?php $checkinv0 = select_data('vendorbook'); 
	  	 	while($invcheck1 = mysqli_fetch_assoc($checkinv0) ){ ?> 
	  	 		<?php if($invcheck['Invoice_NO'] != $invcheck1['Invoice_NO'] ) { ?>
                         <?php  
                           $i++;
                           $arrayrecord[$i] = $invcheck['Invoice_NO'];
                           $i++;
                           $arrayrecord[$i] = $invcheck1['Invoice_NO'];
                          ?>
	  	 			  <?php	} } } ?>
	  	 	
	  	 		<?php if($arrayrecord != ""){
                     $listofdata = array_unique($arrayrecord);
                     foreach ($listofdata as $key => $value) {
                     	$checkinv = check_vendor_Inv_exit($value);
                     	if($checkinv){
                     		
                     	?>

                     <tr>
                     	<td><?php echo $value ?></td>
                     	<td><?php echo $value ?></td>
                     	<td>
                     		<button class="btn btn-sm btn-success text-w"><a class="change-st" href="add_vendor_to_book.php?Inv=<?php echo $value ?>" > View </a>
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