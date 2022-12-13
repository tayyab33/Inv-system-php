<?php  if(!isset($_GET['Inv'])){ return header("Location:". " Customers_book.php");}  ?> 
<?php 
 $title = "customerbook"; include_once('layouts/header.php'); 
include_once('../private/file_roots.php');
 $totalReceive = 0; $totalPay = 0;
?>

<h3 class="mt-3 mb-3 p-3 m-auto bg-dark text-white text-center">
<button id="back" type="button" class="btn-sm btn btn-info" style="position: relative; margin-right: 10px">&larr; <a  href="Customers_book.php" style="color: black; text-decoration: none;">Go Back</a></button>
  <?php echo ucfirst($_GET['Inv']); ?> Cashbook Report</h3>
 <nav class="navbar nav bg-dark mb-2">
    <h3 class="m-auto m-2 text-danger"> Customer_book Page </h3>
</nav>
<table class="table mt-3">
  <thead>
    <tr>
      <td>S.No</td>
      <td>Customer Name</td>
      <td>Purchase amount</td>
      <td>Paid Amount</td>
      <td>Unpaid Amount</td>
      <td>Payment to Pay Customer</td>
      <td>Date</td>
      <td>Action</td>

    </tr>
    </thead>
    <tbody>
      <?php $data = check_data_exist_in_book("customerbook",$_GET['Inv']);
      if(isset($data)){ while($customer = mysqli_fetch_assoc($data)){ 
        $totalReceive += $customer['Customer_Unpaid'];
        $totalPay += $customer['Your_payment_to_the_customer'];
        ?>
    <tr>
    <td><?php echo $customer['Id'] ?></td>
       <td><?php echo $customer['Name'] ?></td>
       <td><?php echo $customer['Purchase_amount'] ?></td>
       <td><?php echo $customer['Customer_Paid'] ?></td>
       <td ><?php echo $customer['Customer_Unpaid'] ?></td>
        <td><?php echo $customer['Your_payment_to_the_customer'] ?></td>
        <td><?php echo $customer['Date'] ?></td>
   <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $customer['Id'] ?>&tb=customerbook"> Delete </a></button>&nbsp;<button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#customerbook<?php echo $customer['Id'] ?>">
                update
        </button>
      </td>
    </tr>
       <?php include ('layouts/customerbookUpdatemodal.php'); ?> 
  <?php } } ?>
    </tbody>
</table>
 <nav class="nav navbar bg-danger">
  <h3 class="text-left m-1 text-white">Payment to Receive: <?php echo $totalReceive; ?></h2>
  <h3 class="text-right m-1 text-white">Payment to Pay: <?php echo $totalPay; ?></h2>
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