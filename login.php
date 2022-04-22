<?php
session_start();
include 'config.php';
$role = 0;
//if (isset($_SESSION['role'])){
//    $role =($_SESSION['role']);
//}
//if(isset($_SESSION['user']) && isset($_SESSION['role'])){
//    if ($role == 11202){
//        header('Location: admin/index.php');
//
//    }elseif ( $role == 11205){
//        header('Location: doctor/index.php');
//
//    }elseif ($role == 11206){
//        header('Location: employee/index.php');
//
//    }elseif ($role == 11209){
//        header('Location: index.php');
//    }
//}
$email = $password =  '';
$errors = ['email'=>'','password'=>'','ep'=>''];
if (isset($_POST['submit'])){

    if(empty($_POST['email'])){
        $errors['email'] = "An email Firld is required";
    }else{
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid email address";
        }
    }
    if(empty($_POST['password'])){
        $errors['password'] = "Title Firld is required";
    }else{
        $password = $_POST['password'];
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $password)){
            $errors['password'] = "Title must be letters and spaces only";
        }

    }


    if (!array_filter($errors)){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

//        create sql

        $sql = "SELECT * FROM `users` WHERE email='$email' AND password = '$password'";

//        seve to db and check
        $result  = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ($user){

//            print_r($result);

            $role_sql = "SELECT * FROM `user_role` WHERE id='{$user['role_id']}'";
            $user_role  = mysqli_fetch_array(mysqli_query($conn, $role_sql), MYSQLI_ASSOC);
//            print_r($user_role);
            $_SESSION['login']  = true;
            $_SESSION['user']  = ['id'=> $user['id'],'email'=>$user['email']];

            if ($user_role && $user_role['role_id'] == 11202){
                $_SESSION['role']  = 11202;
                header('Location: admin/index.php');
//                print_r($user_role);
            }elseif ( $user_role && $user_role['role_id'] == 11205){
                $_SESSION['role']  = 11205;
                header('Location: doctors/index.php');

            }elseif ($user_role && $user_role['role_id'] == 11206){
                $_SESSION['role']  = 11206;
                header('Location: employee/index.php');

            }elseif ($user_role && $user_role['role_id'] == 11209){
                $_SESSION['role']  = 11209;
                header('Location: index.php');

            }
        }else{
            $errors['ep'] = "Invalid email password";
        }

    }else{
        echo 'errors in the forms';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <!-- MDB icon -->
    <title>Sign In To Hospital</title>
    <link rel="icon" href="assets/img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <!-- Google Fonts Roboto -->
    <link  rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"/>
    <!-- MDB -->
    <link rel="stylesheet" href="assets/css/mdb.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />


</head>
<body class="sign">

    <section class="sign_container">
        <div class="sign_form">
           <div class="logo">
               <img src="assets/img/logo.svg" alt="hospital">
           </div>
            <div class="login_form mt ">
                <form action="login.php" class="p-4" method="POST">
                    <h2>Sign In</h2>
                    <?php
                    if ($errors['ep'] != ''){
                        echo '<p>'.$errors['ep'].'</p>';
                    }
                    ?>
                    <div class=" mb-4">
                        <label for="email" class="form-label">Your Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email)?>">
                        <?php
                        if ($errors['email'] != ''){
                            echo '<p>'.$errors['email'].'</p>';
                        }
                        ?>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Your Password</label>
                        <input type="password"  class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password)?>">
                        <?php
                        if ($errors['password'] != ''){
                            echo '<p>'.$errors['password'].'</p>';
                        }
                        ?>
                    </div>

                    <div class="center">
                        <input class="btn " type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <div class="sign_banner">
            <img src="assets/img/hospital.jpg" alt="">
        </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="assets/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <!-- Custom scripts -->
<!--    <script type="text/javascript" src="assets/js/main.js"></script>-->
</body>