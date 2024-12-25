<?php 
// step 1
// $string= "Welcome to bilal khan area";
// preg_match('/welcome/i',$string,$matches);
// print_r($matches);
// step 2
$string = "Welcome to bilal khan area from zangli Area";
$exp = preg_match_all('/Khan/',$string);
if($exp){
    echo "area found";
}else{
    echo "area not found";
}
?>