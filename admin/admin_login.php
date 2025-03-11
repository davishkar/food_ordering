<?php

include '../components/connect.php';

session_start();

if (isset($_POST['submit'])) {
    // Sanitize and retrieve input values
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);

    // Prepare the SQL statement to prevent SQL injection
    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
    $select_admin->execute([$name]);

    // Check if the user exists
    if ($select_admin->rowCount() > 0) {
        $fetch_admin = $select_admin->fetch(PDO::FETCH_ASSOC);
        
        // Verify the password (no hashing)
        if ($pass === $fetch_admin['password']) {
            // Password is correct, set session variable
            $_SESSION['admin_id'] = $fetch_admin['id'];
            header('location:dashboard.php');
            exit(); // Always exit after a header redirect
        } else {
            $message[] = 'Incorrect username or password!';
        }
    } else {
        $message[] = 'Incorrect username or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin login</title>
   <link rel="icon" href="images/LYgjKqzpQb.ico" type="image/x-icon">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body  style="background-image: url('images/food-1024x683.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!-- admin login form section starts  -->

<section class="form-container" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; width: 300px; margin: auto; text-align: center;">

   <form action="" method="POST">
      <h3 style="color: #000000;">login now</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="submit" class="btn" style="background-color: #4CAF50; color: #fff; border: none; padding: 10px 15px; cursor: pointer;">
   </form>

</section>


<!-- admin login form section ends -->











</body>
</html>