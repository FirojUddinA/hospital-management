<?php
$conn = mysqli_connect('localhost', 'pan', 'pan','hospital');
if (!$conn){
    echo 'connection error' . mysqli_connect_error();
}
