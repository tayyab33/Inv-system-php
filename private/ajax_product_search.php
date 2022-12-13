<?php 
session_start();
 include_once('file_roots.php');
 $name = "";
if($_REQUEST['empid'] ?? ''){
  $name = $_REQUEST['empid'];
  searchajax($name);
}
function searchajax($data){
  global $db;
  $sql = "SELECT * From product where Product_Name = '" . $data . "'";
  $resultSet = mysqli_query($db, $sql);
  $empdata = array();
  while($emp = mysqli_fetch_assoc($resultSet)){
    $empdata = $emp;
  }
  if($empdata > 0){
     echo json_encode($empdata);
   }else{
    echo 0;
   }
 
}
if($_POST['Product_Name'] ?? ''){
  if($_POST['Product_Name'] != ''){
    global $db;
    $namecheck = $_POST['Product_Name'];
    $result = check_product_exist_to_update($namecheck);
    $fetchs = mysqli_fetch_assoc($result);
    if(!$fetchs['Prodcut_Stock'] <= 0){
      $dublicate = check_Invoice_exist_avoid_dubli($_POST['invoce_no']);
      if($dublicate){
      while ($fetchdata = mysqli_fetch_assoc($dublicate)){
         if($fetchdata['Product_Name'] == $_POST['Product_Name']){
         echo "dublicate";
         exit;
         }
      }
    }

 

  
  $Product_name = $_POST['Product_Name'];
  $Product_Sales_Price = $_POST['Product_Sales_Price'];
  $Category = $_POST['category'];
  $Product_Stock = $_POST['Product_Stock'];
  $Sales_Stock = $_POST['Sales_Stock'];
  $Total = multiply($_POST['Sales_Stock'],$_POST['Product_Sales_Price']);
  $Invoice_NO = $_POST['invoce_no'];
  

   $sales = [];
  $sales['Product_Name'] =  $Product_name;
  $sales['Product_Sales_Price'] =  $Product_Sales_Price;
  $sales['category'] =  $Category;
  $sales['Product_Stock'] =  $Product_Stock;
  $sales['Sales_Stock'] = $Sales_Stock;
  $sales['total'] = $Total;

  $_SESSION['sales'] = $sales;

  $sql = "INSERT INTO invoices ";
  $sql .= "(Product_name, Product_Sales_Price, Category, Product_Stock, Sales_Stock, Total, Invoice_NO) ";
  $sql .= "VALUES (";
  echo "good";
  $sql .= "'" . $Product_name . "', ";
  $sql .= "'" . $Product_Sales_Price . "', ";
  $sql .= "'" . $Category . "', ";
  $sql .= "'" . $Product_Stock . "', ";
  $sql .= "'" . $Sales_Stock . "', ";
  $sql .= "'" . $Total . "', ";
  $sql .= "'" . $Invoice_NO . "' )";
  $query = mysqli_query($db, $sql);
  if($query >= 1) {
    $sql2 = "SELECT * FROM invoice_lists ";
    $sql2 .= "WHERE Invoice_NO ='" . $Invoice_NO . "'";
    $query2 = mysqli_query($db,$sql2);
    if(mysqli_fetch_assoc($query2) <= 0){
      $sql3 = "INSERT INTO invoice_lists ";
      $sql3 .= "(Invoice_NO)";
      $sql3 .= " VALUES(";
      $sql3 .= "'" . $Invoice_NO . "' )";
      $query3 = mysqli_query($db, $sql3);
    }
  } else {
   echo "Cannot Insert";
  }
  } else {
    echo "low stock";
  }
  }
  }

  function multiply($firstvalue, $lastvalue){
    return $firstvalue * $lastvalue;
  }
?>