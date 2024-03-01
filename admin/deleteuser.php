<?php
 include_once('includes/loginchecker.php');
  include_once('includes/conn.php');
 if(isset($_GET['id'])){
  try{
    $sql="DELETE FROM `users` WHERE `id`=?";
    $id=$_GET['id'];
    $stmt=$conn->prepare($sql);
    $stmt->execute([$id]);
    header('location:users.php');
   
  }catch(PDOEXCEPTION $e){
    echo $e->getMessage();
  }
}else{
  echo "error";
}