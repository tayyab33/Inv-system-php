<?php 
$title = "Invoice"; include_once('layouts/header.php'); include_once('../private/file_roots.php'); include 'layouts/invoice_sripts_links.php';?>

<?php $checkinv = check_vendor_Inv_exit($_GET['Inv']); 
if($checkinv){ ?>
<button id="adder" type="button" class="btn-sm btn btn-success" > <a  href="Invoice_lists.php" style="text-decoration: none; color: white;"> Add in vendor book</a></button>
<?php } ?>
 <input type="hidden" id="Inv" value="<?php echo $_GET['Inv'] ?>" >

 <div class="container">
<table class="table table-bordered m-auto">
  <thead>
  	<tr class="head--row">
  		<th>S.NO</th>
	 	<th>Item Name</th>
	 	<th>Category</th>
	 	<th>Item Price</th>
	 	<th>Sales Stock</th>
	 	<th>Total</th>
  	</tr>
  </thead>
  	<tbody id="table" >

<!-- Id	
Product_Name	
Product_Sales_Price	
Category	
Product_Stock	
Sales_Stock	
Total	
Date	
Invoice_NO -->

  		<?php
         $total = 0;
         $stock = 0;
         $result = select_data('purchase_products'); while($data = mysqli_fetch_assoc($result)) {
  			if($data['Invoice_NO'] == $_GET['Inv']){ ?>
          <?php 
          $stock += $data['Purchase_Stock'];
          $total += $data['Purchase_Price'];
          ?>
  	<tr>
  		<td><?php echo $data['Id']; ?></td>
  		<td><?php echo $data['Product_Name']; ?></td>
  		<td><?php echo $data['Purchase_Price']; ?></td>
  		<td><?php echo $data['Purchase_Stock']; ?></td>
  		<td><?php echo $data['Date']; ?></td>
  		<td><?php echo $data['vendor']; ?><button id="buttons" type="button" class="btn btn-sm btn-success"> <a href="../private/delete.php?id=<?php echo $data['Id'] ?>&tb=invoices" style="color: white; text-decoration: none;">Delete</a>
 
    </tr>
    
  	<?php } } ?> 
  	</tbody>
	
</table>
                     <h3 class="mt-3 text-center">Total: <?php echo $total * $stock; ?></h3>
</div>
</body>

<script type="text/javascript">
    
    $("#adder").click(function(e) {
  e.preventDefault();
       var invoce_no = $("#Inv").val()
       // var dataString = 'Product_Name='+Product_Name+'&invoce_no='+invoce_no;
  var dataString = 'invoce_no='+invoce_no;
  $.ajax({
    type:'POST',
    data:dataString,
    url: '../private/purchase_by_id_add.php',
    success:function(data) {
      alert(data);
    }
  });
});

</script>
