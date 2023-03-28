
<?php

 if(isset($_POST['submit'])){

    include './dbconnpdo.php';


$checkmail = $_POST['checkemail'];

$newpass = $_POST['unewpass'];

$renewpass=$_POST['reunewpass'];

    $forgeterror = "";


    // echo $checkmail;
    // echo $newpass;
    // echo $renewpass;
 
$check_query = $conn->prepare("SELECT * FROM user_information WHERE uemail= ?");

    $check_query->execute([$checkmail]);

    $row = $check_query->fetch(PDO::FETCH_ASSOC);

    if($check_query->rowCount()>0){

        // echo '<script>alert("success");</script>';

         if ($newpass <> $renewpass) {

            // echo '<script>alert("please enter password same");</script>';

            $forgeterror = "please enter password same";
          } 

    else {

            $newquery = $conn->prepare("UPDATE user_information SET upasword=? WHERE uemail = '$checkmail' ");

            $newquery->execute([$renewpass]);

            $fetchquery=$conn->prepare("SELECT * FROM user_information WHERE uemail='$checkmail'");


            $fetchquery->execute();
      
            $newrow=$fetchquery->fetch(PDO::FETCH_ASSOC);
 
             if ($fetchquery->rowCount()>0) {
               

                // echo '<script>alert("welcome succuss");</script>';

                
           setcookie('user_id', $row['id'], time() +3600);
           header('location:home.php');
                

             }
           
            
       }
             
    }else {

        $forgeterror = "E-mail not available !!!";
        
    }
 }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <link rel="stylesheet" href="./forgot.css">
   
</head>
<body>

<?php
if ($forgeterror != '') {
   echo "<p id='newpar'> $forgeterror</p>";
}
?>
    <form action="" method="post">
    <div class="container1">
        <img src="./helper1.gif" id="helperimg">
        <h1 >Don't Worry!!! We Help you!!! </h1>
        <div class="input1">
            <!-- <label for="search" >Enter your E-mail Id:</label> -->
            <input type="email" id="search" placeholder="Enter Your email" name="checkemail"><br>

            <input type="text" id="search" name="unewpass" placeholder="Enter Your new password" ><br>

            <input type="text" id="search" name="reunewpass" placeholder="Re-enter Your password"><br>

            <input type="submit"  id="clickhere" name="submit">

            <p style="color: white;">already have an account?  <a href="./project1.php">login now</a></p>
            
        </div>
    </div>
</form>
</body>
</html>