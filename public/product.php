<?php 
$title = "product"; include_once('layouts/header.php'); 
session_start();
include_once('../private/file_roots.php');

 if(request_post()){
   $result = "";
   // session for form submission check
   if(isset($_POST['Product_Name']) != ""){
   $namecheck =  $_POST['Product_Name'];
  // check result if exist

  if(check_product_exist($namecheck)){
    $namecheck =  $_POST['Product_Name'];
  if(!is_numeric($namecheck) && is_numeric($_POST['Product_Price']) && is_numeric($_POST['Product_Sales_Price']) && is_numeric($_POST['category']) ){
	$product  = [];
	$product['Product_Name'] = strip_tags($_POST['Product_Name']);
	$product['Product_Price'] = strip_tags($_POST['Product_Price']);
  $product['Product_Sales_Price'] = strip_tags($_POST['Product_Sales_Price']);
  $product['category'] = strip_tags($_POST['category']);
	$re = insertdata('product',$product);

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
    <h3 class="m-auto m-2 text-danger"> Product Page </h3>
</nav>
<form method="POST" action="">
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Vendor Record Saved!
   </h1>
   <div class="card col-md-4 m-auto mt-3 p-4 bg-danger">
  <div class="form-outline mb-2">
    <label class="form-label" for="name">Product Name</label>
    <input type="text" name="Product_Name" id="Product_Name" class="form-control" autocomplete="off">
  </div>
   <div class="form-outline mb-2">
    <label>Purchase Price</label>
	  <input type="text" name="Product_Price" class="form-control">
  </div>
  <div class="form-outline mb-2">
    <label>Sales Price</label>
    <input type="text" name="Product_Sales_Price" class="form-control">
  </div>
  <div class="form-outline mb-2">
     <label>Select Category</label>
    <select name="category" class="form-control">
      <?php $result = select_data('category'); 
      while ($data = mysqli_fetch_assoc($result)) {
        ?>
       <option name="category"><?php echo $data['Name']; ?></option>
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
      <td>Id</td>
      <td>Product Name</td>
      <td>Product Price</td>
      <td>Product Sales Price</td>
      <td>Stock</td>
      <td>Category</td>
      <td>Action</td>
    </tr>
    </thead>
    <tbody>
      <?php $data = select_data('product'); while($product = mysqli_fetch_assoc($data)){ ?>
    <tr>
       <td><?php echo $product['Id'] ?></td>
       <td><?php echo $product['Product_Name'] ?></td>
       <td><?php echo $product['Product_Price'] ?></td>
       <td><?php echo $product['Product_Sales_Price'] ?></td>
       <td><?php echo $product['Prodcut_Stock'] ?></td>
       <td><?php echo $product['category'] ?></td>
      <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $product['Id'] ?>&tb=product"> Delete </a></button>
 <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#product<?php echo $product['Id'] ?>">
                update
        </button>
      </td>
    </tr>
       <?php include ('layouts/productmodal.php'); ?> 
  <?php } ?>
    </tbody>
</table>

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