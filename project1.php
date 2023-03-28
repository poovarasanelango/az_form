
<?php
include 'dbconnpdo.php';

if(isset($_COOKIE['username'])){

   $verifyuname = $_COOKIE['username'];

   // echo "<script>alert('$verifyuname');</script>"; 
   
}


if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $upass = $_POST['pass'];

   //  echo "<script>alert('$email');</script>";   
   //  echo "<script>alert('$upass');</script>";   

    $select_user=$conn->prepare("SELECT * from user_information
    WHERE  uemail= ? AND upasword=?");

    $select_user->execute([$email, $upass]);

    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount()>0){

      setcookie('user_id', $row['id'], time() +3600);
      header('location:home.php');

      $errormsg = "";
        
    }else {
       
    //   echo '<script>alert("Enter valid information");</script>';
        $errormsg = "Enter valid information";
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./project1add.css">

</head>
<body>

<?php 
if ($verifyuname !='') {
   echo "<p id='newpar'> $verifyuname, your account created !.You can login !!</p>";
}elseif($errormsg!=''){
    echo "<p id='newpar'> $errormsg</p>";
}
?>
<!-- register section starts  -->

<section class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <input type="email" required maxlength="50" placeholder="enter your email" class="box" name="email">
      <input type="password" required maxlength="50" placeholder="enter your password" class="box" name="pass">
      <input type="submit" value="login now" name="submit" class="btn">
      <p>don't have an account? <a href="./createaccountpdo.php">register now</a></p>
      <p>Are you forget your password? <a href="./forgetpassword01.php">click here</a></p>
   </form>

</section>


</body>
</html>

<!-- 
<div class="signIn" >
    <img src="./loginuser.jpg"  id="userlogin">
    <h1 id="heading">Login</h1>
    <form id="verify" action="" method="post">
       
        <div class="input">
            <input type="text" class="uinput" placeholder="Enter your name" id="username" name="username" required>
        </div>
        <!-- <div class="input">
            <input type="email" placeholder="Enter your e-mail" id="e-mail" name="e-mail"  required>
        </div> -->
        <!-- <div class="input">
            <input type="password" class="uinput" placeholder="Enter your Password" id="password" name="loginpassword" required>
        </div>
        <div class="btn">
            <input type="submit" id="submit" name="submit" value="Login">
            <!-- <button type="button" id="submit" onclick="login()">Submit</button> -->
        <!-- </div> 
        <a id="create" href="./createAccount.html" id="a1">Create Account</a>
        <a  id="pass" href="./forgotpassword.html" id="a2">Forget Password</a> -->
       <!-- <ul> <a id="forgetUsername" href="">Forget Username</a></ul> -->
<!--     
    </form>
   </div> --> -->
    <!-- <script src="./createAccount.js"></script>  -->
    <!-- <script src="./login.js"></script> --> -->
