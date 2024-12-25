<?php 
 function displaynumber($n){
    if($n > 0){
        echo '<h1 class="text-red-700">'.$n. ''.'<br>'.'</h1>';
        displaynumber($n-1);
    }
   
 }

displaynumber(5);
// so we will close the funtion in the condition because if we can't close it it will give infinite number of numbers

// array_key_exists()
// array_key_exists() is a function in PHP that checks if a key exists in an array.
// It returns true if the key exists, and false otherwise.
// It is case sensitive.
// It can be used with both numeric and associative arrays.
// It can be used with multidimensional arrays.
// It can be used with arrays that have been created using the array() function.
// It can be used with arrays that have been created using the [] operator.

$array = [
    'first' => 1,
    'second' => 2,
    'third' => 3
];

if (array_key_exists('second', $array)) {
    echo '<h2 class="text-red-500">' . 'Key ' . ' second' . ' exists in the array' . '</h2>';}
     else {
    echo "Key 'second' does not exist in the array.";
}
?>
