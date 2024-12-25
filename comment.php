<?php 
include 'include/includedatabase.php';

if(isloggedin()){
    if(isset($_GET['a_id'])){

        $artcle_id = $_GET['a_id']; 
        $query = $pdo->prepare("SELECT * FROM comment WHERE artcle_id = :artcle_id");
        $query->execute([':artcle_id' => $artcle_id]);
        $comments = $query->fetchAll(PDO::FETCH_ASSOC);
    }
   

    // Prepare the query to avoid SQL injection
    
    $subject = '';
    $comment = ''; 
    $submited = time();
    $status = '';
    $user_id = $_SESSION["u_id"] ?? null;
    $error = [];
    $pid='';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['subject'])) {
            if ($_POST['subject'] == '') {
                $error[] = 'Please add the subject';
            }
            $subject = $_POST['subject'];
        }
        if (isset($_POST['comment'])) {
            if ($_POST['comment'] == '') {
                $error[] = 'Add your comment';
            }
            $comment = $_POST['comment'];
        }
        if (isset($_POST['status'])) {
            if ($_POST['status'] == '') {
                $error[] = 'Select status';
            }
            $status = $_POST['status'];
        }
    
        if (empty($error)) {
            $query = $pdo->prepare("INSERT INTO comment (subject, comment, status, submited, user_id, artcle_id, parrent) VALUES (:subject, :comment, :status, :submited, :user_id, :artcle_id, :parrent)");
            $array = [
                ':subject' => $subject,
                ':comment' => $comment,
                ':status' => $status,
                ':submited' => $submited,
                ':user_id' => $user_id,
                ':artcle_id' => $artcle_id,
                ':parrent' => $pid
            ];
            $query->execute($array);
            echo '<h2 class="text-2xl text-green-800">Thank you your comment</h2>';
        }else{
            foreach ($error as $err) {
                echo '<p class="text-red-600">' . $err . '</p>';
            }
        }
    }

    include 'include/function.php';
    ?>
    
    <div class="bg-white p-8 mt-10  border border-gray-300 rounded-lg shadow-md  ">
        <form id="commentForm" action="maintamplete.php?page=artical&a_id=<?php echo $artcle_id; ?>" method="POST">
            <div class="mb-4">
                <label for="subject" class="block text-gray-700 font-bold mb-2">Subject</label>
                <input type="text" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-gray-700 font-bold mb-2">Comment</label>
                <textarea name="comment" id="comment" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    <option value="">Please select</option>
                    <option value="0" <?php if($status==0){echo 'selected';}?>>0</option>
                    <option value="1" <?php if($status==1){echo 'selected';}?>>1</option>
                </select>
            </div>
            <div>
                <input type="hidden" value="<?php echo $_GET['pid'] ?>">
            </div>
            <div class="flex ">
                <input type="submit" value="Submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 cursor-pointer">
            </div>
        </form>
    </div>

    <?php
}
?>
