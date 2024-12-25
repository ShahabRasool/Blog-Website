<?php 
// creates a session or resumes the current one based on a session identifier passed via a GET or POST request, or passed via a cookie.
// when ever we use session we must use in the start session  and we decleared it as a variable 
session_start();
// we can use session variable to store data

$_SESSION['username']='Shahab Rasol';
