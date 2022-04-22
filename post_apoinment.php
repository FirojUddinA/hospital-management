<?php

$conn = mysqli_connect('localhost', 'pan', 'pan','hospital');
if (!$conn){
    echo 'connection error' . mysqli_connect_error();
}

if (isset($_POST['submit'])) {

    print_r($_POST);

    $insert_query = "INSERT INTO appointment( user_id, doctor_id, ap_date, ap_time, status) VALUES ('1','21','dsfg','sadf','false');";

//       seve to db and check
    $insert_user  = mysqli_query($conn, $insert_query);
}