<?php 
$subject='';
$comment='';
$status='';
$error=[];
$submited=time();
if(isset($_GET['cmt_id'])){

    $commented=$_GET['cmt_id'];
};


$query = $pdo->prepare("select * from comment where cmt_id =:cmt_id");
$query->execute([':cmt_id'=> $commented]);
$record = $query->fetch(PDO::FETCH_ASSOC);

// this is for edited
if(count($record)> 0){
    $subject=$record["subject"];
    $comment=$record["comment"];
    $status=$record["status"];


};

if(isset($_SERVER['REQUEST_METHOD']) == 'POST'){
    if (isset($_POST['subject'])) {
        if ($_POST['subject'] == '') {
            $error[] = 'Please add the subject';
        }
        $subject = $_POST['subject'];
    }
    if(isset($_POST['comment'])){
        if($_POST['comment']==''){
            $error[]='Please add your comment';
        }
        $comment= $_POST['comment'];
    }
    if(isset($_POST['status'])){
        if($_POST['status']==''){
            $error[]='Please add your comment';
        }
        $status= $_POST['status'];
        }
    }
    if (empty($error)){

        $index=$pdo->prepare("UPDATE comment SET subject = :subject, comment=:comment,status=:status, submited=:submited WHERE comment.cmt_id = :cmt_id");
        $parms=[
            ':subject'=> $subject,
            ':comment'=> $comment,
            ':status'=> $status,
            ':submited'=> $submited,
            ':cmt_id'=>$commented
        ];
        $index->execute($parms);
        // header("Location: maintamplete?page=user");
    }
    
    include 'include/function.php';
?>


<div class="flex item-center justify-center">
    <div class="bg-white p-8 mt-10 w-[400px] border border-gray-300 rounded-lg shadow-md ">
    <h1 class="text-center p-3 text-[24px] font-bold">Eid Your comment</h1>
    <form action="maintamplete.php?page=eidcomment&cmt_id= <?php echo $commented; ?>" method="POST">
        <div class="mb-4">
            <label for="subject" class="block text-gray-700 font-bold mb-2">Subject</label>
            <input type="text" name="subject" value="<?php echo $subject ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="comment" class="block text-gray-700 font-bold mb-2">Comment</label>
            <textarea name="comment" id="comment" value="" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo $comment ?></textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                <option value="pleaseselect"<?php if($status){echo 'selected';}?>>Please select</option>
                <option value="0" <?php if($status==0){echo 'selected';}?>>0</option>
                <option value="1" <?php if($status==1){echo 'selected';}?>>1</option>
            </select>
        </div>
        <div class="flex ">
            <input type="submit" value="Updated" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 cursor-pointer">
        </div>
    </form>
</div>
</div>

