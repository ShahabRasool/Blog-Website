<?php
$u_id=$_SESSION['u_id'];
$query = $pdo->prepare("SELECT * FROM image WHERE u_id = :u_id");
$query->execute(['u_id' => $u_id]); 
$image = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="grid grid-cols-4  gap-2 border-2">
    <?php foreach($image as $uplo): ?>
        <?php $imagurl = 'upload-image/' . $uplo['file_name']; ?>
        <img src="<?php echo $imagurl; ?>" class="h-full object-cover rounded-md">
    <?php endforeach; ?>
</div>

