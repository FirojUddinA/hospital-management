<?php


include '../config.php';

$email  = $phone = $f_name = $l_name = $address = $gender =$room_no= $specialist_at= $off_day= $starting_time = $end_time = $fees = '';
$errors = ['email'=>'','room_no'=>'','off_day'=>'','end_time'=>'','fees'=>'','specialist_at'=>'','starting_time'=>'','ep'=>'','f_name' =>'', 'l_name'=>'','phone'=>'','address'=>'','gender'=>'', 'ef' => ''];

if (isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query
    $sql = "SELECT d.f_name, d.l_name, d.phone,d.address, d.sex, doc.specialist_at,doc.room_no,
       doc.fees, doc.off_day, doc.starting_time,doc.end_time, u.email, u.id
FROM doctors as doc , details as d, users as u
WHERE doc.user_id = $id and d.user_id = $id and doc.user_id = u.id";

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);

    $email = $doc['email'];
    $f_name = $doc['f_name'];
    $l_name = $doc['l_name'];
    $phone = $doc['phone'];
    $gender = $doc['sex'];
    $address = $doc['address'];
    $specialist_at = $doc['specialist_at'];
    $room_no = $doc['room_no'];
    $fees = $doc['fees'];
    $off_day = $doc['off_day'];
    $starting_time = $doc['starting_time'];
    $end_time = $doc['end_time'];


}


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


    if(empty($_POST['specialist_at'])){
        $errors['specialist_at'] = "Gender is required";
    }else{
        $specialist_at = $_POST['specialist_at'];
    }


    if(empty($_POST['fees'])){
        $errors['fees'] = "Phone is required";
    }else{

        $fees = htmlspecialchars($_POST['fees']);
//        if (!preg_match('/^[0-9\s]+$/', $fees)){
//            $fees = '';
//            $errors['fees'] = "Name must be letters and space only";
//        }

    }

    if(empty($_POST['room_no'])){
        $errors['room_no'] = "Room no is required";
    }else{
        $room_no = $_POST['room_no'];
    }
    if(empty($_POST['off_day'])){
        $errors['off_day'] = "off day is required";
    }else{
        $off_day = $_POST['off_day'];
    }
    if(empty($_POST['starting_time'])){
        $errors['starting_time'] = "Starting time is required";
    }else{
        $starting_time = $_POST['starting_time'];
    }
    if(empty($_POST['end_time'])){
        $errors['end_time'] = "end time is required";
    }else{
        $end_time = $_POST['end_time'];
    }

    if (!array_filter($errors)){

        $email = mysqli_real_escape_string($conn, $_POST['email']);

//       create sql
        $sql = "SELECT * FROM `users` WHERE email='$email'";

//        seve to db and check
        $user  = mysqli_query($conn, $sql);


        if ($user){
            $user = mysqli_fetch_array(mysqli_query($conn, $sql), MYSQLI_ASSOC);
            $user_id = $user['id'];
            $insert_user_details = "UPDATE details SET  f_name ='$f_name' ,  l_name ='$l_name',  address ='$address', 
                   sex '$gender' ,  phone '$phone' where  user_id = '$user_id'";

//       seve to db and check
            $insert_address  = mysqli_query($conn, $insert_user_details);

            $insert_doc_details = "UPDATE doctors SET  specialist_at= '$specialist_at', room_no = '$room_no', fees = '$fees', 
                      off_day = '$off_day', starting_time = '$starting_time', end_time ='$end_time'where  user_id = '$user_id'";

//       seve to db and check
            $insert_address  = mysqli_query($conn, $insert_doc_details);

            header("location: doctor-view.php?id=$user_id");

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
<title>Update Doctor</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Doctor</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Update Doctor</li>
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
                                <form action="doctor-update.php" class="p-4" method="POST">
                                    <?php
                                    if ($errors['ef'] != ''){
                                        echo '<p>'.$errors['ef'].'</p>';
                                    }
                                    ?>
                                    <div class="row">
                                        <div class="col-12 col-md-6  mb-3">
                                            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" readonly class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email)?>">
                                            <?php
                                            if ($errors['email'] != ''){
                                                echo '<p>'.$errors['email'].'</p>';
                                            }
                                            ?>
                                        </div>
<!--                                        <div class="col-12 col-md-6 mb-3">-->
<!--                                            <label for="password" class="form-label">Password<span class="text-danger">*</span></label>-->
<!--                                            <input type="password" readonly class="form-control" id="password" name="password" value="--><?php //echo htmlspecialchars($password)?><!--">-->
<!--                                            --><?php
//                                            if ($errors['password'] != ''){
//                                                echo '<p>'.$errors['password'].'</p>';
//                                            }
//                                            ?>
<!--                                        </div>-->
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

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">

                                            <div class="form-group">
                                                <label for="specialist_at" class="form-label">Specialist <span class="text-danger">*</span></label>
                                                <select class="custom-select form-control-border" name="specialist_at" >

                                                    <?php foreach ($specialist as $spe):?>
                                                        <option value="<?php echo htmlspecialchars($spe['id'])?>"><?php echo htmlspecialchars($spe['specialist_at'])?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div><?php
                                            if ($errors['specialist_at'] != ''){
                                                echo '<p>'.$errors['specialist_at'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="room_no" class="form-label">Room Number<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="room_no" name="room_no" value="<?php echo htmlspecialchars($room_no)?>">
                                            <?php
                                            if ($errors['room_no'] != ''){
                                                echo '<p>'.$errors['room_no'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="fees" class="form-label">Fees<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="fees" name="fees" value="<?php echo htmlspecialchars($fees)?>">
                                            <?php
                                            if ($errors['fees'] != ''){
                                                echo '<p>'.$errors['fees'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="off_day" class="form-label">Off Days<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control" id="off_day" name="off_day" value="<?php echo htmlspecialchars($off_day)?>">
                                            <?php
                                            if ($errors['off_day'] != ''){
                                                echo '<p>'.$errors['off_day'].'</p>';
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="starting_time" class="form-label">Start Form<span class="text-danger">*</span></label>
                                            <input type="time"  class="form-control" id="starting_time" name="starting_time" value="<?php echo htmlspecialchars($starting_time)?>">
                                            <?php
                                            if ($errors['starting_time'] != ''){
                                                echo '<p>'.$errors['starting_time'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <label for="end_time" class="form-label">End at<span class="text-danger">*</span></label>
                                            <input type="time"  class="form-control" id="end_time" name="end_time" value="<?php echo htmlspecialchars($end_time)?>">
                                            <?php
                                            if ($errors['end_time'] != ''){
                                                echo '<p>'.$errors['end_time'].'</p>';
                                            }
                                            ?>
                                        </div>
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
