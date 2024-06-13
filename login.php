<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:homeuser.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
  
   <style>
      /* General Styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f0f2f5;
  color: #1c1e21;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-image: url('images/backg.png');
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  background-color:  #1877f2;
}

/* Form Container Styles */
.form-container {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1), 0 8px 16px rgba(0, 0, 0, 0.1);
  padding: 24px;
  width: 500px;
}

/* Form Styles */
form {
  display: flex;
  flex-direction: column;
}

h3 {
  text-align: center;
  margin-bottom: 24px;
}

.box {
  width: 93%;
  padding: 12px 16px;
  border: 1px solid #dddfe2;
  border-radius: 6px;
  font-size: 16px;
  margin-bottom: 16px;
}

.box:focus {
  outline: none;
  border-color: #1877f2;
  box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.5);
}

.btn {
  background-color: #1877f2;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  font-weight: bold;
  padding: 12px 24px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #166fe5;
}

p {
  text-align: center;
  margin-top: 16px;
}

a {
  color: #1877f2;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

.message {
  background-color: #f2f2f2;
  padding: 12px 16px;
  border-radius: 6px;
  margin-bottom: 16px;
}
   </style>

</head>
<body>
<h1 style="position: absolute; top: 20px; left: 50%; transform: translateX(-50%); color: white;">Deans Block Booking and Equipment System</h1>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>CUT Staff Login Now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="register.php">regiser now</a></p>
   </form>

</div>

</body>
</html>