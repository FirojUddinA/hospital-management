
<?php include "frontend/head.php"; ?>
<?php
//session_start();


include 'config.php';

$sql = "SELECT * FROM `doc_specialist`";
$result  = mysqli_query($conn, $sql);
// print_r($result);
$dsql = "SELECT dl.f_name, dl.l_name, d.user_id FROM details dl, doctors d WHERE dl.user_id = d.user_id AND d.specialist_at = '1'";
$dresult  = mysqli_query($conn, $dsql);


$role = 0;
$user_id=0;
if (isset($_SESSION['role'])) {
    $role = ($_SESSION['role']);
}
if (isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

}

//var_dump($_SESSION);


$speciality = $doctor_id = $date = $ap_time ='';
$errors = ['speciality'=>'','doctor_id'=>'','ap_date'=>'','ap_time' =>'','ef' =>''];


if (isset($_POST['submit'])){

    if ($user_id == 0){
        header('location: login.php');
    }else{
        if(empty($_POST['speciality'])){
            $errors['speciality'] = "An speciality Firld is required";
        }else{
            $speciality = $_POST['speciality'];
        }
        if(empty($_POST['doctor_id'])){
            $errors['doctor_id'] = "Doctor field is required";
        }else{
            $doctor_id = $_POST['doctor_id'];
        }
        if(empty($_POST['ap_date'])){
            $errors['ap_date'] = "Date field is required";
        }else{
            $date = $_POST['ap_date'];
        }
        if(empty($_POST['ap_time'])){
            $errors['ap_time'] = "Time field is required";
        }else{
            $ap_time = $_POST['ap_time'];

        }
        if (!array_filter($errors)){


            $insert_query = "INSERT INTO appointment( user_id, doctor_id, ap_date, ap_time, status) 
VALUES ('$user_id','$doctor_id','$date', '$ap_time',false );";



            $insert_user  = mysqli_query($conn, $insert_query);


            if ($insert_user){
                header('Location: thank-you.php');

            }else{
                $errors['ef'] = 'Server is not responding. Please try again later!';
            }

        }else{
            $errors['ef'] = 'errors in the forms';
        }

    }

}

?>

<!-- ***** Header Area Start ***** -->
<?php include "frontend/navigation.php"; ?>




