<?php 
function outputarry($array, $class){
    if(count($array) > 0){
        print '<ul class=" ' . $class .' ">';
        foreach($array as $arryelement){
            print '<li>' . $arryelement . '</li>';
        }
        print '</ul>';
}
};