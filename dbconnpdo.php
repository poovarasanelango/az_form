<?php

$db_name = 'mysql:host=localhost;dbname=project_pdo_single';

// $db_name = 'mysql:host=localhost;dbname=restApi';
// $db_name = 'mysql:host=localhost;dbname=mydatabase';

//  $db_name = 'mysql:host=localhost;dbname=indian_cricket_team';

// $db_name = 'mysql:host=localhost;dbname=task';


$username = 'root';
$upassword = 'root';

$conn = new PDO($db_name, $username, $upassword);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if($conn){
//     echo 'welcome';
// }else {
//     echo 'not work';
// }
?>