<?php 
session_start();
$title = "Invoice"; include_once('layouts/header.php'); include_once('../private/file_roots.php'); include 'layouts/invoice_sripts_links.php';?>

<style type="text/css">
	.hidden{
		display: hidden;
	}
</style>
<?php 
    if(request_post()){
    	$namecheck  = $_POST['Product_Name'];
    	$result = check_product_exist_to_update($namecheck);
    	if($result){
    		$fetch = mysqli_fetch_assoc($result);
    		if($fetch['Product_Stock'] <=0 ){

    		}else{
           $sales = [];
           $sales['Invoice_NO'] = $_POST['Invoice_No'];
           $sales['category'] = $_POST['category'];
           $sales['Product_Name'] = $_POST['Product_Name'];
           $sales['Product_Stock'] = $_POST['Product_Stock'];
           $sales['Sales_Stock'] = $_POST['Sales_Stock'];
           $sales['Product_Sales_Price'] = $_POST['Product_Sales_Price'];
           }
    	}
    }
?>
<nav class="navbar nav bg-dark mb-2">
    <h3 class="m-auto m-2 text-danger"> Invoice Page </h3>
</nav>
   <div class="card col-md-5 m-auto mt-3 p-4 bg-danger">

     <div class="form-outline mb-2">
   <label class="form-label" for="name" style="font-weight: bold; color: white;">Select Product Name</label>
<select name="product" id="product" class="form-control">
     <?php $result = select_data('product'); while ($data = mysqli_fetch_assoc($result)) {?>
	 <option name="product" selected="seleted" id="product"><?php echo $data['Product_Name'] ?></option>
	<?php } ?>
	</select>
	</div>
	<div class="form-outline mb-2">
		   <label class="form-label" for="name" style="font-weight: bold; color: white;">Select Customer Name</label>
	<select name="Customer_Name" id="Customer_Name" class="form-control">
     <?php $resultcustomer = select_data('customer'); while ($dataresult = mysqli_fetch_assoc($resultcustomer)) {?>
     	<option >walking customer</option>
	 <option name="Customer_Name" selected="seleted" id="Customer_Name"><?php echo $dataresult['Name'] ?></option>
	<?php } ?>
	</select>
  </div>
  <div class="form-outline mb-2">
  	   <label class="form-label" style="font-weight: bold; color: white;">Invoice NO</label>
     <input type="text" name="Invoice_NO" id="Invoice_NO" class="form-control" required>
  </div>
  <div class="form-outline mb-2">
  	<label class="form-label" style="font-weight: bold; color: white;">Price</label>
<input type="text" name="Product_Sales_Price" id="Product_Sales_Price" class="form-control" readonly>
</div>
  <div class="form-outline mb-2">
  		<label class="form-label" style="font-weight: bold; color: white;">Category</label>
<input type="text" name="category" id="category" class="form-control" readonly>
</div>
  <div class="form-outline mb-2">
  		<label class="form-label" style="font-weight: bold; color: white;">Exist stock</label>
<input type="text" name="Product_Stock" id="Product_Stock" class="form-control" readonly>
</div>

  <div class="form-outline mb-2">
  	<label class="form-label" style="font-weight: bold; color: white;">Add Stock Sale</label>
<input type="text" name="Sales_Stock" id="Sales_Stock" class="form-control">
</div>

	

<button id="insert" class="btn btn-primary">Add</button>
</div>

<table class="table mt-3" id="recordListing">
	<thead>
	 <tr>
	 	<th>S.NO</th>
	 	<th>Item Name</th>
	 	<th>Price</th>
	 	<th>Stock</th>
	 	<th>Total</th>
	 </tr>
	 </thead>
	 <tbody>
	 	<tr>
	 		<td ></td>
	 		<td id="empId"></td>
	 		<td id="empName"></td>
	 		<td></td>
	 		<td></td>
	 	</tr>
	 </tbody>
</table>

<div id="errorMassage"></div>

<!-- // add data into invoices table  -->
<script type="text/javascript">
	// function save(){
	//    var invoce_no = $('#Invoice_NO').val()
	//    var Product_Sales_Price = $('#Product_Sales_Price').val()
	//    var category = $('#category').val() 
	//    var Product_Stock = $('#Product_Stock').val()
	//    var Sales_Stock = $('#Sales_Stock').val() 
	//    $.ajax({
	//    	url: '../private/ajax_product_search.php',
	//    	dataType: "POST"
	//    })
	//  }

$("#insert").click(function(e) {
  e.preventDefault();

       var Product_Name = $("#product").val()
       var invoce_no = $("#Invoice_NO").val()
	   var Product_Sales_Price = $("#Product_Sales_Price").val()
	   var category = $("#category").val() 
	   var Product_Stock = $("#Product_Stock").val()
	   var Sales_Stock = $("#Sales_Stock").val() 
	   if(Product_Name != "" && invoce_no != "" && Sales_Stock != "" && category != "" ){

	   // var dataString = 'Product_Name='+Product_Name+'&invoce_no='+invoce_no;
  var dataString = 'invoce_no='+invoce_no+'&Product_Sales_Price='+Product_Sales_Price+'&category='+category+'&Product_Stock='+Product_Stock+'&Sales_Stock='+Sales_Stock+'&Product_Name='+Product_Name;
	   }
  $.ajax({
    type:'POST',
    data:dataString,
    url: '../private/ajax_product_search.php',
    success:function(data) {
      alert(data);
    }
  });
});

</script>


<!-- // check data form the product table if exist -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#product').change(function(){
			var pname = $('#product').val();
			var datastring = 'empid=' + pname;
			$.ajax({
				url: '../private/ajax_product_search.php',
				dataType: "json",
				data: datastring,
				cache: false,
				success: function(empdata){
					if(empdata){
					$("#errorMassage").addClass('hidden').text("");
					$("#recordListing").removeClass('hidden');
					$("#Product_Stock").val(empdata.Prodcut_Stock); 
					$("#category").val(empdata.category);
					$("#Product_Sales_Price").val(empdata.Product_Sales_Price); 
				}else{
					$("#recordListing").addClass('hidden');
					$("#errorMassage").removeClass('hidden').text('no record found');
				}
				}
			})
		})
	})
</script>
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