<section class="hero-area">

    <div class="hero-slides owl-carousel">
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-img bg-overlay-white" style="background-image: url(frontend/img/bg-img/hero1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <h2 data-animation="fadeInUp" data-delay="100ms">Medical Services that <br>You can Trust 100%</h2>
                            <h6 data-animation="fadeInUp" data-delay="400ms">Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod.</h6>
                            <!--                                <a href="#" class="btn medilife-btn mt-50" data-animation="fadeInUp" data-delay="700ms">Discover Medifile <span>+</span></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-img bg-overlay-white" style="background-image: url(frontend/img/bg-img/breadcumb3.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <h2 data-animation="fadeInUp" data-delay="100ms">Medical Services that <br>You can Trust 100%</h2>
                            <h6 data-animation="fadeInUp" data-delay="400ms">Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod.</h6>
                            <!--                                <a href="#" class="btn medilife-btn mt-50" data-animation="fadeInUp" data-delay="700ms">Discover Medifile <span>+</span></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Single Hero Slide -->
        <div class="single-hero-slide bg-img bg-overlay-white" style="background-image: url(frontend/img/bg-img/breadcumb1.jpg);">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-slides-content">
                            <h2 data-animation="fadeInUp" data-delay="100ms">Medical Services that <br>You can Trust 100%</h2>
                            <h6 data-animation="fadeInUp" data-delay="400ms">Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod.</h6>
                            <!--                                <a href="#" class="btn medilife-btn mt-50" data-animation="fadeInUp" data-delay="700ms">Discover Medifile <span>+</span></a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Hero Area End ***** -->

<!-- ***** Book An Appoinment Area Start ***** -->
<style>
    .nice-select.disabled,.form-control:disabled, .form-control[readonly] {
        background-color: #e9ecef;
        background-color: transparent;
        border-color: #536174;
    }
</style>
<div class="medilife-book-an-appoinment-area" id="app_book">
    <div class="container">
        <?php
        if ($errors['ef'] != ''){
            echo '<p>'.$errors['ef'].'</p>';
        }
        ?>
        <div class="row">
            <div class="col-12">
                <div class="appointment-form-content">
                    <div class="row no-gutters align-items-center">
                        <div class="col-12 col-lg-9">
                            <div class="medilife-appointment-form">
                                <form action="index.php" method="POST">
                                    <div class="row align-items-end">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" id="speciality" name="speciality">
                                                    <option>Specialist at</option>
                                                    <?php while( $row = $result->fetch_assoc() ){?>
                                                        <option value="<?php echo "$row[id]" ?>"><?php echo "$row[specialist_at]" ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <?php
                                            if ($errors['speciality'] != ''){
                                                echo '<p>'.$errors['speciality'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" id="doctors" name="doctor_id" disabled>
                                                    <option>Doctor</option>
                                                    <?php while( $row = $dresult->fetch_assoc() ){?>
                                                        <option value="<?php echo "$row[user_id]" ?>"><?php echo "$row[f_name]" ?></option>
                                                    <?php }?>
                                                </select>

                                            </div>
                                            <?php
                                            if ($errors['doctor_id'] != ''){
                                                echo '<p>'.$errors['doctor_id'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6">

                                            <div class="form-group">
                                                <select class="form-control" id="date" name="ap_date" disabled>
                                                    <option>Select date</option>
                                                </select>
                                            </div>
                                            <?php
                                            if ($errors['ap_date'] != ''){
                                                echo '<p>'.$errors['ap_date'].'</p>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <select class="form-control" id="time" name="ap_time" disabled>
                                                    <option>Select time</option>
                                                    <?php while( $row = $dresult->fetch_assoc() ){?>
                                                        <option value="<?php echo "$row[user_id]" ?>"><?php echo "$row[f_name]" ?></option>
                                                    <?php }?>
                                                </select>
                                                <?php
                                                if ($errors['ap_time'] != ''){
                                                    echo '<p>'.$errors['ap_time'].'</p>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-5 mb-0">
                                            <div class="form-group mb-0">
                                                <input type="submit"  name="submit" class="btn medilife-btn" value="Make an Appointment ">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="medilife-contact-info pt-5 pb-5">
                                <!-- Single Contact Info -->
                                <!-- <div class="single-contact-info mb-30">
                                    <img src="frontend/img/icons/alarm-clock.png" alt="">
                                    <p>Mon - Sat 08:00 - 21:00 <br>Sunday CLOSED</p>
                                </div> -->
                                <!-- Single Contact Info -->
                                <div class="single-contact-info mb-30">
                                    <img src="frontend/img/icons/envelope.png" alt="">
                                    <p>0080 673 729 766 <br>contact@business.com</p>
                                </div>
                                <!-- Single Contact Info -->
                                <div class="single-contact-info">
                                    <img src="frontend/img/icons/map-pin.png" alt="">
                                    <p>Lamas Str, no 14-18 <br>41770 Miami</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Book An Appoinment Area End ***** -->

<!-- ***** About Us Area Start ***** -->
<section class="medica-about-us-area section-padding-100-20">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="medica-about-content">
                    <h2>We always put our pacients first</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing eli.</p>
                    <a href="#" class="btn medilife-btn mt-50">View the services <span>+</span></a>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="row">
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6">
                        <div class="single-service-area d-flex">
                            <div class="service-icon">
                                <i class="icon-doctor"></i>
                            </div>
                            <div class="service-content">
                                <h5>The Best Doctors</h5>
                                <p>Lorem ipsum dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6">
                        <div class="single-service-area d-flex">
                            <div class="service-icon">
                                <i class="icon-blood-donation-1"></i>
                            </div>
                            <div class="service-content">
                                <h5>Baby Nursery</h5>
                                <p>Dolor sit amet, consecte tuer elit, sed diam nonummy nibh euismod tincidunt ut ldolore magna.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6">
                        <div class="single-service-area d-flex">
                            <div class="service-icon">
                                <i class="icon-flask-2"></i>
                            </div>
                            <div class="service-content">
                                <h5>Laboratory</h5>
                                <p>Lorem ipsum dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Service Area -->
                    <div class="col-12 col-sm-6">
                        <div class="single-service-area d-flex">
                            <div class="service-icon">
                                <i class="icon-emergency-call-1"></i>
                            </div>
                            <div class="service-content">
                                <h5>Emergency Room</h5>
                                <p>Dolor sit amet, consecte tuer elit, sed diam nonummy nibh euismod tincidunt ut ldolore magna.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** About Us Area End ***** -->

<!-- ***** Cool Facts Area Start ***** -->
<section class="medilife-cool-facts-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Single Cool Fact-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-fact-area text-center mb-100">
                    <i class="icon-blood-transfusion-2"></i>
                    <h2><span class="counter">5632</span></h2>
                    <h6>Blood donations</h6>
                    <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                </div>
            </div>
            <!-- Single Cool Fact-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-fact-area text-center mb-100">
                    <i class="icon-atoms"></i>
                    <h2><span class="counter">23</span>k</h2>
                    <h6>Pacients</h6>
                    <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                </div>
            </div>
            <!-- Single Cool Fact-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-fact-area text-center mb-100">
                    <i class="icon-microscope"></i>
                    <h2><span class="counter">25</span></h2>
                    <h6>Specialities</h6>
                    <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                </div>
            </div>
            <!-- Single Cool Fact-->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-fact-area text-center mb-100">
                    <i class="icon-doctor-1"></i>
                    <h2><span class="counter">723</span></h2>
                    <h6>Doctors</h6>
                    <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Cool Facts Area End ***** -->

<!-- ***** Gallery Area Start ***** -->
<div class="medilife-gallery-area owl-carousel">
    <!-- Single Gallery Item -->
    <div class="single-gallery-item">
        <img src="frontend/img/bg-img/g1.jpg" alt="">
        <div class="view-more-btn">
            <a href="frontend/img/bg-img/g1.jpg" class="btn gallery-img">See More +</a>
        </div>
    </div>
    <!-- Single Gallery Item -->
    <div class="single-gallery-item">
        <img src="frontend/img/bg-img/g2.jpg" alt="">
        <div class="view-more-btn">
            <a href="frontend/img/bg-img/g2.jpg" class="btn gallery-img">See More +</a>
        </div>
    </div>
    <!-- Single Gallery Item -->
    <div class="single-gallery-item">
        <img src="frontend/img/bg-img/g3.jpg" alt="">
        <div class="view-more-btn">
            <a href="frontend/img/bg-img/g3.jpg" class="btn gallery-img">See More +</a>
        </div>
    </div>

    <!-- Single Gallery Item -->
    <div class="single-gallery-item">
        <img src="frontend/img/bg-img/g4.jpg" alt="">
        <div class="view-more-btn">
            <a href="frontend/img/bg-img/g4.jpg" class="btn gallery-img">See More +</a>
        </div>
    </div>
</div>
<!-- ***** Gallery Area End ***** -->

<!-- ***** Features Area Start ***** -->
<div class="medilife-features-area section-padding-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-6">
                <div class="features-content">
                    <h2>A new way to treat pacients in a revolutionary facility</h2>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer adipiscing eli.Lorem ipsum dolor sit amet, consec tetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet, consectetuer.</p>
                    <a href="#" class="btn medilife-btn mt-50">View the services <span>+</span></a>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="features-thumbnail">
                    <img src="frontend/img/bg-img/medical1.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Features Area End ***** -->

<!-- ***** Blog Area Start ***** -->
<div class="medilife-blog-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Single Blog Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area mb-100">
                    <!-- Post Thumbnail -->
                    <div class="blog-post-thumbnail">
                        <img src="frontend/img/blog-img/1.jpg" alt="">
                        <!-- Post Date -->
                        <div class="post-date">
                            <a href="#">Jan 23, 2018</a>
                        </div>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <div class="post-author">
                            <a href="#"><img src="frontend/img/blog-img/p1.jpg" alt=""></a>
                        </div>
                        <a href="#" class="headline">New drog release soon</a>
                        <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                        <a href="#" class="comments">3 Comments</a>
                    </div>
                </div>
            </div>
            <!-- Single Blog Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area mb-100">
                    <!-- Post Thumbnail -->
                    <div class="blog-post-thumbnail">
                        <img src="frontend/img/blog-img/2.jpg" alt="">
                        <!-- Post Date -->
                        <div class="post-date">
                            <a href="#">Jan 23, 2018</a>
                        </div>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <div class="post-author">
                            <a href="#"><img src="frontend/img/blog-img/p2.jpg" alt=""></a>
                        </div>
                        <a href="#" class="headline">Free dental care</a>
                        <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                        <a href="#" class="comments">3 Comments</a>
                    </div>
                </div>
            </div>
            <!-- Single Blog Area -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-blog-area mb-100">
                    <!-- Post Thumbnail -->
                    <div class="blog-post-thumbnail">
                        <img src="frontend/img/blog-img/3.jpg" alt="">
                        <!-- Post Date -->
                        <div class="post-date">
                            <a href="#">Jan 23, 2018</a>
                        </div>
                    </div>
                    <!-- Post Content -->
                    <div class="post-content">
                        <div class="post-author">
                            <a href="#"><img src="frontend/img/blog-img/p3.jpg" alt=""></a>
                        </div>
                        <a href="#" class="headline">Good news for the pacients</a>
                        <p>Dolor sit amet, consecte tuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
                        <a href="#" class="comments">3 Comments</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Blog Area End ***** -->

<!-- ***** Emergency Area Start ***** -->
<div class="medilife-emergency-area section-padding-100-50">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="emergency-content">
                    <i class="icon-smartphone"></i>
                    <h2>For Emergency calls</h2>
                    <h3>+12-823-611-8721</h3>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row">
                    <!-- Single Emergency Helpline -->
                    <div class="col-12 col-sm-6">
                        <div class="single-emergency-helpline mb-50">
                            <h5>London</h5>
                            <p>0080 673 729 766 <br> contact@business.com <br> Lamas Str, no 14-18 <br> 41770 Miami</p>
                        </div>
                    </div>
                    <!-- Single Emergency Helpline -->
                    <div class="col-12 col-sm-6">
                        <div class="single-emergency-helpline mb-50">
                            <h5>New Castle</h5>
                            <p>0080 673 729 766 <br> contact@business.com <br> Lamas Str, no 14-18 <br> 41770 Miami</p>
                        </div>
                    </div>
                    <!-- Single Emergency Helpline -->
                    <div class="col-12 col-sm-6">
                        <div class="single-emergency-helpline mb-50">
                            <h5>Manchester</h5>
                            <p>0080 673 729 766 <br> contact@business.com <br> Lamas Str, no 14-18 <br> 41770 Miami</p>
                        </div>
                    </div>
                    <!-- Single Emergency Helpline -->
                    <div class="col-12 col-sm-6">
                        <div class="single-emergency-helpline mb-50">
                            <h5>Bristol</h5>
                            <p>0080 673 729 766 <br> contact@business.com <br> Lamas Str, no 14-18 <br> 41770 Miami</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Emergency Area End ***** -->
<?php include "frontend/foot.php"; ?>