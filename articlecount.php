<?php 

$error = [];

// Fetch categories with article counts from junction
$query = $pdo->prepare("SELECT categories.c_cid, categories.c_name, COUNT(artical.a_id) as article_count 
    FROM jun_art_cat LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id 
    LEFT JOIN categories ON categories.c_cid = jun_art_cat.c_id 
    GROUP BY categories.c_cid, categories.c_name");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

// print '<pre>';
// print_r($result);
// print '</pre>';

$article = [];
// from article where the categories is in 
if (isset($_GET['c_id'])) {
    $id = $_GET['c_id'];
    $files = $pdo->prepare("SELECT artical.title, artical.description FROM jun_art_cat LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id  WHERE jun_art_cat.c_id = :cid");
    
    $files->execute([':cid' => $id]);
    $article = $files->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-md p-4 w-1/4 float-left mr-6">
        <h2 class="text-2xl font-semibold border-b-2 border-gray-300 pb-2 mb-4">Categories</h2>
        <ul>
            <?php foreach ($result as $record): ?>
                <li class="mb-3 ">
                    <a href="maintamplete.php?page=articlecount&c_id=<?php echo $record['c_cid']; ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                        <?php echo $record['c_name']; ?> <span class="text-gray-600"> (<?php echo $record['article_count']; ?>)</span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="w-2/4 float-left">
        <h2 class="text-2xl font-semibold mb-6">Articles</h2>
        <?php if (empty($article)): ?>
            <p class="text-gray-700">Click on the link </p>
        <?php else: ?>
            <?php foreach ($article as $articls): ?>
                <div class="bg-white rounded-lg shadow-md p-6 mb-6 hover:bg-blue-100 transition duration-300">
                    <h3 class="text-xl font-semibold mb-2"><?php echo $articls['title']; ?></h3>
                    <p class="text-gray-700"><?php echo $articls['description']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="clear-both"></div>
</div>