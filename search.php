<?php
$search = '';

if(isset($_POST['search'])){
    $search = $_POST['search'] ?? "";
    $query = $pdo->prepare("SELECT * FROM artical WHERE title LIKE :match OR description LIKE :match");
    $param = [":match" => "%" . $search . "%"];
    $query->execute($param);
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    // this will find the total row
    $total_row = $query->rowCount();
}
?>
 

<?php if(!empty($result)): ?>
    <p class="text-[25px]  font-medium text-pink-800 py-4">Your search result returend  <?= $total_row ?> records</p>
    <?php foreach ($result as $results): ?> 
        <div class="text-center py-4">
            <?php
            // Highlight the search term in the title
            echo '<h2 class="text-4xl text-white">' . str_ireplace($search, '<strong class="text-green-400">' . htmlspecialchars($search) . '</strong>', htmlspecialchars($results['title'])) . '</h2>';           
             ?>
        </div>
        <div class="text-center py-4">
            <?php 
            // substing is used for string which the actual description like  the other is start and the length
            // $excerpt = substr($results['description'], 0, 200);

            
            // Highlight the search term in the description
            $highlightedDescription = str_ireplace($search, '<strong class="text-green-400  ">' . htmlspecialchars($search) . '</strong>', htmlspecialchars($results['description']));
            echo '<p class="text-white">' . $highlightedDescription . '</p>';            ?>
            <!-- <a class="block text-green-300" href="maintamplete.php?page=artical&a_id=<?php  //echo $results['a_id']; ?>">Read more...</a> -->

        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No results found</p>
<?php endif; ?>
