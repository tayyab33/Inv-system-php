<?php 
include_once('database-setting/database.php');
$Id = $_GET['id'] ?? '';
$table = $_GET['tb'] ?? '';
$tb = $_GET['table'] ?? '';
$tbo = $_GET['tablei'] ?? '';
  function check_customer_exist(){
  	global $db;
  	global $Id;
  	global $table;
  	  $sql = "DELETE FROM " . $table . " ";
  	  $sql .= "WHERE Id='" . strip_tags($Id) . "' ";
   	  $result = mysqli_query($db, $sql);
      if($table == 'invoices'){
        $find = substr($table,0,7);
        $toup =  ucfirst($find);
        $table = $toup . "_" . 'lists';
      }
       if($table == 'purchase_products'){
        header('Location: ../public/purchase_stock.php');
        exit();
      }
  	  header('Location: ../public/'. strip_tags($table) . '.php');
  }
if((int)$Id > 0 && $table != ''){
  check_customer_exist();

}
if((int)$Id > 0 && $tb != ''){
    delete_all_invoices();
}
if((int)$Id > 0 && $tbo != ''){
    delete_all_purchase();
}
  function delete_all_invoices(){
    global $db;
    global $Id;
    global $tb;
      $sql = "DELETE FROM " . $tb . " ";
      $sql .= "WHERE Invoice_NO ='" . strip_tags($Id) . "' ";
      $result = mysqli_query($db, $sql);
      $sql2 = "DELETE FROM invoices ";
      $sql2 .= "WHERE Invoice_NO ='" . strip_tags($Id) . "' ";
      $result2 = mysqli_query($db, $sql2);
      $sql3 = "DELETE FROM customerbook ";
      $sql3 .= "WHERE Invoice_NO ='" . strip_tags($Id) . "' ";
      $result3 = mysqli_query($db, $sql2);
       if($table == 'purchase_products'){
        header('Location: ../public/purchase_stock.php');
      }
      header('Location: ../public/'. 'Invoice_lists' . '.php');
  }
function delete_all_purchase(){
     global $db;
    global $Id;
    global $tbo;
      $sql = "DELETE FROM " . $tb . " ";
      $sql .= "WHERE vendor ='" . strip_tags($Id) . "' ";
      $result = mysqli_query($db, $sql);
      header('Location: ../public/'. 'Invoice_lists' . '.php');
}

?>