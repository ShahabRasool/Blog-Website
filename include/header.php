<?php 
 $sess="";
 $search='';
 $uid='';
 if(isset($_SESSION["u_id"])){
 $uid = $_SESSION["u_id"];
 }
 if(isset($_SESSION['username'])){
     // $username = $_SESSION['username'];
    $sess=$_SESSION['username'];
}
 $img=$pdo->prepare("select file_name from image where u_id=:u_id");
$img->execute([':u_id'=>$uid]);
$image=$img->fetch(PDO::FETCH_ASSOC);
if ($image) {
    $image_url = 'upload-image/' . $image['file_name'];
}
?>
<nav class="p-4 bg-cyan-700 shadow-md ">
    <div class="container mx-auto flex items-center justify-around">
       <a href="maintamplete.php"><h1 class="text-white text-xl font-bold hover:text-black">MY BLOG</h1></a> 
        
        <ul class="flex space-x-4">
            <li><a href="maintamplete.php?page=user" class="text-white hover:text-gray-600">User</a></li>
            <li><a href="maintamplete.php?page=artical" class="text-white hover:text-gray-600">Articles</a></li>
            <!-- <li><a href="maintamplete.php" class="text-white hover:text-gray-600">Home</a></li> -->
        </ul> 
        <?php 
        if(isloggedin()) { 
         
           
            ?>
            
            <div class="flex space-x-2 items-center">
            <?php if ($image_url): ?>
                <div class="flex items-center">
               <a href="maintamplete.php?page=dashboard"><img src="<?php echo $image_url; ?>" alt="User's Uploaded Image" class="object-fit w-[30px] h-[30px]  mx-2 rounded-full"></a>
               </div>
                <?php endif; ?>

           <div class="relative flex items-center gap-3">
    <!-- User Info (e.g., username) -->
    <h2 class="text-white font-bold"><?php echo htmlspecialchars($sess); ?></h2>

    <!-- Dropdown Button -->
    <button id="dropdownButton" class="text-white focus:outline-none">
        <i class="fa-solid fa-caret-down" style="font-size: 25px;"></i>
    </button>

    <!-- Dropdown Menu -->
    <div id="dropdownMenu" class="absolute right-0 top-6 bg-gray-800 text-yellow-500 mt-2 w-48 border border-gray-300 rounded shadow-lg hidden">
    <ul class="py-2">
        <li><a href="maintamplete.php?page=addyourarticles" class="block px-4 py-2 text-yellow-500  hover:bg-gray-100 transition duration-300">Add Your Article</a></li>
        <li><a href="maintamplete.php?page=logout" class="block px-4 py-2 text-yellow-500 hover:bg-gray-100 transition duration-300">Logout</a></li>
    </ul>
</div>

    
</div>
        </div>
      
        <?php } else { ?>
            <div class="flex space-x-4">
            <a href="maintamplete.php?page=login" class="text-white px-4 py-2 rounded border border-gray-300 hover:bg-gray-200 transition duration-300">Sign In</a>
            <a href="maintamplete.php?page=register" class="text-white px-4 py-2 rounded border border-gray-300 hover:bg-gray-200 transition duration-300">Sign Up</a>

            <div class="flex items-center gap-3">
    <a href="https://www.linkedin.com/in/shahabrasool" class="text-white"><i class="fa-brands fa-linkedin" style="font-size: 25px;"></i></a>
    <a href="https://github.com/ShahabRasool" class="text-white"><i class="fa-brands fa-github" style="font-size: 25px;"></i></a>
    <a href="https://www.facebook.com/shahab.rasool56?mibextid=ZbWKwL" class="text-white"><i class="fa-brands fa-facebook" style="font-size: 25px;"></i></a>
    <a href="" class="text-white"><i class="fa-brands fa-twitter" style="font-size: 25px;"></i></a>
    </div>
           
               
            </div>
        <?php } ?>
        </div>
</nav>
<script>
 // Ensure the DOM is fully loaded before executing the script
 document.addEventListener('DOMContentLoaded', function() {
        // Select the dropdown button
        let dropdownButton = document.getElementById('dropdownButton');

        // Add a click event listener to the dropdown button
        dropdownButton.addEventListener('click', function() {
            // Select the dropdown menu
            let dropdownMenu = document.getElementById('dropdownMenu');

            // Toggle the 'hidden' class on the dropdown menu
            dropdownMenu.classList.toggle('hidden');
        });
    });
</script>
