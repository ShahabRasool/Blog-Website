<?php
$search='';

 if(isset($_GET['ussearch'])){
    if(!empty($_GET['ussearch'])){
    $search = $_GET['ussearch'] ?? "";
    $query=$pdo->prepare("SELECT * FROM user WHERE name like :match ");
    $param =[
        ":match" => "%". $search ."%"
    ];
    print_r($param);
    $query->execute($param);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($result);
    die();
}
 }
 ?>
 <div>
    <form action="maintamplete.php" >
        <input type="text" name="ussearch">
        <input type="hidden" name="page" value="usesearch">
        <input type="submit" value="search" >
    </form>
</div>
<?php if (!empty($result)): ?>
  
            <?php echo $user['name']; ?>
     

    <?php endif ?>