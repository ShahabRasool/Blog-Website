<?php   
function  isloggedin(){
  return  isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"];
}