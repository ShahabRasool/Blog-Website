<?php
$uid = $_SESSION["u_id"];
$username=$_SESSION["username"];
$email=$_SESSION["email"];
// $linkedin =$_SESSION['linkedin'];
$rolesQuery = $pdo->prepare("SELECT * FROM role");  
$rolesQuery->execute();
$roles = $rolesQuery->fetchAll(PDO::FETCH_ASSOC);
// Fetch permissions
$permissionsQuery = $pdo->prepare("SELECT * FROM permission"); 
$permissionsQuery->execute();
$permissions = $permissionsQuery->fetchAll(PDO::FETCH_ASSOC);

$permission="";
$userid =$_SESSION['u_id'];
$roleid='';


$resul=$pdo->prepare("select * from artical");
$resul->execute();
$record=$resul->fetchAll(PDO::FETCH_ASSOC);
// if($_SERVER['REQUEST_METHOD']=='POST'){
//     if(isset($_POST['']))
// }
// $jun=$pdo->prepare("insert into jun_role_perm(roleid, pr_id) values(:roleid, pr_id)");
// $parms=[
//     ':roleid'=> $roleid,
//     ':pr_id'=>$permission
// ];
// $jun->execute($parms);
// print_r($jun);


$img=$pdo->prepare("select file_name from image where u_id=:u_id");
$img->execute([':u_id'=>$uid]);
$image=$img->fetch(PDO::FETCH_ASSOC);
if ($image) {
    $image_url = 'upload-image/' . $image['file_name'];
}
?>

<div class="flex gap-3 bg-black">

<aside class="flex flex-col w-64 h-screen px-4 py-8 overflow-y-auto bg-black  border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
    <a href="#" class="mx-auto">
    <h4 class="mx-2 mt-2 font-bold text-2xl text-white dark:text-gray-200">Profile</h4>

</a>

    <div class="flex flex-col items-center mt-6 -mx-2">
        <?php if ($image_url): ?>
                <img src="<?php echo $image_url; ?>" alt="User's Uploaded Image" class="object-fit w-24 h-24 mx-2 rounded-full">
                    <?php endif; ?>
        <h4 class="mx-2 mt-2 font-medium text-white dark:text-gray-200"><?php echo $username ?></h4>
        <p class="mx-2 mt-1 text-sm font-medium text-white dark:text-gray-400"><?php echo $email ?></p>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-6">
        <nav>
            <a class="show flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-800 dark:text-gray-200" href="#">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span class="mx-4 font-medium">Dashboard</span>
            </a>
          

            <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="maintamplete.php?page=dashboard&add=artical">
            <i class="fa-solid fa-newspaper"></i>

                <span class="mx-4 font-medium">Articles</span>
            </a>

            <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="maintamplete.php?page=dashboard&add=articleincategories">
            <i class="fa-solid fa-list"></i>               
             <span class="mx-4 font-medium">Categories</span>
            </a>

            <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="maintamplete.php?page=dashboard&add=image">
            <i class="fa-solid fa-image"></i>
            <span class="mx-4 font-medium">Uploaded image</span>
            </a>
            <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="maintamplete.php?page=dashboard&add=allimage">
            <i class="fa-solid fa-image"></i>
            <span class="mx-4 font-medium">Your Images</span>
            </a>
        </nav>
    </div>
</aside>
<div class="w-[90%]">
<?php    include "searchajex.php" ?>

    <?php
      if(isset($_GET['add'])){
         include  $_GET['add'].".php";
      }else{?>
       <form action="maintamplete.php?add=dashboard" method="post" class="w-[70%]  form">
<table class="bg-gray-900 shadow-md rounded-lg mt-8 w-full">
    <thead >
    <thead>
    <tr class="bg-gray-900 hover:bg-blue-400 text-white">
        <th class="py-4 px-6 border-b">Permission</th>
        <?php foreach ($roles as $index => $role): ?>
            <?php if ($index >0): ?>
                <th class="py-4 px-6 border-b"><?php echo $role["role_name"]; ?></th>
            <?php endif; ?>
        <?php endforeach; ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($permissions as $permission): ?>
        <tr class="odd:bg-gray-100 even:bg-gray-200">
            <td class="py-4 px-6 border-b"><?php echo $permission['permission_name']; ?></td>
            <?php foreach ($roles as $index => $role): ?>
                <?php if ($index < 2): ?>
                    <td class="py-4 px-6 border-b text-center">
                        <input type="checkbox" name="permissions[<?php echo $permission['pr_id']; ?>][<?php echo $role['roleid']; ?>]" value="" class="form-checkbox h-5 w-5 text-red-500">
                    </td>
                <?php endif; ?>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</tbody>

    </tbody>
</table>
<div class="flex justify-end mt-4">
    <button class="bg-blue-400 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
        Save Permissions
    </button>
</div>
</form>
<?php }?>
      
    

</div>

</div>
<!-- SELECT role.role_name, permission.permission_name FROM `jun_role_perm` LEFT join role on role.roleid =jun_role_perm.roleid LEFT JOIN permission on permission.pr_id -->

<!-- <script>
    let show =document.querySelector('.show');
    let form =document.querySelector('.form');
    show.addEventListener('click',function(e){
        e.preventDefault();
        form.classList.toggle('hidden')
    })
</script> -->