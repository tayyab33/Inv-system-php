<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" media="all" href="../public/css/style.css">
	<link rel="stylesheet" media="all" href="../public/css/bootstrap.min.css">

  
	<style type="text/css">
		#navbarb{
			background: indianred;
		}
		#nav-links{
			display: flex;
			list-style: none;
			position: relative;
		}
		.nav-linker{
			background: red;
			height: 20px;
			width: 40px;
		}
		.form-control{
	background: darkgray; 
	border: 1px solid  darkkhaki;
}
     .form-control:focus{
     	background: darkgray;
     	font-weight: bold;
     	font-weight: 400px;
     }
     .check{
     	font-weight: bold; 
     	color: white;
     }
	</style>
   <title><?php echo isset($title) ? $title : 'inventory managment system';  ?></title>
   <?php 
      if($title){

      	$btn_id = "btn" . "-" . $title;
      	echo "<style> 
             #$btn_id {
      	   color : black;
      	   background: royalblue;
      }
      	</style>";
      }
   ?>
  
 
</head>
<body style="background: #dbd6d0;">
          <nav class="nav navbar navbar-collapse p-0 m-0 bg-dark">
          	 <h1 class="navbar-brand m-auto" style="color: white;">&nbsp;Welcome to inventory system</h1>
          </nav>
		
	<nav id="navbarb" class="nav navbar navbar-collapse">
		<div class="container-fluid">
		 <ul id="nav-links" class="">
		 	<li><a href="dashboard.php" id="btn-dashboard" class="btn-sm btn btn-dark fw-bold m-2">Dashboard</a></li>
		 	<li><a href="customer.php" id="btn-customer"  class="btn-sm btn btn-dark m-2">Customer</a></li>
			<li><a href="vendor.php" id="btn-vendor"  class="btn-sm btn btn-dark m-2">vendor</a></li>
			<li><a href="category.php" id="btn-category"  class="btn-sm btn btn-dark m-2">Category</a></li>
			<li><a href="product.php" id="btn-product"  class="btn-sm btn btn-dark m-2">Product</a></li>
			<li><a href="purchase_stock.php" id="btn-purchase"  class="btn-sm btn btn-dark m-2">purchase</a></li>
			<li><a href="vendor_book.php" id="btn-vendorbook"  class="btn-sm btn btn-dark m-2">Vendorbook</a></li>
			<li><a href="Customers_book.php" id="btn-customerbook"  class="btn-sm btn btn-dark m-2">Customerbook</a></li>
			<li><a href="Invoice_genrate.php" id="btn-Invoice"  class="btn-sm btn btn-dark m-2">Invoice Make</a></li>
			<li><a href="Invoice_lists.php" id="btn-Invoice_lists"  class="btn-sm btn btn-dark m-2">Invoice_list</a></li>
			<li><a href="sales_return.php" id="btn-sales_return"  class="btn-sm btn btn-dark m-2">Return Sales</a></li>
			<li><a href="purchase_return.php" id="btn-Purchase_return"  class="btn-sm btn btn-dark m-2">Return Purchase</a></li>
		 </ul>
	</nav>
	<section class="container">

