<?php
$name = "";
$date = "";
$sales_price = 0;
include_once('file_roots.php');
 if($_POST['invoce_no']){
 	global $db;
 	if($_POST['invoce_no'] != ''){
 	 $sql = "SELECT * FROM invoice_lists ";
 	 $sql .= "WHERE Invoice_NO='" . $_POST['invoce_no'] . "' ";
 	 $query = mysqli_query($db, $sql);
 	 $fetch = mysqli_fetch_assoc($query);
 	 $name = $fetch['Customer_Name'];
 	 $date = $fetch['Date'];
 	 $sql2 = "SELECT * FROM invoices ";
 	 $sql2 .= "WHERE Invoice_NO='" . $_POST['invoce_no'] . "' ";
 	 $query2 = mysqli_query($db, $sql2);
 	 while ($data = mysqli_fetch_assoc($query2)){
 	 	$sales_price += $data['Total'];
 	 }
     $nowcheckdubli = check_Customer_Inv_exit($_POST['invoce_no']);
     if($nowcheckdubli){
     $nowcheckdublio = check_Invoice_exist_avoid_dubli($_POST['invoce_no']);
     if(!$nowcheckdublio){
      echo "no data";
      exit();
     }
     $nowfetch = mysqli_fetch_assoc($nowcheckdublio);
     // while ($newdata = $nowfetch) {
     foreach($nowfetch as $key => $data){
       // echo $nowfetch['Invoice_NO'];
     If($_POST['invoce_no'] = $nowfetch['Invoice_NO']){
     
 	 $sql3 = "INSERT INTO customerbook ";
 	 $sql3 .= "( Name, Purchase_amount, Date, Invoice_No) ";
     $sql3 .= "VALUES( ";
 	 $sql3 .= "'" . $name . "', ";
 	 $sql3 .= "'". $sales_price . "', ";
 	 $sql3 .= "'" . $date . "', ";
 	 $sql3 .= "'". $_POST['invoce_no'] . "' )";
 	 $query3 = mysqli_query($db, $sql3);
     echo "Invoice Added Into CustomerBook";
     exit;
 	}
 }
 }
 }
 }
?>