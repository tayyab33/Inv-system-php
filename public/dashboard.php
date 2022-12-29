<?php $title = "dashboard"; include_once('layouts/header.php'); 
  include_once('../private/file_roots.php');
?>
<style type="text/css">
  /* Define a basic layout for the page */
body {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
}

header {
  background-color: #333;
  color: #fff;
  padding: 20px;
}

header h1 {
  margin: 0;
}

main {
  margin: 20px;
}

/* Define styles for the customer form */
form {
  max-width: 500px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
}

form label {
  font-weight: bold;
  margin-bottom: 5px;
}

form input,
form textarea {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  font-size: 16px;
  margin-bottom: 20px;
}

form button {
  background-color: #333;
  color: #fff;
  border: 0;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

/* Define styles for the customer table */
table {
  border-collapse: collapse;
  width: 100%;
}

th,
td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
}

th {
  background-color: #333;
  color: #fff;
}

.col-md-3{
  border-radius: 5px;
}

</style>
 
 <nav class="navbar nav bg-dark">
    <h3 class="m-auto m-2 text-danger"> Dashboard Page &nbsp; <button class="btn btn-success"><a href="Invoice_genrate.php" style="color:white; text-decoration: none;">Make Invoice</a></button></h3>
</nav>
 

 <div class="row mt-3">
    <div class="col-md-3 bg-primary m-auto text-white">
      <h1 class="p-2"> Today Sales </h1>
       <hr />
       <h5 class="p-3">
         
        <?php 
        $todaySales = today('invoices'); 

        if(isset($todaySales)){
          $total = 0;
        while ($data = mysqli_fetch_assoc($todaySales)) {
            $total += $data['Total'];
        }
       
         echo $total ?: 0;
        // function pluser($value1,$value2){
        //   return intval($value1) + intval($value2);
        // }
         }
        ?>

       </h5>

    </div>
    <div class="col-md-3 bg-primary m-auto text-white">
      <h1 class="p-2"> Today purchase </h1>
       <hr />
       <h5 class="p-3">
         
        <?php 
        $purchaseSaless = today('purchase_products'); 

        if(isset($purchaseSaless)){
          $totals = 0;
          $Purchase_Price = 0;
          $purchase_stock = 0;

        while ($datas = mysqli_fetch_assoc($purchaseSaless)) {
            $purchase_stock += $datas['Purchase_Stock'];
            $Purchase_Price += $datas['Purchase_Price'];
            $change = $purchase_stock * $Purchase_Price;
            $totals += $change;
        }
       
             echo $totals ?: 0;
        function mutipal($value1,$value2){
          return intval($value1) * intval($value2);
        }
         }
        ?>

       </h5>

    </div>
        <div class="col-md-3 bg-primary m-auto text-white">
      <h1 class="p-2"> Today purchase </h1>
       <hr />
       <h5 class="p-3">
         
        <?php 

        if(isset($todaySales)){
          $totals = 0;
          $Purchase_Price = 0;
          $Total_Price = 0;
          while ($datav = mysqli_fetch_assoc($products)) {
            $total += $datav['Total'];
            $Purchase_Price += $datav['Product_Price'];
        }
          while ($data = mysqli_fetch_assoc($todaySales)) {
            $total += $data['Total'];
            $Purchase_Price += $data['Purchase_Price'];
        }
       
             echo $totals ?: 0;
        function mutipal($value1,$value2){
          return intval($value1) * intval($value2);
        }
         }
        ?>

       </h5>

    </div>
 </div>