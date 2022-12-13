<?php
include_once('file_roots.php');
 
 function insertdata($table, $data){
   global $db;
  if($table == 'category'){
   $sql = "INSERT INTO " . strip_tags($table) . "";
   $sql .= "(Name) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['name']) . "' )";
   $result = mysqli_query($db, $sql);
  }else if($table == 'customer' || $table == 'vendor'){
   $sql = "INSERT INTO " . strip_tags($table) . "";
   $sql .= "(Name, contact) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['name']) . "',";
   $sql .= "'" . strip_tags($data['contact']) . "' )";
   $result = mysqli_query($db, $sql);
 }else if($table == 'product'){
   $sql = "INSERT INTO " . strip_tags($table) . "";
   $sql .= "(Product_Name, Product_Price, Product_Sales_Price, category) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['Product_Name']) . "', ";
   $sql .= "'" . strip_tags($data['Product_Price']) . "', ";
   $sql .= "'" . strip_tags($data['Product_Sales_Price']) . "', ";
   $sql .= "'" . strip_tags($data['category']) . "' )";
   $result = mysqli_query($db, $sql);
 }else if($table == 'purchase_products'){
   $sql = "INSERT INTO " . $table . "";
   $sql .= "(Product_Name, Purchase_Price, Purchase_Stock, vendor, Invoice_NO) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['Product_Name']) . "', ";
   $sql .= "'" . strip_tags($data['Purchase_Price']) . "', ";
   $sql .= "'" . strip_tags($data['Purchase_Stock']) . "', ";
   $sql .= "'" . strip_tags($data['vendor']) . "', ";
   $sql .= "'" . strip_tags($data['Invoice_NO']) . "' )";
   $result = mysqli_query($db, $sql);
   if($result){
     $re = check_product_exist_to_update($data['Product_Name']);
     $productfetch = mysqli_fetch_assoc($re);
     $stock = $productfetch['Prodcut_Stock'];
     echo $stock;
     $sql2 = "UPDATE product set Prodcut_Stock ='" . (int)$stock + $data['Purchase_Stock'] . "' ";
     $sql2 .= "WHERE Product_Name ='" . strip_tags($productfetch['Product_Name']) . "' ";
     $result = mysqli_query($db, $sql2);
   }
 }else if($table == 'vendorbook'){
   $sql = "INSERT INTO " . $table . "";
   $sql .= "(Vendor_name, Purchase_amount, Payment_done, Unpaid_amount, Pay_to_receive, Date) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['vendor']) . "', ";
   $sql .= "'" . strip_tags($data['Purchase_amount']) . "', ";
   $sql .= "'" . strip_tags($data['Payment_done']) . "', ";
   if(strip_tags($data['Purchase_amount']) >= strip_tags($data['Payment_done'])){
   $sql .= "'" . substric($data['Purchase_amount'],$data['Payment_done']) . "', ";
   $sql .= "'" . 0 . "', ";
   }else if(strip_tags($data['Purchase_amount']) <= strip_tags($data['Payment_done'])){
       $sql .= "'" . 0 . "', ";
       $sql .= "'" .  substric($data['Payment_done'],$data['Purchase_amount']) . "', ";
   }
   $sql .= "'" . strip_tags($data['Date']) . "' )";
   $result = mysqli_query($db, $sql);
 }else if($table == 'customerbook'){
   $sql = "INSERT INTO " . $table . "";
   $sql .= "(Name, Purchase_amount, Customer_Paid, Customer_Unpaid, Your_payment_to_the_customer,  Date ) "; 
   $sql .= "VALUES (";
   $sql .= "'" . strip_tags($data['Name']) . "', ";
   $sql .= "'" . strip_tags($data['Purchase_amount']) . "', ";
   $sql .= "'" . strip_tags($data['Paid_Amount']) . "', ";
   if(strip_tags($data['Purchase_amount']) >= strip_tags($data['Paid_Amount'])){
   $sql .= "'" . substric($data['Purchase_amount'],$data['Paid_Amount']) . "', ";
   $sql .= "'" . 0 . "', ";
   }else if(strip_tags($data['Purchase_amount']) <= strip_tags($data['Paid_Amount'])){
       $sql .= "'" . 0 . "', ";
       $sql .= "'" .  substric($data['Paid_Amount'],$data['Purchase_amount']) . "', ";
   }
   $sql .= "'" . strip_tags($data['Date']) . "' )";
   $result = mysqli_query($db, $sql);
 }
 }
 function substric($amount,$minusamount){
   return $amount - $minusamount;
 }

 function request_post(){
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
    return true;
   }else{
  return false;  
   }
 }

 function check_customer_exist($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM customer WHERE name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      mysqli_free_result($result);
      return true;
    }
   }
 }

