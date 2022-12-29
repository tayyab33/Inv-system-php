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
    If($fetchs['Prodcut_Stock'] < $_POST['Sales_Stock']){
      echo "low stock";
      exit;
    }


    // echo $_POST['Product_Stock'];
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
  $Total = multiply($Sales_Stock,$Product_Sales_Price);
  $Invoice_NO = $_POST['invoce_no'];
   $dublicat = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
   isset($_SESSION['sales']) ?: $_SESSION['sales'][] = [];
    foreach($_SESSION['sales'] as $data){
       if($data['Product_Name'] == $Product_name){
           $dublicat = true;
       }elseif ($data['Invoice_NO'] != $Invoice_NO) {
           session_unset();
           $dublicat = false;
       }
    }
    if($dublicat != true ){
  $_SESSION['sales'][] = [
    'Product_Name' => $Product_name,
    'Product_Sales_Price' => $Product_Sales_Price,
    'category' => $Category,
    'Product_Stock' => $Product_Stock,
    'Sales_Stock' => $Sales_Stock,
    'total' => $Total,
    'Invoice_NO' => $Invoice_NO
   ];
  
 }
  }


  $sql = "INSERT INTO invoices ";
  $sql .= "(Product_name, Product_Sales_Price, Category, Product_Stock, Sales_Stock, Total, Invoice_NO) ";
  $sql .= "VALUES (";
  echo "Sales done";
  $sql .= "'" . $Product_name . "', ";
  $sql .= "'" . $Product_Sales_Price . "', ";
  $sql .= "'" . $Category . "', ";
  $sql .= "'" . $Product_Stock . "', ";
  $sql .= "'" . $Sales_Stock . "', ";
  $sql .= "'" . $Total . "', ";
  $sql .= "'" . $Invoice_NO . "' )";
  $query = mysqli_query($db, $sql);
  $sql6 = "SELECT * From product where Product_Name ='" . $Product_name . "'";
  $quiry =  mysqli_query($db, $sql6);
  $fetches = mysqli_fetch_assoc($quiry);
  $stockes = $fetches['Prodcut_Stock'];
  $minus  = $stockes - $Sales_Stock;
  $updatesproduct = "UPDATE product Set Prodcut_Stock ='" . $minus . "' ";
  $updatesproduct .= "WHERE Product_Name='" . $Product_name . "' ";
   mysqli_query($db, $updatesproduct);
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