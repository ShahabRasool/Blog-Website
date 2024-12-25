<?php   
include 'categories.php';
if(isset($_GET['c_id']) && is_numeric($_GET['c_id'])){
    $cid= $_GET['c_id'];
}else{
    echo '<h1 class="text-center m-6 text-2xl font-bold"> Click the above  categories  link</h1>';
  echo   '<div class="bg-white shadow-md rounded-lg p-6 mb-6 md:mb-8 lg:mb-10">' .
  '<h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3">Show business Update</h1>' .
  '<p class="text-gray-600">Update WWE superstar and veteran wrestler John Cena, who recently attended Ananat Ambani\'s wedding, has revealed that Bollywood megastar Shah Rukh Khan has had a positive effect on his life. "An experience filled with so many unforgettable moments which allowed me to connect with countless new friends, including meeting @iamsrk and being able to tell him personally the positive effect he has had on my life," Cena wrote in a post on X. The veteran wrestler recently visited Mumbai for the star-studded wedding and ended up brushing shoulders with Khan at the extravagant celebration and expressed his gratitude to the Ambani family for "surreal 24 hours" coupled with "unmatched warmth and hospitality".</p>' .
  '</div>';

                        die();
}
$query=$pdo->prepare("SELECT  artical.title, artical.description, categories.c_name
            FROM jun_art_cat LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id LEFT JOIN 
          categories ON categories.c_cid = jun_art_cat.c_id where jun_art_cat.c_id=:c_id");
                $query->execute([":c_id"=> $cid]);
            $record = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($record) > 0) {
                echo '<div class="container mx-auto px-4 py-6">';
                foreach ($record as $article) {
                    echo '<div class="bg-white shadow-md rounded-lg p-6 mb-6 md:mb-8 lg:mb-10">'.
                        '<h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-3">'.
                        $article['title'].
                        '</h1>'.
                        '<p class="text-gray-600">'.
                        $article['description'].
                        '</p>'.
                        '</div>';
                }
                echo '</div>';
            } else {
                echo '<div class="container mx-auto px-4 py-6 text-center text-gray-500">No articles found</div>';
            }
            
     ?>