function select_data($data){
  global $db;
  $query = "SELECT * FROM ". strip_tags($data) . "";
  $result = mysqli_query($db, $query);
     return $result;
}
function search_data_customer($data){
  global $db;
  $query = "SELECT * FROM customer WHERE name LIKE '" . strip_tags($data) . "'";
}

function check_vendor_exist($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM vendor WHERE Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      mysqli_free_result($result);
      return true;
    }
   }
 }
 function check_category_exist($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM category WHERE name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      mysqli_free_result($result);
      return true;
    }
   }
 }
function check_vendor_exist_for_purchase($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM vendor WHERE Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      mysqli_free_result($result);
      return $result;
    }
   }
 }
 function check_Invoice_exist_avoid_dubli($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM invoices WHERE Invoice_NO ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      return $result;
    }
   }
 }
  function check_Purchase_exist_avoid_dubli($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM purchase_products WHERE Invoice_NO ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      return $result;
    }
   }
 }
  function check_data_exist_in_book($table,$namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
     if($table == 'vendorbook'){
        $query =  "SELECT * FROM ". $table . " WHERE Vendor_name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      return $result;
    }else{
      return array();
    }
    }else{
   $query =  "SELECT * FROM ". $table . " WHERE Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      return $result;
    }
   }
   }
 }

 function check_Customer_Inv_exit($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM customerbook WHERE Invoice_No ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      return $result;
    }
   }
 }
 
  function check_vendor_Inv_exit($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM vendorbook WHERE Invoice_NO ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      return $result;
    }
   }
 }
 function check_customer_exist_for_sales($namecheck){
    global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM customer WHERE Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 1) {
      mysqli_free_result($result);
      return $result;
    }
   }
 }
 function check_product_exist($namecheck){
     global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM product WHERE Product_Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) <= 0) {
      mysqli_free_result($result);
      return true;
    }
   }
 }
 // update product function is here
  function check_product_exist_to_update($namecheck){
     global $db;
    global $result;
  if($namecheck != ""){
   $query =  "SELECT * FROM product WHERE Product_Name ='" . strip_tags($namecheck) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) > 0) {
      // mysqli_free_result($result);
      return $result;
    }
   }
 }
   function check_data_Id($Id){
     global $db;
    global $result;
  if($Id != ""){
   $query =  "SELECT * FROM product WHERE Id ='" . strip_tags($Id) . "'";
    $result =  mysqli_query($db,$query);
    if(mysqli_num_rows($result) >= 0) {
      // mysqli_free_result($result);
      return $result;
    }
   }
 }
 function select_all($table){
  global $db;
  $sql = "SELECT * FROM " . $table . " ";
   $query9 = mysqli_query($db, $sql);
  return $query9;
 }

 function update_data($table, $update){
  global $db;
  global $ALLUPDATE;
  if($table == 'category'){
      
    $data = select_all('category');
       $fetch =  mysqli_fetch_assoc($data);
       $sqli = "UPDATE invoices Set Category = '" . $update['Name'] . "' ";
       $sqli .= "WHERE Category ='". $fetch['Name'] . "' ";
       $mysql= mysqli_query($db, $sqli);
       $sqli2 = "UPDATE product Set category = '" . $update['Name'] . "' ";
       $sqli2 .= "WHERE category ='". $fetch['Name'] ."' ";
       $mysql2= mysqli_query($db, $sqli2);

    $sql = "UPDATE " . $table . " ";
    $sql .= "set Name ='" . $update['Name'] . "' ";
    $sql .= "WHERE Id ='" . $update['Id'] . "' ";
    $result = mysqli_query($db, $sql);
    return header("Location: ../public/" . strip_tags($table) . ".php");

    }else if($table == 'customer' || $table == 'vendor'){

        If($table == 'customer'){
       $data = select_all($table);
       $fetch =  mysqli_fetch_assoc($data);
       $sqli = "UPDATE invoice_lists Set  Customer_Name = '" . $update['Name'] . "' ";
       $sqli .= "WHERE Customer_Name='". $fetch['Customer_Name'] . "' ";
       $mysql= mysqli_query($db, $sqli);
       $sqli2 = "UPDATE customerbook Set Name = '" . $update['Name'] . "' ";
       $sqli2 .= "WHERE Name ='". $fetch['Name'] ."' ";
       $mysql2= mysqli_query($db, $sqli2);
       }

        If($table == 'vendor'){
       $data = select_all($table);
       $fetch =  mysqli_fetch_assoc($data);
       $sqli = "UPDATE purchase_products Set  vendor = '" . $update['Name'] . "' ";
       $sqli .= "WHERE vendor='". $fetch['Name'] . "' ";
       $mysql= mysqli_query($db, $sqli);
       $sqli2 = "UPDATE vendorbook Set Vendor_name = '" . $update['Name'] . "' ";
       $sqli2 .= "WHERE Vendor_name='". $fetch['Name'] ."' ";
       $mysql2= mysqli_query($db, $sqli2);
       }

    $sql = "UPDATE " . $table . " ";
    $sql .= "set Name ='" . $update['Name'] . "', ";
    $sql .= "contact ='" . $update['contact'] . "' ";
    $sql .= "WHERE Id ='" . $update['Id'] . "' ";


    $result = mysqli_query($db, $sql);
    return header("Location: ../public/" . strip_tags($table) . ".php");
    }else if($table == 'product'){

      
       $data = select_all($table);
       $fetch =  mysqli_fetch_assoc($data);
       $sqli = "UPDATE purchase_products Set Product_Name = '" . $update['Name'] . "', ";
       $sqli .= " Purchase_Price='" . $update['updatePrice'] . "' ";
       $sqli .= "WHERE vendor='". $fetch['Product_Name'] . "' ";
       $mysql= mysqli_query($db, $sqli);

       $sqli2 = "UPDATE invoices Set Product_Name = '" . $update['Name'] . "', ";
       $sqli2 .= " Product_Sales_Price='" . $update['updatesales'] . "', ";
       $sqli2 .= "Total = Product_Sales_Price * Sales_Stock";
       $mysql2= mysqli_query($db, $sqli2);
       

    $sql = "UPDATE " . $table . " ";
    $sql .= "set Product_Name ='" . $update['Name'] . "', ";
    $sql .= "Product_Price ='" . $update['updatePrice'] . "', ";
    $sql .= "Product_Sales_Price ='" . $update['updatesales'] . "', ";
    $sql .= "category ='" . $update['category'] . "' ";
    $sql .= "WHERE Id ='" . $update['Id'] . "' ";
    $result = mysqli_query($db, $sql);
    // return header("Location: ../public/" . strip_tags($table) . ".php");
    }else if($table == 'customerbook'){
      $sql = "UPDATE customerbook ";
      $sql .= "SET Purchase_amount =";
      $sql .= "'" . $update['Purchase_amount'] . "',";
      $sql .= " Customer_Paid='" . $update['Customer_Paid'] . "', ";
      $sql .=  " Your_payment_to_the_customer='" . checkUnpaid($update['Customer_Paid'],$update['Purchase_amount']) . "', ";
      $sql .= " Customer_Unpaid='" . checkUnpaid($update['Purchase_amount'],$update['Customer_Paid']) . "' ";
      $sql .= "WHERE Id ='" . $update['Id'] . "' ";
      $query = mysqli_query($db, $sql);
       return header("Location: ../public/" . strip_tags($table) . ".php");
    }else if($table == 'vendorbook'){
      $sql = "UPDATE ". $table ." ";
      $sql .= "SET Purchase_amount =";
      $sql .= "'" . $update['Purchase_amount'] . "',";
      $sql .= " Payment_done='" . $update['Payment_done'] . "', ";
      $sql .=  " Pay_to_receive='" . checkUnpaid($update['Payment_done'],$update['Purchase_amount']) . "', ";
      $sql .= " Unpaid_amount='" . checkUnpaid($update['Purchase_amount'],$update['Payment_done']) . "' ";
      $sql .= "WHERE Id ='" . $update['Id'] . "' ";
      $query = mysqli_query($db, $sql);
       return header("Location: ../public/" . strip_tags($table) . ".php");    
    }
 }

