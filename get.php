<?php 
include 'include/includedatabase.php';

//this query is also correct but not sequare
// $query = $pdo->query("select * from categories where c_cid =". $_GET["categor_id"]);
// so for this purpose we use prepared function and more sequare then the  above query here we use the insted of $_GET["categor_id"] here we use the placeholder of that get.

$query = $pdo->prepare("select * from categories where c_cid =:cid");
// so  here we use the Get id  in exection;
$query->execute([':cid' => $_GET["categor_id"]]);

$result = $query->fetchAll(PDO::FETCH_ASSOC); 



if(count($result)> 0){
    print "<ul>";

    foreach($result as $res){
        echo '</li>' .$res['c_cid']. ' ' .$res['c_name']. '</li>';
    }

    print "</ul>";
}

