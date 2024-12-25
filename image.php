<?php 
$user_id = $_SESSION['u_id'];
$date = time();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allowed_types = ['image/jpeg', 'image/png'];
    $errors = [];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $path_upload = 'upload-image/';
    $final_file = $path_upload . $file_name;

    // Check if file type is allowed
    if (!in_array($file_type, $allowed_types)) {
        $errors[] = "This type of file is not allowed";
    }

    if (count($errors) == 0) {
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $file_name);
        $i = 1;
        while (file_exists($final_file)) {
            $current_file = pathinfo($file_name, PATHINFO_FILENAME) . "_" . $i . "." . $ext;
            $final_file = $path_upload . $current_file;
            $i++;
        }

        move_uploaded_file($file_tmp, $final_file);

        $image = $pdo->prepare("INSERT INTO image (file_name, date, u_id) VALUES (:file_name, :date, :u_id)");
        $param = [
            ':file_name' => basename($final_file),
            ':date' => $date,
            ':u_id' => $user_id
        ];
        $image->execute($param);

        // Display the uploaded image
        echo '<div class="flex items-center">';
        echo '<img src="' . $final_file . '" class="w-32 h-32 rounded-full object-cover shadow-lg">';
        echo '</div>';
    }
}

if (isset($errors) && count($errors) > 0) {
    foreach ($errors as $err) {
        echo htmlspecialchars($err) . "<br>";
    }
}


?>

<div class="flex items-center justify-center space-x-4">
    <div class="w-1/3">
        <form action="maintamplete.php?page=dashboard&add=image" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg space-y-4">
            <div class="flex flex-col space-y-2">
                <label for="image" class="text-gray-700 font-semibold">Upload Image</label>
                <input class="border-2 border-green-300 rounded-lg p-2 focus:border-green-500 focus:outline-none" type="file" name="image" id="image">
            </div>
            <div class="flex justify-end">
                <input class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg cursor-pointer hover:bg-green-600 transition duration-300 ease-in-out" type="submit" value="Submit">
            </div>
        </form>
    </div>
    </div>


