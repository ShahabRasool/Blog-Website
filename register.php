<?php 
require 'include/includedatabase.php';
if( isloggedin()){

}else{
    
}
$name="";
$username="";
$email="";
$status=1;
$submited= "";
$linkedin="";
$errors=[];
// print_r($_POST);

 if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST["name"])){
        if(isset($_POST["name"]) == ""){
            $errors[]="Name is Required";
        }
        $name= $_POST["name"];
    }
    if(isset($_POST["username"])){
        if(isset($_POST["username"]) == ""){
            $errors[]="Username is Required";
        }
        $username= $_POST["username"];
    }
    if(isset($_POST["email"])){
        if(isset($_POST["email"]) == ""){
            $errors[]="Email is Required";
    }
    $email= $_POST["email"];

 }
 if(isset($_POST["linkedin"])){
    if(isset($_POST["linkedin"]) == ""){
        $errors[]="LinkedIn is Account is required";
}
$linkedin= $_POST["linkedin"];

}
    if(isset($_POST["password"])){
        if(isset($_POST["password"]) == ""){
            $errors[]="Password is Required";
        }
        $password= $_POST["password"];
        // this is use for security purpose
        $password= password_hash($password, PASSWORD_DEFAULT);
    }
    $insert= false;
    if(count($errors) == 0){
        $insert= true;
    }
    if($insert){
        $query = $pdo->prepare("insert into user (name,username,email, linkedin, password, status,date) values(:name,:username,:email, :linkedin,:password,:status,:date)");
        $params=[
            ":name"=> $name,
            ":username"=> $username,
            ":email"=> $email,
            ':linkedin'=> $linkedin,
            ":password"=> $password,
            ":status"=> $status,
            ":date"=> time()
        ];
        $query->execute($params);
}
$lastid=$pdo->lastInsertId();
header("Location: maintamplete.php?page=user&id=$lastid");
 }


?>


<h1 class="text-center font-bold text-[30px] p-4 text-cyan-700">BLOG</h1>

<form action="maintamplete.php?page=register" method="post" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md hover:outline-blue-400 outline ">
    <h1 class="text-2xl font-semibold mb-4 text-center">Register Form</h1>
    <div class="mb-4">
        <label for="name" class="block text-gray-700">Name</label>
        <input type="text" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="<?php echo $name; ?>" placeholder="Enter your name">
    </div>

    <div class="mb-4">
        <label for="username" class="block text-gray-700">Username</label>
        <input type="text" name="username" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="<?php echo  $username; ?>" placeholder="Enter your username">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="<?php echo $email ?>" placeholder="Enter your Email">
    </div>

    
    <div class="mb-4">
        <label for="linkedin" class="block text-gray-700">linkedin</label>
        <input type="linkedin" name="linkedin" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="<?php echo $linkedin ?>" placeholder="Enter your linkedin account">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" value="<?php  echo $password ?>" placeholder="Enter your password">
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Register</button>
    <a href="maintamplete.php?page=login" class="block text-center mt-4 text-blue-500 hover:underline">Sign In for Blog</a>
</form>

<script>


</script>