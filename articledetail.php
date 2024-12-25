<?php 
 require './include/includedatabase.php';

$name="";
$email="";
$password ="";
$error=[];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['name'])){
        if($_POST['name'] ==''){
            $error[]='enter the name';
        }
        $name = $_POST['name'];
    }
    if(isset($_POST['email']) && !empty($_POST['email'])){
        $query = $pdo->prepare("select * from register where email = :email ");
        $query->execute([':email' => $_POST['email']]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($query -> rowCount() > 0){
            $error[]= 'Email  alerdy exists';
        }else{
            $query = $_POST["email"];
        }
    }else{
        $error[]= "enter your email";
    }
    

   if(isset($_POST['password'])){
    if($_POST['password'] ==''){
        $error[]='enter the your password';
    }
    $password= $_POST['password'];
   }
   
$insert= false;

if($insert == true){

    $query = $pdo->prepare("insert into register (username, email, password) value (:name,:email,:password)");
    $array =[
     ':name' => $name,
     ':email' => $email,
      ':password' => $password,
    ];
    $query->execute($array);
}
}


?>

<?php 
    foreach($error as $error){
        echo '<h1 class="p-3 text-2xl">'.$error. '</h1>';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form method="post" class="flex flex-col gap-6">
        <div>
            <label >username
                <input class="border-2 " type="text" name="name">
            </label>
        </div>
        <div>
            <label>Email
                <input class="border-2" type="text" name="email">
            </label>
        </div>
        <div>
            <label>Password
                <input class="border-2" type="password" name="password">
            </label>
        </div>
        <input class="border-2" type="submit" value="Register">
    
    </form>
  
</body>
</html>