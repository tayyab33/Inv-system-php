<?php 
$title = "Invoice_lists"; include_once('layouts/header.php'); 
include_once('../private/file_roots.php');
?>
<nav class="navbar nav bg-dark mb-4">
    <h3 class="m-auto m-2 text-danger"> Invoice List </h3>
</nav>
<table class="table">
	<thead>
	 <tr>
	 	<td>S.No</td>
	 	<td>Invoices_Numbers</td>
	 	<td>Customer_Name</td>
	 	<td>Invoices_View</td>
	 	<td>Invoice_Delete</td>
	 	<td>Invoices_Update</td>
	 </tr>
	</thead>
	<tbody id="table" >
		<?php 
		$result = select_data('invoice_lists'); 
		while($data = mysqli_fetch_assoc($result)){ ?>
		<tr>
			
			<td><?php echo $data['Id'] ?></td>
			<td><?php echo $data['Invoice_NO'] ?></td>
			<td><?php echo $data['Customer_Name'] ?></td>
			  <td><button><a class="change-st" href="Invoice_Record_by_Id.php?Inv=<?php echo $data['Invoice_NO'] ?>">View</a></button></td>
		    <td><button><a class="change-st" href="../private/delete.php?id=<?php echo $data['Invoice_NO']; ?>&table=invoice_lists">Delete</a></button></td>
	  <td> <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#Invoce_Updater<?php echo $data['Id'] ?>">
                update
        </button>
      </td>
    </tr>
       <?php include ('layouts/Invoce_updatermodal.php'); ?> 
  <?php } ?>
    </tbody>
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