function checkUnpaid($value1, $value2){
   if($value1 > $value2){
     return $value1 - $value2;
   }else if($value1 <= $value2){
     return 0;
   }
}

function updata_data_invoices($table, $data){
  global $db;
   $sql = "UPDATE " .$table . " ";
   $sql .= "set Invoice_NO ='" . $data['Invoice_NO'] . "', ";
   $sql .= "Customer_Name ='" . $data['Customer_Name'] . "', ";
   $sql .= "Date ='" . $data['Date'] . "' ";
   $sql .= "WHERE Id ='" . $data['Id'] . "' ";
   $result3 = mysqli_query($db, $sql);
   $sql2 = "UPDATE invoices ";
   $sql2 .= " set ";
   $sql2 .= " Invoice_NO ='" . $data['Invoice_NO'] . "', ";
   $sql2 .= " Date='" . $data['Date'] . "' ";
   $sql2 .= "WHERE Invoice_NO ='" . $data['Invoice_NO'] . "' ";
   $result2 = mysqli_query($db, $sql2);
   $sql3 = "UPDATE customerbook ";
   $sql3 .= " set ";
   $sql3 .= " Invoice_NO ='" . $data['Invoice_NO'] . "', ";
   $sql3 .= " Date='" . $data['Date'] . "' ";
   $sql3 .= "WHERE Invoice_NO ='" . $data['Invoice_NO'] . "' ";
   $result3 = mysqli_query($db, $sql3);
    return header("Location: ../public/" . 'invoice_lists' . ".php");    
}

