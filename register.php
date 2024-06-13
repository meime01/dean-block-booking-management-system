<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:login.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      :root {
  --facebook-blue: #1877F2;
  --facebook-green: #42B72A;
  --facebook-grey: #F0F2F5;
  --facebook-text: #1C1E21;
}

.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: var(--facebook-grey);
  font-family: Arial, sans-serif;
}

.form-container form {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 24px;
  width: 400px;
}

.form-container h3 {
  font-size: 24px;
  font-weight: bold;
  color: var(--facebook-text);
  text-align: center;
  margin-bottom: 20px;
}

.form-container .message {
  font-size: 14px;
  color: #dc3545;
  text-align: center;
  margin-bottom: 20px;
}

.form-container .box {
  width: 100%;
  padding: 12px 16px;
  font-size: 16px;
  border: 1px solid #ccd0d5;
  border-radius: 6px;
  margin-bottom: 16px;
  box-sizing: border-box;
  color: var(--facebook-text);
}

.form-container .box:focus {
  outline: none;
  border-color: var(--facebook-blue);
  box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.5);
}

.form-container .btn {
  display: block;
  width: 100%;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
  background-color: var(--facebook-blue);
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.form-container .btn:hover {
  background-color: #166FE5;
}

.form-container p {
  font-size: 14px;
  color: var(--facebook-text);
  text-align: center;
  margin-top: 16px;
}

.form-container p a {
  color: var(--facebook-blue);
  text-decoration: none;
}

.form-container p a:hover {
  text-decoration: underline;
}
   </style>

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="name" placeholder="enter username" class="box" required>
      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>