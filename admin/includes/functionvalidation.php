<?php
// $passwordy=$_POST['password'];
// function checkpasswordstregnth($passwordy){
//     $lowercase=preg_match('@[a-z]@',$passwordy);
//     $uppercase=preg_match('@[A-Z]@',$passwordy);
//     $number=preg_match('@[0-9]@',$passwordy);
//     $minlenght=5;
//     $error="<span style='color:red'>X</span>";
//     if($lowercas && $uppercase && $number && $minlenght>=5){
//         return true;
//     }else{
//         return false;
//     }
// }
function passwordvalidation($itemname){
    $status=true;
    if(strlen($itemname)>3){
        return false;
    }
}
?>