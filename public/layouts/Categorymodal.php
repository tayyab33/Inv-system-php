<!-- The Modal -->
<?php

   if(request_post()){
 if(isset($_POST['UpdateId']) != ""){
   	   $update = [];
   	   $update['Id'] = $_POST['UpdateId'];
   	   $update['Name'] = $_POST['updatename'];
   	   $result = update_data('category', $update);
   }
}
  
 
?>
<div class="modal" id="myModal<?php echo $cetogry['Id'] ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update category</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="change()"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
       <form method="POST" action="" autocomplete="none">
	<h2 class="alert alert-success" role="alert" id="message" style="display: none; position: absolute;">
               Record Saved!
   </h2>
   	<input type="hidden" name="UpdateId" class="form-control" id="updatename" value="<?php echo  $cetogry['Id'] ?>">
     Category Name
		<input type="text" name="updatename" class="form-control" id="updatename" value="<?php echo  $cetogry['Name'] ?>">
       <input type="submit" name="updatesubmit" class="btn btn-sm btn-primary mt-2">

       </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
