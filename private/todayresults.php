<?php
 require_once('file_roots.php');
 function today($table){
 	global $db;
 	$date = date('Y-M-D');
 	$sql = "SELECT * FROM " . $table . " ";
 	$sql .= "WHERE Date = '" . $date . "' ";
 	$query = mysqli_query($db, $sql);
 	if(mysqli_num_rows($query) >= 1){
        return $query;
 	}else{
 		return false;
 	}
 }


?>