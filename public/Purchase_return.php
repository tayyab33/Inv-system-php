<?php 
$title = "Purchase_return"; include_once('layouts/header.php'); 
session_start();

include_once('../private/file_roots.php');

 if(request_post()){
   $result = "";
   // session for form submission check

   if(isset($_POST['product']) != ""){
   $productcheck =  $_POST['product'];
  // check result if exist

  if(check_product_exist_to_update($productcheck)){
  	// echo "hello";
	$updateproduct  = [];
	$updateproduct['product'] = $_POST['product'];
	$updateproduct['Purchasereturn'] = $_POST['Purchasereturn'];
	$re = updata_data_purchase_stock('product', $updateproduct); 
   if($re == true){
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
<nav class="navbar nav bg-dark">
    <h3 class="m-auto m-2 text-danger"> Purchase Return Page </h3>
</nav>

<form method="POST" action="" onload="off">
  
    
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Sales Return Successfull
   </h1>
   <div class="card col-md-4 m-auto mt-3 p-4 bg-danger">

  <div class="form-outline mb-2">
	      <label class="form-label" for="product" style="font-weight: bold; color: dark;">Select Product product</label>
	      <select name="product" id="product" class="form-control">
			     <?php $result = select_data('product'); while ($data = mysqli_fetch_assoc($result)) {?>
				 <option name="product" selected="seleted" id="product"><?php echo $data['Product_Name'] ?></option>
				<?php } ?>
		  </select>
	</div>

 <div class="form-outline mb-4">
     <label class="form-label" for="Purchasereturn" style="font-weight: bold; color: dark;">Return Stock</label>
	<input type="text" name="Purchasereturn" id="Purchasereturn" class="form-control" autocomplete="off">
  </div>

    <input type="submit" name="submit" class="btn btn-sm btn-primary" autocomplete="off">
  </div>

</form>



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