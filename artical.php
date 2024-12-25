<?php 
require ('./include/includedatabase.php');
if (isloggedin()) { 
    $query = $pdo->query("select * from artical");
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php include 'categories.php'; ?>
    
    <div class="container mx-auto p-4 flex gap-5">
        <div class="flex gap-6 w-full">
            <div class="bg-gray-800 hover:outline-white hover:outline rounded-lg shadow-md p-5 w-[25%]">
                <?php 
                if (count($results) > 0) {
                 echo '<ul class="space-y-2">';
?>
                 <?php foreach ($results as $record): ?>
                    <li class="p-1">
                      <a data-aid="<?= $record['a_id']; ?>" class="text-blue-500 ajexlink hover:underline" href="maintamplete.php?page=dashboard&add=artical&a_id=<?= $record['a_id']; ?>">
                       <?= $record['a_id']; ?> - <?= $record['title']; ?>
                      </a> 
                      <a class="text-gray-400 hover:text-white ml-2" href="maintamplete.php?page=edit-article&a_id=<?= $record['a_id']; ?>">
                       Edit-Article
                      </a>
            </li>
                 <?php endforeach; ?>
                 <?php
                 echo '</ul>';
                }
                ?>
            </div>
            <div class="bg-gray-800 text-white p-5 w-[50%] rounded-lg shadow-md">
                
                <?php 
                if (isset($_GET['a_id'])) {
                    $aid = $_GET['a_id'];
                    $query = $pdo->prepare("SELECT categories.c_cid, user.name, artical.submited, categories.c_name, artical.title, artical.a_id, artical.description FROM jun_art_cat LEFT JOIN artical ON artical.a_id = jun_art_cat.a_id LEFT JOIN categories ON categories.c_cid = jun_art_cat.c_id 
                    LEFT JOIN user on user.u_id=artical.u_id
                    WHERE artical.a_id = :articleid");
                    $query->execute([":articleid" => $aid]);
                    $art = $query->fetchAll(PDO::FETCH_ASSOC);

                    
                    $cat = [];
                    foreach ($art as $article) {
                        $cat[] = '<a class="text-lg p-3 text-blue-500 hover:underline" href="maintamplete.php?page=articleincategories&c_id=' . $article['c_cid'] . '">' . $article['c_name'] . '</a>';
                    } 
                    ?>
                  
                    
               <?php
                    echo '<h1 class="text-2xl py-4 font-bold">This Categories fall in</h1>';
                    echo '<div class="space-x-2">'.implode(" ", $cat).'</div>';

                }
                ?>
                <div>
                <div class="root"></div>
                    <?php include 'like.php'; ?>
            </div> 
    </div> 
    <!-- >
                 else {
                    echo '<div class="text-center">';
                    echo '<h1 class="text-3xl font-bold mb-4">Build Web Applications with HTML 5</h1>';
                    echo '<p class="text-lg leading-relaxed mb-4 text-gray-400">Many new features and standards have emerged as part of HTML 5. While most of the modern browsers support these features, some browsers may not support all the features. In this article, we will learn how to detect if an HTML5 feature is supported by a browser. We will also create sample applications using these features. We will use core web technologies like HTML, CSS, and JavaScript for these examples.</p>';
                    echo '<ul class="list-disc list-inside ml-4 text-gray-400">';
                    echo '<li class="mb-2">Getting started</li>';
                    echo '<li class="mb-2">Detecting capabilities</li>';
                    echo '</ul>';
                    echo '</div>';
                }
                ?> -->
           
            <div class="mt-10 w-[20%]">
                <button class=" btn1 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Show your Comment
                </button>
                <div class="comment hidden mt-4"><?php include 'comment.php'; ?></div>
            </div>
        </div>
        <script src="./ajex.js"></script>
        <script src="./com.js"></script>
    </div>
<?php 
} else { 
?>
<div class="flex flex-wrap gap-5 p-3">
    <h1 class="w-full p-4 text-center text-2xl font-bold">This is Public Articles</h1>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">Health Education</h2>
        <p class="text-gray-700">
            Health education is a profession of educating people about health. Areas within this profession encompass environmental health, physical health, social health, emotional health, intellectual health, and spiritual health, as well as sexual and reproductive health education.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">Food Systems Reads that Will Inspire You this Summer</h2>
        <p class="text-gray-700">
        Discover a handpicked selection of inspiring summer reads that offer fresh perspectives on sustainability, agriculture, and the future of food systems.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">Bangladesh government declares two ‘public holidays’ citing situation in country, curfew in place</h2>
        <p class="text-gray-700">
        Prime Minister Sheikh Hasina’s government declared Sunday and Monday as “public holidays” due to the situation in the country, with only emergency services allowed to operate. Bangladesh soldiers patrolled Dhaka’s deserted streets on Saturday amid a curfew to quell deadly student-led protests against government job quotas that have killed more than 100 people this week.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">LHC to hear Imran’s petition against ATC’s 10-day physical remand decision in May 9 cases</h2>
        <p class="text-gray-700">
        The hearing on Monday will be presided over by a bench comprising Justice Tariq Saleem Sheikh and Justice Anwaarul Haq.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">PCB declines Babar, Rizwan and Shaheen NOCs for Global T20</h2>
        <p class="text-gray-700">
        LAHORE: The Pakistan Cricket Board (PCB) has declined Babar Azam, Mohammad Rizwan and Shaheen Shah Afridi’s respective requests for NOC’s to participate in the Global T20 — a franchise tournament to be played in Canada this month.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">Imran, opposition demand judicial inquiry as KP govt announces commission on Bannu violence</h2>
        <p class="text-gray-700">
        Incarcerated former prime minister Imran Khan and a six-party opposition alliance on Saturday called for a judicial inquiry into the outbreak of violence at a peace rally in Bannu a day earlier even as the Khyber Pakhtunkhwa government announced the formation of a commission for a “transparent” investigation.
        </p>
    </div>
    
    <div class="p-4 bg-white shadow-md rounded-lg flex-1 min-w-[300px]">
        <h2 class="text-xl font-semibold mb-2">Residents stage sit-in</h2>
        <p class="text-gray-700">
        Separately, residents staged a sit-in outside the Bannu Police Line Chowk — located opposite the main entrance of the cantonment — to press the government to investigate the firing incident.
        </p>
    </div>
    
   
</div>


<?php 
} 
?>