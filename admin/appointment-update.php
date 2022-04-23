<?php


include '../config.php';

if (isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    // $status = mysqli_real_escape_string($conn, $_GET['status']);

    $sql = "UPDATE appointment set status = true where id = '$id'";
    // if($status == false){
       
    // }else{
    //     $sql = "UPDATE appointment set status = false where id = '$id'";
    // }

    $result = mysqli_query($conn, $sql);

    header("location: appointment-all.php");
}
?>