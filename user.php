<?php 
// include 'include/includedatabase.php';
if( isloggedin()){


$uid = $_SESSION["u_id"];
$username=$_SESSION["username"];
$email=$_SESSION["email"];
$linkedin = isset($_SESSION['linkedin']) ;
if(isloggedin()){
     // here all the article will come which autor has been written
$query = $pdo->prepare("select * from artical where u_id=:u_id");
// $query->execute(arry(':u_id'=> $uid));
$params=[
    ':u_id'=> $uid,
];
$query->execute($params);

$result=$query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['cmt_id'])) {
    $comtid = $_GET['cmt_id'];
    $index = $pdo->prepare("DELETE FROM comment WHERE cmt_id = :cmt_id");
    $params = [':cmt_id' => $comtid];
    $index->execute($params);
}
 
// comment from 
if(isset($_GET['a_id'])){

    $art_id = $_GET['a_id'];
    
    $comt =$pdo->prepare("select * from comment where artcle_id = :artcle_id");
    $params=[
        ':artcle_id'=>$art_id,
    ];
    $comt->execute($params);
    $comments=$comt->fetchAll(PDO::FETCH_ASSOC);
 
  

}

$img=$pdo->prepare("select file_name from image where u_id=:u_id");
$img->execute([':u_id'=>$uid]);
$image=$img->fetch(PDO::FETCH_ASSOC);
if ($image) {
    $image_url = 'upload-image/' . $image['file_name'];
} else {
    $image_url = '';
}


}


?>
<div class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex">
            <!-- Profile Section -->
            <div class="bg-white rounded-lg shadow-md p-6 w-[20%] flex flex-col ">
                <h1 class="text-2xl font-bold mb-4 bg-blue-400 text-center py-2 hover:rounded-lg hover:bg-blue gap-2">Profile</h1>
                <div class="items-center flex flex-col ">
                <?php if ($image_url): ?>
                <img src="<?php echo $image_url; ?>" alt="User's Uploaded Image" class="object-fit w-24 h-24 mx-2 rounded-full">
                    <?php endif; ?>
                <h4 class="mt-2  text-black font-bold text-2xl pb-2"><?php echo $username; ?></h4>
                <p class="mt-1 text-sm font-medium text-black pb-2"><?php echo $email; ?></p>
                <h4 class="text-xl mb-2 text-black pb-2">User ID: <?php echo $uid; ?></h4>
                <a href="<?php echo $_SESSION['linkedin']; ?>" class="text-blue-400">
                    <i class="fa-brands fa-linkedin" style="font-size: 25px;"></i>
                </a>
                </div>
            </div>

            <!-- Articles Section -->
            <div class="bg-white shadow-md rounded-lg p-6 flex-1 mx-4">
                <h1 class="text-2xl font-bold mb-4 bg-blue-400 text-center py-2">Articles</h1>
                <ul class="space-y-4">
                    <?php 
                    if (isset($_GET['a_id'])) {
                        $article = $_GET['a_id'];
                        $resutled = $pdo->query("SELECT * FROM artical WHERE artical.a_id = $article");
                        $showarticle = $resutled->fetch(PDO::FETCH_ASSOC);
                        if ($showarticle) {
                            echo '<h1 class="text-xl font-bold mb-2">' . $showarticle['title'] . '</h1>';          
                            echo '<p class="text-gray-700">' . $showarticle['description'] . '</p>';
                        }
                    } else {
                        echo '<h1 class="text-[30px] font-normal mb-2">Technology is the application of conceptual knowledge</h1>';
                        echo '<p>To achieve practical goals, especially in a reproducible way. The word technology can also mean the products resulting from such efforts, including both tangible tools such as utensils or machines, and intangible ones such as software.</p>';
                    }
                    if (isset($showarticle)) {
                        echo '<p>Date: ' . date('Y-m-d h:i:s a', $showarticle['submited']) . '</p>';
                    }
                    ?> 
                </ul>

                <!-- Comment Section -->
                <div class="bg-white shadow-md rounded-lg p-4 mt-6">
                    <h1 class="text-xl font-bold mb-4 bg-blue-400 text-center py-2">Article Comment</h1>
                    <ul class="space-y-4">
                        <?php if (isset($_GET['a_id'])): ?>
                        <?php foreach ($comments as $comment): ?>
                            <li class="border-b pb-4">
                                <h4 class="text-lg font-semibold"><?php echo $comment['subject']; ?></h4>
                                <p class="text-gray-700 mt-2"><?php echo $comment['comment']; ?></p>
                                <div class="flex gap-5">
                                    <p class="text-gray-700 mt-2">Article ID NO: <?php echo $comment['artcle_id']; ?></p>
                                    <p class="text-gray-700 mt-2">User ID NO: <?php echo $comment['user_id']; ?></p>
                                </div>
                                <div class="flex justify-between pb-3">
                                    <a class="pt-3 block text-[20px] text-blue-400 hover:text-red-300 hover:underline" href="maintamplete.php?page=eidcomment&cmt_id=<?php echo $comment['cmt_id']; ?>">Edit</a>
                                    <a class="pt-3 block text-[20px] text-blue-400 hover:text-red-300 hover:underline" href="maintamplete.php?page=user&cmt_id=<?php echo $comment['cmt_id']; ?>">Delete</a>
                                </div>
                                <p>Date: <?php echo date('Y-m-d h:i:s A', $comment['submited']); ?></p>
                            </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- My Articles Section -->
            <div class="bg-white shadow-md rounded-lg p-6 flex-1">
                <h1 class="text-2xl font-bold mb-4 bg-blue-400 text-center py-2">My Articles</h1>
                <ul class="space-y-4">
                    <?php 
                    $query = $pdo->query("SELECT * FROM artical WHERE u_id = $uid");
                    $records = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($records as $record) {
                        echo '<li class="text-blue-600 hover:underline">';
                        echo '<a href="maintamplete.php?page=user&a_id=' . $record['a_id'] . '">' . $record['title'] . '</a>';
                        echo '<a class="text-black pl-4" href="maintamplete.php?page=edit-article&a_id=' . $record['a_id'] . '">Edit Article</a>';
                        echo '<a class="text-green-500  text-center p-2 " href="maintamplete.php?page=comment&a_id=' . $record['a_id'] . '">Add comment</a>';
                        echo '</li>';
                    }
                    ?>     
                </ul>
            </div>
        </div>

      
    </div>
</div>

 <?php
                }
else{
    header ("Location: maintamplete.php?page=login");
    exit;

}
