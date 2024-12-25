<?php 
// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$charset = 'utf8';
$port = '3306';
$dbName = 'blog';

// Data Source Name (DSN) for PDO
$dsn = "mysql:host=$host;dbname=$dbName;charset=$charset";

// Create a new PDO instance

    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Execute the query
    $query = $pdo->query("SELECT * FROM categories");

    // Fetch all results as an associative array
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
?>


    <div class="container mx-auto">
        <!-- <h1 class="text-3xl font-bold mb-6">Blog Categories</h1> -->

        <div class="bg-blue-400 w-full  ">
            <?php if (count($result) > 0): ?>
                <ul class="flex flex-wrap gap-6 pl-40">
                    <?php foreach ($result as $record): ?>
                        <li>
                            <a href="maintamplete.php?page=articleincategories&c_id=<?= htmlspecialchars($record['c_cid']) ?>"
                               class="block text-xl text-white px-2 py-1  hover:bg-blue-400 hover:underline">
                                <?= htmlspecialchars($record['c_name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No categories found.</p>
            <?php endif; ?>
        </div>
                
       
    </div>
               

