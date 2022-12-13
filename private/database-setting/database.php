<?php
   require_once("credantials.php");

   $db = mysqli_connect(D_host,D_user,D_Pass,D_Name);
   if(mysqli_connect_errno()){
   	  echo "faild to connect";
   }

?>

