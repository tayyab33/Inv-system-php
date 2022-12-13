<link rel="stylesheet" media="all" href="css/bootstrap.min.css">
<?php 
$title = "Invoice_filters";  include_once('../private/file_roots.php'); include 'layouts/invoice_sripts_links.php'; 
   if(!isset($_GET['Inv'])){ return header("Location:". " dashboard.php");}  ?>
      <!-- return header("Location: ../public/" . strip_tags($table) . ".php"); -->

<button id="back" type="button" class="btn-sm btn btn-info" >&larr; <a  href="Invoice_lists.php" style="text-decoration: none; color: black;"> Back</a></button>

<?php $checkinv = check_Customer_Inv_exit($_GET['Inv']); 
if($checkinv){ ?>
<button id="adder" type="button" class="btn-sm btn btn-success" > <a  href="Invoice_lists.php" style="text-decoration: none; color: white;"> Add in customer book</a></button>
<?php } ?>
<button id="print" onclick="printpage()" class="float-left btn btn-dark btn-sm">Print</button>
<body class="m-3">
<h1 class="text-center mt-3 border border-dark p-2 m-auto" style="width: 64%;">S And S Malik Traders Talagang</h1>
<p class="text-center mt-1"><b>Address:</b> Chowk SiddiqueAbad Islamic Bank Opposite Alqamar Hospital</p>
<hr class="mt-2 mb-3 bg-dark">
<p class="text-center"><b>M.Ateeq Malik :</b> 0301-0177761</p>
<p class="text-center"><b>M.Siddique Malik :</b> 0313-786771</p>
<div class="container">
    <div class="row">
    <div class="col">
        <input type="hidden" id="Inv" value="<?php echo $_GET['Inv'] ?>" >
<p><b class="">Invoice no:</b> <?php echo $_GET['Inv']; $resut = select_data('invoice_lists'); $dat = mysqli_fetch_assoc($resut); ?></p>
</div>
<div class="col">
<p><b class="">Customer:</b> <?php echo $dat['Customer_Name']; ?></p>
</div>
<div class="col">
<p><b class="">Date :</b> <?php echo $dat['Date']; ?></p>
</div>
</div>
<hr class="mt-2 mb-3 bg-dark">
<!-- <input type="text" id="search" placeholder="Type to search"> -->
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
         $result = select_data('invoices'); while($data = mysqli_fetch_assoc($result)) {
  			if($data['Invoice_NO'] == $_GET['Inv']){ ?>
          <?php 
          $total += $data['Product_Sales_Price'];
          $stock += $data['Sales_Stock'];
          ?>
  	<tr>
  		<td><?php echo $data['Id']; ?></td>
  		<td><?php echo $data['Product_Name']; ?></td>
  		<td><?php echo $data['Category']; ?></td>
  		<td><?php echo $data['Product_Sales_Price']; ?></td>
  		<td><?php echo $data['Sales_Stock']; ?></td>
  		<td><?php echo $data['Total']; ?><button id="buttons" type="button" class="btn btn-sm btn-success"> <a href="../private/delete.php?id=<?php echo $data['Id'] ?>&tb=invoices" style="color: white; text-decoration: none;">Delete</a>
                
        </button>&nbsp;   <button id="button" type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#Invoiceupdate<?php echo $data['Id'] ?>">
                Update
        </button></td>
 
    </tr>
    <?php include ('layouts/Invoice_listmodal.php'); ?> 
  	<?php } } ?> 
  	</tbody>
	
</table>
                     <h3 class="mt-3 text-center">Total: <?php echo $total * $stock; ?></h3>
</div>
</body>
  <!-- <input class="text" id="myInput" type="text" placeholder="Search.."> -->
  <br>
<!--   <ul class="list-group" id="myList">
    <li class="list-group-item"></li>
    <li class="list-group-item">Second item</li>
    <li class="list-group-item">Third item</li>
    <li class="list-group-item">Fourth</li>
  </ul> -->  
<?php include_once('layouts/footer.php'); ?> 

<script>
var addSerialNumber = function () {
    var i = 1
    $('table tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index-1+1);
    });
};
	var $rows = $('#table tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

addSerialNumber();
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myList td").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -10)
    });
  });
});

 function printpage() {
        //Get the print button and put it into a variable
        var back = document.getElementById("back");
        var print = document.getElementById("print");
        var footer = document.getElementById("footer");
        var buttons = document.getElementById("buttons");
        var button = document.getElementById("button");
        var adder = document.getElementById("adder");

        //Set the print button visibility to 'hidden' 
        back.style.visibility = 'hidden';
        print.style.visibility = 'hidden';
        footer.style.visibility = 'hidden';
        buttons.style.visibility = 'hidden';
        button.style.visibility = 'hidden';
        adder.style.visibility = 'hidden';
        

        //Print the page content
        window.print()
        back.style.visibility = 'visible';
        print.style.visibility = 'visible';
        footer.style.visibility = 'visible';
        buttons.style.visibility = 'visible';
        button.style.visibility = 'visible';
        adder.style.visibility = 'visible';

    }
</script>

</body>
</html>

<script type="text/javascript">
    
    $("#adder").click(function(e) {
  e.preventDefault();
       var invoce_no = $("#Inv").val()
       // var dataString = 'Product_Name='+Product_Name+'&invoce_no='+invoce_no;
  var dataString = 'invoce_no='+invoce_no;
  $.ajax({
    type:'POST',
    data:dataString,
    url: '../private/Invoice_by_id_add.php',
    success:function(data) {
      alert(data);
    }
  });
});

</script>