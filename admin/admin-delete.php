<?php
include '../config.php';


if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query
    $sql = "DELETE FROM `details` WHERE user_id = '$id'";

    $result = mysqli_query($conn, $sql);

    $sql = "DELETE FROM `users` WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);

    header("location: admin-all.php");


}