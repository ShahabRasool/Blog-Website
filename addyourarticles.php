<?php 
    require './include/function.php';
    require 'include/includedatabase.php';

    if(!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]){
        header ("Location: maintamplete.php?page=login");
        exit;
    }

    $title = '';
    $description = '';
    $status = '';
    $submited = time();
    $u_id = $_SESSION["u_id"] ?? null;
    $categories = [];

    // data coming from data base here
    $index = $pdo->query('SELECT * FROM categories');
    $recorded = $index->fetchAll(PDO::FETCH_ASSOC);
    // end of code
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["title"])){
            $title = trim($_POST["title"]);
            if(empty($title)){
                $errors[] = "Title is required";
            }
        }
        if(isset($_POST["description"])){
            $description = trim($_POST["description"]);
            if(empty($description)){
                $errors[] = "Description is required";
            }
        }

        if(isset($_POST["categories"])){
            $categories = $_POST["categories"];
            if(empty($categories)){
                $errors[] = "At least one category is required";
            }
        }
        if(isset($_POST["status"])){
            $status = trim($_POST["status"]);
            if(empty($status)){
                $errors[] = "Status is required";
            }
        }

        $insert = count($errors) == 0;

        if($insert){
            
                $query = $pdo->prepare("insert into artical (title, description, status, submited, u_id) VALUES (:title, :description, :status, :submited, :u_id)");
                $params = [
                    ":title" => $title,
                    ":description" => $description,
                    ":status" => $status,
                    ":submited" => $submited,
                    ":u_id" => $u_id,
                ];
                $query->execute($params); 
                $lastid = $pdo->lastInsertId();

                if(count($categories) > 0){
                    foreach($categories as $cat){
                        $st = $pdo->prepare("INSERT INTO jun_art_cat (a_id, c_id) VALUES (:a_id, :c_id)");
                        $cat_params = [
                            ":a_id" => $lastid,
                            ":c_id" => $cat,
                        ];
                        $st->execute($cat_params);
                    }
                }

                header("Location: maintamplete.php?page=artical&a_id=".$lastid);
                exit;

        }
    }

    outputarry($errors, "text-red-800");
?>

<form action="maintamplete.php?page=addyourarticles" method="post" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-4">Article Form</h1>
    <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input type="text" name="title" value="<?php echo $title; ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea name="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"><?php echo $description; ?></textarea>
    </div>
    <div class=" mb-4 ">
        <label for="categories" id="my-input" data-dropdown="true" data-tags="true" class="block text-gray-700">Categories</label>
        <select name="categories[]" id="multiple-select"  multiple class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <option class="" value="">Please select the categories</option>
            <?php foreach($recorded as $ndx) :?>
                <option value="<?php echo $ndx['c_cid']; ?>"><?php echo $ndx['c_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-4">
        <label for="status" class="block text-gray-700">Status</label>
        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
            <option value="">Please select</option>
            <option value="1" <?php if($status==1){echo 'selected';}?>>Published</option>
            <option value="0" <?php if($status===0){echo 'selected';}?>>Unpublished</option>
        </select>
    </div>

    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
</form>
 
