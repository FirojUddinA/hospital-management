<?php
session_start();
$role = 0;
if (isset($_SESSION['role'])){
    $role =($_SESSION['role']);
}

if ($role === 11209){
    session_destroy();
    header("location: index.php");
}else{
    session_destroy();
    header("location: login.php");
}



?>