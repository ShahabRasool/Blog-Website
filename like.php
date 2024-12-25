<?php
$user_id = "";
$article = "";

if (isset($_GET['a_id'])) {
    $article = $_GET['a_id'];
} 

if (isset($_SESSION['u_id'])) {
    $user_id = $_SESSION['u_id'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($user_id) && isset($article)) {
        if (isset($_POST['like'])) {
            $query = $pdo->prepare("INSERT INTO likeartical (a_id, u_id) VALUES (:a_id, :u_id)");
            $params = [
                ':a_id' => $article,
                ':u_id' => $user_id
            ];
            $query->execute($params);
        }

        if (isset($_POST['dislike'])) {
           
            $query = $pdo->prepare("DELETE FROM likeartical WHERE a_id = :a_id AND u_id = :u_id");
            $params = [
                ':a_id' => $article,
                ':u_id' => $user_id
            ];
            $query->execute($params);
        }

    }
    // header('loaction: maintamplete.php?page=dashboard&add=artical');
    // exit;    
}
$query = $pdo->prepare("SELECT COUNT(*)as likesd FROM likeartical WHERE a_id = :a_id");
$query->execute([':a_id' => $article]);
$result = $query->fetch(PDO::FETCH_ASSOC);


?>




<div class="like-dislike flex gap-4 mt-4">
    <!-- Like Form -->
    <form method="POST" action="maintamplete.php?page=dashboard&add=artical&a_id=<?php echo $article; ?>">
        <input type="hidden" name="a_id" value="<?php echo $article; ?>">
        <button id="button" type="submit" name="like">
        <i class="fa-regular fa-thumbs-up text-[30px]  "> </i> 
        </button> <?php echo $result['likesd']; ?>  
    </form>

    <!-- Dislike Form -->
    <form method="POST" action="maintamplete.php?page=dashboard&add=artical&a_id=<?php echo $article; ?>">
        <input type="hidden" name="a_id" value="<?php echo $article; ?>">
        <button id="button" type="submit" name="dislike" >
        <i class="fa-regular fa-thumbs-down text-[30px]"></i><?php echo $result['likesd']; ?>
        </button>
    </form>
</div>
 <!-- <script>
    let likedislike=document.querySelector('.like-dislike');
    let button =document.getElementById('button');
    likedislike.addEventListener('click',function(e){
        e.preventDefault();
        let data = e.target.value; 
        console.log(data);

        let xhr= new XMLHttpRequest();
        console.log(xhr);
        xhr.open('post', 'like.php');
        xhr.onload=function(){
            if(this.status===200 && this.readyState===4){
                console.log(this.responseText);
                button.innerHTML=xhr.responseText;
            }
        }
        xhr.send();
    })
 </script> -->