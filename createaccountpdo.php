
<?php

include 'dbconnpdo.php';

if (isset($_POST['submit'])) {

   $name = $_POST['name'];

   $email = $_POST['email'];

   $pass = $_POST['pass'];

   $cpass = $_POST['cpass'];

   // echo "<script>alert('$email');</script>";

   $select_users = $conn->prepare("SELECT * FROM user_information WHERE uemail = ?");
   $select_users->execute([$email]);

   if ($select_users->rowCount() > 0) {

      $creationerror = "Email already Taken...please give correct E-mail !!!";

      // echo '<script>alert("email already taken!");</script>';
   } else {

      if ($pass != $cpass) {

         $creationerror = "Please Enter same password!!!";

         // echo '<script>alert("password not matched! please enter same password !!!");</script>';

      } else {

         $insert_user = $conn->prepare("INSERT INTO user_information(uname, uemail, upasword) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);

         if ($insert_user) {

            $fetch_user = $conn->prepare("SELECT * FROM user_information WHERE uemail = ? AND upasword = ?");

            $fetch_user->execute([$email, $cpass]);

            $row = $fetch_user->fetch(PDO::FETCH_ASSOC);

            if ($fetch_user->rowCount() > 0) {

               $namevar = $row['uname'];

               // echo "<script>alert('$namevar');</script>";
               //    // 60*60*24 = 86400 seconds which is equals to 1 day;
               //    // to set cookies for 1 month use 60*60*24*30
                     setcookie('username', $namevar, time() + 5);
               
                     header('location:project1.php');
               
            }
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./project1add.css">

</head>
<body>

<?php
if ($creationerror != '') {
   echo "<p id='newpar'> $creationerror</p>";
}
?>

<!-- register section starts  -->

<section class="form-container">

   <form action="" method="POST">
      <h3>register now</h3>
      <input type="text" required maxlength="20" placeholder="enter your username" class="box" name="name">
      <input type="email" required maxlength="50" placeholder="enter your email" class="box" name="email">
      <input type="password" required maxlength="50" placeholder="enter your password" class="box" name="pass">
      <input type="password" required maxlength="50" placeholder="confirm your password" class="box" name="cpass">
      <input type="submit" value="register now" name="submit" class="btn">
      <p>already have an account? <a href="./project1.php">login now</a></p>
   </form>

</section>

<!-- register section ends -->
   
</body>
</html>