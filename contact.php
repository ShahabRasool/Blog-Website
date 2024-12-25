<?php 
// include 'include/includedatabase.php';
// $to="shahabkoko56@gmail.com";
// $subject="hello";
// $message="hello";
// $headers="From: test@drupak.com";
// if(mail($to,$subject,$message,$headers)){
//   echo "mail sent";
// }else{
//   echo "mail not sent";
// }
// exit();
$errors=[];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST["name"])){
        if($_POST["name"] == ""){
           $errors[]="please enter the fullname";
        }
        $name=$_POST["name"];
        }

        if(isset($_POST["email"])){
            if($_POST["email"] == ""){
               $errors[]="please enter the email";
            }
            $email=$_POST["email"];
            }
            
        if(isset($_POST["subject"])){
            if($_POST["subject"] == ""){
               $errors[]="please enter the subject";
            }
            $subject=$_POST["subject"];
            }

            if(isset($_POST["message"])){
                if($_POST["message"] == ""){
                    $errors[]="please enter the message";
            }
            $message=$_POST["message"];
            }
        $to='shahabkoko56@gmail.com';
        $headers ="From: $email";
          if(mail($to,$subject,$message,$headers)){
            echo "email sent successfully";
          }else{
            echo "email is not sent";
          }
}

?>

<div class="container mx-auto w-[40%] p-8">
    <form id="myForm" method="post" class="space-y-6">
      <div>
        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
        <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>
      <div>
        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
        <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
      </div>
      <div>
        <label for="subject" class="block text-gray-700 font-bold mb-2">Subject</label>
        <input type="text" name="subject" id="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
      </div>
      <div>
        <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
        <textarea name="message" id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>
      <div>
        <input type="submit" value="Submit" name="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
    </form>
  </div>
  <!-- <script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
      let name = document.getElementById('name').value;
      let email = document.getElementById('email').value;
      let message = document.getElementById('message').value;
      
      if (name === '' || email === '' || message === '') {
        alert('All fields are required.');
        event.preventDefault(); 
      }
    });
  </script> -->

