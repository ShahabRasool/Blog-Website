<?php 
// session_start();
require 'include/includedatabase.php';

$email ='';
$errors=[];
// print_r($_POST);
 if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST["email"])){
        if(isset($_POST["email"]) == ""){
            $errors[]="Email is Required";
        }
        $email= $_POST["email"];
    }

    if(isset($_POST["password"])){
        if(isset($_POST["password"]) == ""){
            $errors[]="password is Required";
        }
        $password= $_POST["password"];
// $password= password_hash($password , PASSWORD_DEFAULT);        
    }

    $query=$pdo->prepare("select * from user where email= :email");
    $query->execute([':email' => $email]);
    $records= $query->fetch(PDO::FETCH_ASSOC);
    // print_r($records);
    if($records){
        if(password_verify($password, $records['password'])){
        $_SESSION["isLoggedIn"]=true;
        $_SESSION["username"]= htmlspecialchars($records["username"]);
        $_SESSION["u_id"]= htmlspecialchars($records["u_id"]);
        $_SESSION["email"]= htmlspecialchars($records["email"]);
        $_SESSION["linkedin"]= htmlspecialchars($records["linkedin"]);
        header('Location: maintamplete.php?page=user');
    
    }
    }else{
            echo "Invalid Email or Password";
        }

 }
?>
    <h1 class="text-center font-bold text-[30px] p-4 text-cyan-700">BLOG</h1>
<form action="maintamplete.php?page=login" method="post" class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md hover:outline-blue-400 outline ">
    <h1 class="text-xl font-bold text-center text-cyan-700">Log in to Blog</h1>
    <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="text" name="email" placeholder="Enter your Email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" placeholder="Enter yoour password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
    </div>

    <button type="submit" class="bg-cyan-700 w-full hover:bg-blue-400 text-white px-4 py-2 rounded-md focus:outline-none">Login</button>
    <a href="maintamplete.php?page=register" class="block text-center mt-4 font-bold text-cyan-700 hover:underline">Sign Up for Blog</a>

</form>
