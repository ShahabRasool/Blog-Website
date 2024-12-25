<?php 
include 'include/includedatabase.php';
session_start();
include "function.php";
if (isset($_SESSION['linkedin'])) {
  $linkedinUrl = $_SESSION['linkedin'];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="10"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./output.css">
    <title>Main Templete</title>
</head>
<body>
    <?php include 'include/header.php' ;?>
    <?php if(isset($_GET['page'])): ?>

      <?php include $_GET['page']. ".php"; ?>
    <?php endif;?>

    <?php if(!isset($_GET['page'])): ?>
      <?php include 'include/section.php'; ?>
      <?php endif ?>
      <!-- I want to sent the all detail through join to show non- user see the article -->
     
    <?php include './include/footer.php' ;?>
  
</body >
</html>