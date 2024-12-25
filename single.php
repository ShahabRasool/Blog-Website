<?php 
include 'include/includedatabase.php';
if(isset($_GET['a_id']) && !empty(isset($_GET['a_id']))){
    $a_id = $_GET['a_id'];
    sleep(2);
    $query=$pdo->prepare("SELECT artical.*, user.name FROM `artical` left JOIN user on artical.a_id=user.u_id
   WHERE artical.a_id = :a_id");
    $query->execute([
        ':a_id'=>$a_id,
    ]);
    $result=$query->fetch(PDO::FETCH_ASSOC);
        header("content-type: application/json");
    print json_encode($result);

    
}
?>