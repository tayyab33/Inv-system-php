<?php 
$title = "vendor"; include_once('layouts/header.php'); 
session_start();
include_once('../private/file_roots.php');

     
  
 if(request_post()){
   $result = "";
   // session for form submission check

   if(isset($_POST['name']) != ""){
   $namecheck =  $_POST['name'];
   if(!is_numeric($namecheck) && is_numeric($_POST['contact'])){
  // check result if exist
  
  if(check_vendor_exist($namecheck)){
  	$vendor  = [];
	$vendor['name'] =  strip_tags($_POST['name']);
	$vendor['contact'] = strip_tags($_POST['contact']);
	$re = insertdata('vendor',$vendor);

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
<nav class="navbar nav bg-dark">
    <h3 class="m-auto m-2 text-danger"> Vendor Page </h3>
</nav>

<form method="POST" action="">
	<h1 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              Vendor Record Saved!
   </h1>
   <div class="card col-md-5 m-auto mt-3 p-4 bg-danger">
    <div class="form-outline mb-2">
      <label class="form-label" for="name">Vendor Name</label>
		<input type="text" name="name"  class="form-control">
  </div>
      <div class="form-outline mb-2">
        <label class="form-label" for="name">Contact No</label>
	<input type="text" name="contact"  class="form-control">
     </div>
    <input type="submit" name="submit" class="btn btn-sm btn-primary">
  </div>
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
      <td>S.NO</td>
      <td>Vendor Name</td>
      <td>Vendor contact</td>
      <td>action</td>
    </tr>
    </thead>
    <tbody>
      <?php $data = select_data('vendor'); while($vendor = mysqli_fetch_assoc($data)){ ?>
    <tr>
       <td><?php echo $vendor['Id'] ?></td>
       <td><?php echo $vendor['Name'] ?></td>
       <td><?php echo $vendor['contact'] ?></td>
   <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $vendor['Id'] ?>&tb=vendor"> Delete </a></button>&nbsp;

     <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#Vendor<?php echo $vendor['Id'] ?>">
                update
        </button>
      </td>
    </tr>
       <?php include ('layouts/vendormodal.php'); ?> 
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