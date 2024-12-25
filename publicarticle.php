<div class="bg-white  rounded-lg p-6 w-1/2">
<h1 class="text-2xl font-bold mb-4 bg-blue-400 text-center">Public Article</h1>
<ul class="space-y-4">
    <?php 
    if (isset($_GET['a_id'])) {
        $id = $_GET['a_id'];
    }
    $query = $pdo->query("SELECT jun_art_cat.id, artical.a_id, artical.title 
                          FROM jun_art_cat 
                          LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id 
                          WHERE jun_art_cat.id IN (7, 8, 10, 11, 12, 13, 14, 15, 16, 17)");
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo '<li class="text-blue-600 hover:underline">' . '<a href="maintamplete.php?a_id=' . $record['a_id'] . '">'  . $record['id'] .'-' . $record['title'] . '</a>' . '</li>';
    }
    ?>     
</ul>
</div>

<div class="bg-white  rounded-lg p-6 w-1/2 hover:bg-purple-100 transition duration-300">
<h1 class="text-2xl font-bold mb-4 bg-blue-400 text-center">Articles</h1>
<ul class="space-y-4">
    <?php 
    if (isset($_GET['a_id'])) {
        $article = $_GET['a_id'];
        $result = $pdo->query("SELECT artical.title, artical.description 
                               FROM jun_art_cat 
                               LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id 
                               WHERE jun_art_cat.id IN (7, 8, 10, 11, 12, 13, 14, 15, 16, 17) 
                               AND artical.a_id = $article");
        $showarticle = $result->fetch(PDO::FETCH_ASSOC);
        if ($showarticle) {
            echo '<h1 class="text-xl font-bold mb-2">' . $showarticle['title'] . '</h1>';          
            echo '<p class="text-gray-700">' . $showarticle['description'] . '</p>';
        }
    } else {
        echo '<h1 class="text-[30px] font-normal mb-2">Technology is the application of conceptual knowledge</h1>';
        echo '<p class="pb-2">To achieve practical goals, especially in a reproducible way. The word technology can also mean the products resulting from such efforts, including both tangible tools such as utensils or machines, and intangible ones such as software.</p>';
    }
    ?> 
</ul>
</div>
