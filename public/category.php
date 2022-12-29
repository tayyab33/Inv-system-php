<?php 
$title = "category"; include_once('layouts/header.php'); 
session_start();
include_once('../private/file_roots.php');

 if(request_post()){
   $result = "";
   // session for form submission check

   if(isset($_POST['name']) != ""){
    $string = $_POST['name'];
     if(!is_numeric($string)){
   $namecheck =  $_POST['name'];
  // check result if exist

  if(check_category_exist($namecheck)){

	$cetogry  = [];
	$cetogry['name'] = $_POST['name'];
	$re = insertdata('category',$cetogry);

      echo "<div>" ?> 
      <script type="text/javascript">
      	function message(){
      		document.getElementById('message').style.display ="block";
      	}
      	setTimeout("message()", 100);
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
    <h3 class="m-auto m-2 text-danger"> Category Page </h3>
</nav>
<form method="POST" action="" autocomplete="none">
  <h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
              category Record Saved!
   </h2>
   <div class="card col-md-5 m-auto mt-3 p-4 bg-danger">
    <div class="form-outline mb-2">
      <h4 class=" bg-success m-auto text-center text-white mb-2 p-1" for="name"><b>Category Name: </b></h4>
    <input type="text" name="name" id="name" class="form-control" >
     </div>
      <input type="submit" name="submit" class="btn btn-sm btn-primary" autocomplete="off">
     </div>
</form>
 <nav class="nav navbar bg-success mt-3">
  <div class="text-right">
   <label class="text-right m-3 text-white">Search</label>
   <input id="search" type="search" name="search" class=" m-3" /> 
   </div>
<!--   <h3 class="text-left m-1 text-white">Payment to Receive: </h2>
  <h3 class="text-right m-1 text-white">Payment to Pay: </h2> -->
  </nav>


<table class="table table table-bordered m-auto" id="table">
  <thead>
    <tr class="head--row">
      <td>S.No</td>
      <td>Category Name</td>
      <td>action</td>
    </tr>
    </thead>
    <tbody id="table">
      <?php $data = select_data('category'); while($cetogry = mysqli_fetch_assoc($data)){ ?>
    <tr>
       <td><?php echo $cetogry['Id'] ?></td>
       <td id="name"><?php echo $cetogry['Name'] ?></td>
       <td><button class="btn btn-sm btn-danger text-w"><a class="change-st" href="../private/delete.php?id=<?php echo $cetogry['Id'] ?>&tb=category"> Delete </a></button>&nbsp;

     <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $cetogry['Id'] ?>">
                update
        </button>
      </td>
    </tr>
    <?php include ('layouts/Categorymodal.php'); ?> 
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

 

