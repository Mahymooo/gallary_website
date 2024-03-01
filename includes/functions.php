<?php

function validatepage($page,$pagenumber){
    if($page >=1 and $page <=$pagenumber){
        return true;
    }else{
        return false;
    }
}
if(! validatepage($page,$pagenumber)){
    header('location:index.php');
}
?>