<?php 
include 'include/includedatabase.php';
if(isset($_GET['a_id']) && !empty($_GET['a_id'])){
    $a_id = $_GET['a_id'];
    sleep(2); // Simulating delay for demonstration

    $query = $pdo->prepare("SELECT user.name, artical.title, artical.description, categories.c_name,artical.submited
        FROM jun_art_cat 
        LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id 
        LEFT JOIN categories ON categories.c_cid = jun_art_cat.c_id 
        LEFT JOIN user ON artical.u_id = user.u_id 
        WHERE artical.a_id = :a_id
    ");
    $query->execute([
        ':a_id' => $a_id,
    ]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    header("Content-Type: application/json");
    echo json_encode($result);
}


    

?>
