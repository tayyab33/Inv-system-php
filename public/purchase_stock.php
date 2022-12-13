<?php 
$title = "purchase"; include_once('layouts/header.php'); 
session_start();
include_once('../private/file_roots.php');
include 'layouts/invoice_sripts_links.php';

 if(request_post()){
   $result = "";
   // session for form submission check
   if($_POST['Product_Name'] != ""){
   $namecheck =  $_POST['Product_Name'];
  // check result if exist

  if(check_product_exist_to_update($namecheck)){
  if((int) $_POST['Purchase_Stock']){
  	
	$purchase  = [];
	$purchase['Product_Name'] = $_POST['Product_Name'];
  $purchase['Invoice_NO'] = $_POST['Invoice_NO'];
	$purchase['Purchase_Price'] = $_POST['Purchase_Price'];
  $purchase['Purchase_Stock'] = $_POST['Purchase_Stock'];
  $purchase['vendor'] = $_POST['vendor'];
	$re = insertdata('purchase_products',$purchase);

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
}

?>
<nav class="navbar nav bg-dark mb-2">
    <h3 class="m-auto m-2 text-danger"> Purchase Page </h3>
</nav>
<form method="POST" action="">
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Vendor Record Saved!
   </h1>
    <div class="card col-md-4 m-auto mt-3 p-4 bg-danger">
      <div class="form-outline mb-2">
 <label class="form-label" for="name">Invoice NO</label>
    <input id="InvNO" type="text" name="Invoice_NO" class="form-control" >
     </div>
      <div class="form-outline mb-2">
       <label class="form-label" for="name">Select Product</label>
     <select id="Product_Name" name="Product_Name" class="form-control">
      <?php $result = select_data('product'); 
          while ($data = mysqli_fetch_assoc($result)) {
        ?>
       <option id="Product_Name" name="Product_Name"><?php echo $data['Product_Name']; ?></option>
     <?php } ?>
    </select>
     </div>
   <div class="form-outline mb-2">
      <label class="form-label" for="name">Purchase Price</label>
	    <input id="Purchase_price" type="text" name="Purchase_Price" class="form-control" readonly>
  </div>
  <div class="form-outline mb-2">
    <label>Add Stock</label>
    <input type="text" name="Purchase_Stock" class="form-control">
  </div>
  <div class="form-outline mb-3">
    <label>chose vendor</label>
     <select name="vendor" class="form-control">
    <?php $result = select_data('vendor'); 
      while ($data = mysqli_fetch_assoc($result)) {
        ?>
       <option name="vendor"><?php echo $data['Name']; ?></option>
     <?php } ?>
       </select>
    </div>

    <input type="submit" name="submit" class="btn btn-sm btn-primary">
</div>

</form>
 <nav class="nav navbar bg-success mt-3">
  <div class="text-right">
   <label class="text-right m-3 text-white">Search</label>
   <input id="search" type="search" name="search" class=" m-3" /> 
   </div>
  </nav>

<table class="table" id="table">
  <thead>
    <tr>
      <td>S.NO</td>
      <td>Product Name</td>
      <td>Product Price</td>
      <td>Product Sales Price</td>
      <td>Stock</td>
      <td>Category</td>
      <td>Action</td>
    </tr>
    </thead>
    <tbody>
      <?php $data = select_data('purchase_products'); while($purchase = mysqli_fetch_assoc($data)){ ?>
    <tr>
       <td><?php echo $purchase['Id'] ?></td>
       <td><?php echo $purchase['Product_Name'] ?></td>
       <td><?php echo $purchase['Purchase_Price'] ?></td>
       <td><?php echo $purchase['Purchase_Stock'] ?></td>
       <td><?php echo $purchase['vendor'] ?></td>
       <td><?php echo $purchase['Date'] ?></td>
      <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $purchase['Id'] ?>&tb="> Delete </a></button></td>
    </tr>
  <?php } ?>
    </tbody>
</table>
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
  $(document).ready(function(){
    $('#Product_Name').change(function(){
      var pname = $('#Product_Name').val();
      var datastring = 'empid=' + pname;
      $.ajax({
        url: '../private/ajax_product_search.php',
        dataType: "json",
        data: datastring,
        cache: false,
        success: function(empdata){
          if(empdata){
          $("#Purchase_price").val(empdata.Product_Price); 
        }else{
          $("#recordListing").addClass('hidden');
          $("#errorMassage").removeClass('hidden').text('no record found');
        }
        }
      })
    })
  })
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