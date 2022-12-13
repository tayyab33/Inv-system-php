<?php $title = "dashboard"; include_once('layouts/header.php'); 
  include_once('../private/file_roots.php');
?>
 
 <nav class="navbar nav bg-dark">
    <h3 class="m-auto m-2 text-danger"> Dashboard Page &nbsp; <button class="btn btn-success"><a href="Invoice_genrate.php" style="color:white; text-decoration: none;">Make Invoice</a></button></h3>
</nav>
 

 <div class="row mt-3">
    <div class="col-md-3 bg-primary m-2">
      <h1> Today Sales </h1>
        <?php 
        $todaySales = today('invoice_lists'); 
        $fetch = mysqli_fetch_assoc($todaySales);
        while ($data = $fetch) {
            echo $data['Product_Name'];
        }
        ?>
    </div>
    <div class="col-md-3 bg-primary m-2">
       sfsdf
    </div>
     <div class="col-md-3 bg-primary m-2">
       sfsdf
    </div>
 </div>