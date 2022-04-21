<?php
//session_start();
//$role = 0;
//if (isset($_SESSION['role'])){
//    $role =($_SESSION['role']);
//}
//if(isset($_SESSION['user']) || !isset($_SESSION['user'])){
//
//}
//else{
//    header("location: login.php");
//}
//?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Web</h1>
<?php echo '<a href="logout.php?logout">Logout</a>';?>
<?php echo '<a href="./users/profile.php">profile</a>';?>
</body>
</html>