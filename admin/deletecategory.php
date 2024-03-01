<?php
 include_once('includes/loginchecker.php');
  include_once('includes/conn.php');
 if(isset($_GET['id']) and $_GET['id']>0){
  try{
    $sql="DELETE FROM `tags` WHERE id=?";
    $id=$_GET['id'];
    $stmt=$conn->prepare($sql);
    $stmt->execute([$id]);
    header('location:categories.php');
   
  }catch(PDOEXCEPTION $e){
    echo $e->getMessage();
  }
}else{
  echo "error";
}