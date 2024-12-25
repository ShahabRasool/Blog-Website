<?php 
$title = '';
$description = '';
$submit = time();
$artid = $_GET['a_id'] ?? null;

// Check if artid is set 
if ($artid) {
    $query = $pdo->prepare("SELECT * FROM artical WHERE a_id = :a_id");
    $query->execute([':a_id' => $artid]);
    $record = $query->fetch(PDO::FETCH_ASSOC);

    if ($record) {
        $title = $record['title'];
        $description = $record['description'];
    }
}

$error = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'])) {
        if ($_POST['title'] == "") {
            $error[] = "Please edit your title.";
        } 
            $title = $_POST['title'];
        
    }

    if (isset($_POST['description'])) {
        if ($_POST['description'] == "") {
            $error[] = "Please edit your description.";
        } 
            $description = $_POST['description'];
        
    }

    if (empty($error)) {
        $update = $pdo->prepare("UPDATE artical SET title = :title, description = :description WHERE a_id = :a_id");
        $params = [
            ':title' => $title,
            ':description' => $description,
            ':a_id' => $artid
        ];
        if ($update->execute($params)) {
            echo '<h1 class="text-2xl text-green-500 text-center mt-4">Article updated successfully...</h1>';
        } else {
            echo "Failed to update article.";
        }
    }
}
?>

<form action="maintamplete.php?page=edit-article&a_id=<?php echo $artid ?>" method="post" class="max-w-md mx-auto p-6 rounded-lg shadow-md hover:outline-blue-400 outline mt-[20px]">
    <h1 class="text-2xl font-semibold mb-4 text-center text-cyan-700">Edit Your Article</h1>
    <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"><?php echo htmlspecialchars($description); ?></textarea>
    </div>
    <button type="submit" name="submit" class="bg-cyan-700 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update</button>
</form>
