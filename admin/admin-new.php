<?php


include '../config.php';

$email = $password = $phone = $f_name = $l_name = $address = $gender =$room_no= $specialist_at= $off_day= $starting_time = $end_time = $fees = '';
$errors = ['email'=>'','room_no'=>'','off_day'=>'','end_time'=>'','fees'=>'','specialist_at'=>'','starting_time'=>'','password'=>'','ep'=>'','f_name' =>'', 'l_name'=>'','phone'=>'','address'=>'','gender'=>'', 'ef' => ''];
if (isset($_POST['submit'])){

    if(empty($_POST['email'])){
        $errors['email'] = "An email Firld is required";
    }else{
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email = '';
            $errors['email'] = "Invalid email address";
        }
    }
    if(empty($_POST['password'])){
        $errors['password'] = "Password field is required";
    }else{
        $password = $_POST['password'];
        if (!preg_match('/^[a-zA-Z0-9_\s]+$/', $password)){
            $password = '';
            $errors['password'] = "Password must be letters and number only";
        }

    }
    if(empty($_POST['f_name'])){
        $errors['f_name'] = "Password field is required";
    }else{
        $f_name = $_POST['f_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $f_name)){
            $f_name = '';
            $errors['f_name'] = "Name must be letters and space only";
        }

    }
    if(empty($_POST['l_name'])){
        $errors['f_name'] = "Password field is required";
    }else{
        $l_name = $_POST['l_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $l_name)){
            $l_name = '';
            $errors['l_name'] = "Name must be letters and space only";
        }

    }
    if(empty($_POST['phone'])){
        $errors['phone'] = "Phone is required";
    }else{
        $phone = htmlspecialchars($_POST['phone']);
        if (!preg_match('/^[0-9\s]+$/', $phone)){
            $phone = '';
            $errors['phone'] = "Name must be letters and space only";
        }

    }

    if(empty($_POST['address'])){
        $errors['address'] = "Phone is required";
    }else{
        $address = htmlspecialchars($_POST['address']);

    }

    if(empty($_POST['gender'])){
        $errors['gender'] = "Gender is required";
    }else{
        $gender = $_POST['gender'];
    }



    if (!array_filter($errors)){

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

//       create sql
        $sql = "SELECT * FROM `users` WHERE email='$email'";

//        seve to db and check
        $user  = mysqli_query($conn, $sql);

        if (!$user){
            $errors['email'] = 'Email not exist';
        }else{
            $errors['email'] = 'Email already exist';
        }

        $insert_query = "INSERT INTO users (role_id, email, password) VALUES ('1','$email','$password')";

//       seve to db and check
        $insert_user  = mysqli_query($conn, $insert_query);

//      seve to db and check

        if ($insert_user){
            $user = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
            $user_id = $user['id'];
            $insert_user_details = "INSERT INTO  details (user_id ,  f_name ,  l_name ,  address ,  sex ,  phone, admin_details ) VALUES ('$user_id','$f_name','$l_name','$address','$gender','$phone', 'true')";

//       seve to db and check
            $insert_address  = mysqli_query($conn, $insert_user_details);

            $insert_doc_details = "INSERT INTO  doctors (`user_id`, `specialist_at`, `room_no`, `fees`, 
                      `off_day`, `starting_time`, `end_time`) 
VALUES ('$user_id','$specialist_at','$room_no','$fees','$off_day','$starting_time', '$end_time')";

//       seve to db and check
            $insert_address  = mysqli_query($conn, $insert_doc_details);

            header('location: admin-all.php');

        }else{
            $errors['ef'] = 'Server is not responding. Please try again later!';
        }

    }else{
        $errors['ef'] = 'errors in the forms';
    }



}

$sql_sp = "SELECT * FROM doc_specialist";
//        seve to db and check
$result  = mysqli_query($conn, $sql_sp);
$specialist = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>Add New Doctor</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add New Doctor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Add New Doctor</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                <form action="admin-new.php" class="p-4" method="POST">
                                    <?php
                                    if ($errors['ef'] != ''){
                                        echo '<p>'.$errors['ef'].'</p>';
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-12 col-md-6  mb-3">
                                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email)?>">
                                            <?php
                                            if ($errors['email'] != ''){
                                                echo '<p>'.$errors['email'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                                            <input type="password"  class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password)?>">
                                            <?php
                                            if ($errors['password'] != ''){
                                                echo '<p>'.$errors['password'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="f_name" class="form-label">First name<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="f_name" name="f_name" value="<?php echo htmlspecialchars($f_name)?>">
                                            <?php
                                            if ($errors['f_name'] != ''){
                                                echo '<p>'.$errors['f_name'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="l_name" class="form-label">Last name<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="l_name" name="l_name" value="<?php echo htmlspecialchars($l_name)?>">
                                            <?php
                                            if ($errors['l_name'] != ''){
                                                echo '<p>'.$errors['l_name'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class=" col-12 col-md-6 mb-3">
                                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone)?>">
                                            <?php
                                            if ($errors['phone'] != ''){
                                                echo '<p>'.$errors['phone'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class=" col-12 col-md-6 nb-3">
                                            <label  class="form-label d-block">Gender <span class="text-danger">*</span></label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender" <?php echo $gender == 'male'? 'checked' : ''?> id="gender-male" value="male" />
                                                <label class="form-check-label" for="gender-male">Male</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"  <?php echo $gender == 'female'? 'checked' : ''?>  id="gender-female" value="female" />
                                                <label class="form-check-label" for="gender-female">Female</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="gender"  <?php echo $gender == 'other'? 'checked' : ''?>  id="gender-other" value="other" />
                                                <label class="form-check-label" for="gender-other">Other</label>
                                            </div>
                                            <?php
                                            if ($errors['gender'] != ''){
                                                echo '<p>'.$errors['gender'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                        <textarea type="text"  class="form-control" id="address" name="address" ><?php echo htmlspecialchars($address)?></textarea>
                                        <?php
                                        if ($errors['address'] != ''){
                                            echo '<p>'.$errors['address'].'</p>';
                                        }
                                        ?>
                                    </div>



                                    <div class="center">
                                        <input class="btn btn-block btn-lg btn-info" type="submit" name="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

    </div>

    <?php include "templates/admin-footer.php"; ?>

</body>
</html>