function updata_data_product_stock($table, $data){
  global $db;
   if(is_numeric($data['returnstock'])){

   $sql = "UPDATE " .$table. " ";
    $newsql  = check_product_exist_to_update($data['product']);
    $fetch = mysqli_fetch_assoc($newsql);
     $totalstock = $fetch['Prodcut_Stock'] + $data['returnstock'];
   $sql .= "set Prodcut_Stock='" . $totalstock  . "' ";
   $sql .= "WHERE Product_Name='" . $data['product'] . "' ";
     $result = mysqli_query($db, $sql);
      if(mysqli_report($result) >= 1)
       return true;
     }else{
       return false;
     }
    
}

function updata_data_purchase_stock($table, $data){
  global $db;
   if(is_numeric($data['Purchasereturn'])){

   $sql = "UPDATE " .$table. " ";
    $newsql  = check_product_exist_to_update($data['product']);
    $fetch = mysqli_fetch_assoc($newsql);
     $totalstock = $fetch['Prodcut_Stock'] - $data['Purchasereturn'];
   $sql .= "set Prodcut_Stock='" . $totalstock  . "' ";
   $sql .= "WHERE Product_Name='" . $data['product'] . "' ";
     $result = mysqli_query($db, $sql);
      if(mysqli_report($result) >= 1)
       return true;
     }else{
       return false;
     }
    
}
function updata_data_stock_invoice($table, $data){
  global $db;
    $result = check_product_exist_to_update($data['Product_Name']);
    $fetch = mysqli_fetch_assoc($result);
    $sql = "UPDATE product ";
    $sql .= "SET Prodcut_Stock ='". stockplus($data['Sales_Stock'],$fetch['Prodcut_Stock']) .  "' ";
    $sql .= "WHERE Product_Name ='" . $data['Product_Name'] . "' ";
        $query = mysqli_query($db, $sql);
    $result2 = check_product_exist_to_update($data['Product_Name']);
    $fetch2 = mysqli_fetch_assoc($result2);
    if($data['Sales_Stock'] <= $fetch2['Prodcut_Stock']){
    $sql2 = "UPDATE invoices ";
    $sql2 .= "SET Sales_Stock='". strip_tags($data['Sales_Stock']) .  "' ";
    $sql2 .= "WHERE Id='" . $data['Id'] . "' ";
        $query2 = mysqli_query($db, $sql2);
    $sql3 = "UPDATE product ";
    $sql3 .= "SET Prodcut_Stock ='". substric($fetch['Prodcut_Stock'],$data['Sales_Stock']) .  "' ";
    $sql3 .= "WHERE Product_Name='" . $data['Product_Name'] . "' ";
        $query3 = mysqli_query($db, $sql3);
    }else{
      echo "<script>alert('low stock')</script>";
    }
}
function stockplus($value1, $value2){
  return $value1 + $value2;
}