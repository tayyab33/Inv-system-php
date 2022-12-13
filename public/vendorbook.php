<?php  if(!isset($_GET['Inv'])){ return header("Location:". " vendor_book.php");}  ?> 
<?php 
 $title = "vendorbook"; include_once('layouts/header.php'); 
include_once('../private/file_roots.php');
 $totalReceive = 0; $totalPay = 0;
?>

<h3 class="mt-3 mb-3 p-3 m-auto bg-dark text-white text-center">
<button id="back" type="button" class="btn-sm btn btn-info" style="position: relative; margin-right: 10px">&larr; <a  href="vendor_book.php" style="color: black; text-decoration: none;">Go Back</a></button>
  <?php echo ucfirst($_GET['Inv']); ?> Cashbook Report</h3>
 
<table class="table">
  <thead>
    <tr>
      <td>S.NO</td>
      <td>Vendor Name</td>
      <td>Purchase amount</td>
      <td>Paid Amount</td>
      <td>Unpaid Amount</td>
      <td>Payment to receive</td>
      <td>Date</td>
    </tr>
    </thead>
    <tbody>
       <?php $data = check_data_exist_in_book('vendorbook', $_GET['Inv']);
       if(isset($data)){ while($vendor = mysqli_fetch_assoc($data)){ 
        $totalReceive += $vendor['Unpaid_amount'];
        $totalPay += $vendor['Pay_to_receive'];
        ?>
    <tr>
       <td><?php echo $vendor['Id'] ?></td>
       <td><?php echo $vendor['Vendor_name'] ?></td>
       <td><?php echo $vendor['Purchase_amount'] ?></td>
       <td><?php echo $vendor['Payment_done'] ?></td>
       <td><?php echo $vendor['Unpaid_amount'] ?></td>
        <td><?php echo $vendor['Pay_to_receive'] ?></td>
        <td><?php echo $vendor['Date'] ?></td>
   <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $vendor['Id'] ?>&tb=vendor"> Delete </a></button>&nbsp;

     <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#vendorbook<?php echo $vendor['Id'] ?>">
                update
        </button>
      </td>
    </tr>
          <?php include ('layouts/vendorbookUpdatemodal.php'); ?> 
  <?php }  } ?>
    </tbody>
</table>
 <nav class="nav navbar bg-danger">
  <h3 class="text-left m-1 text-white">Payment to Pay: <?php echo $totalReceive; ?></h2>
  <h3 class="text-right m-1 text-white">Payment to Receive: <?php echo $totalPay; ?></h2>
  </nav>
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