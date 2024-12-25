<?php 
include 'include/includedatabase.php';
if(isset($_POST['searchtitle'])){
    $search = $_POST['searchtitle'] ?? "";
    
    $query = $pdo->prepare("SELECT * FROM artical WHERE title LIKE :match");
    $param = [":match" => "%" . $search . "%"];
    $query->execute($param);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    $cat=[];
}
?>

    <?php if(isset($result) && !empty($result)):?>
<div>
<ul class="w-64">
    <?php foreach($result as $index => $record): ?>
        <?php if($index < 5): ?>
            <li class=" px-2">
    <a class="text-lg p-3 text-gray-800 block hover:underline" href="maintamplete.php?page=dashboard&add=artical&a_id=<?= $record['a_id'] ?>">
        <?= htmlspecialchars($record['title']) ?>
    </a>
</li>

            
        <?php endif; ?>
    <?php endforeach; ?>
</ul>

</div>
<?php endif ?>