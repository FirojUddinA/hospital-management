

<?php include "frontend/head.php"; ?>
<?php

include 'config.php';


if (isset($_GET['id'])){

    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query


    $sql = "SELECT a.id, a.user_id, a.doctor_id, a.ap_date, a.status, a.ap_time, a.created_at, d.f_name, 
       d.l_name, d.phone, d.sex, d.address, dc.specialist_at, dc.room_no, dc.fees , dc.off_day, dc.starting_time, dc.end_time
FROM appointment as a , details as d, doctors as dc
WHERE  d.user_id  = a.doctor_id  and dc.user_id = a.doctor_id and a.id = '$user_id'" ;

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);


    $s_id =$doc['specialist_at'];

    $sql_sp = "SELECT * FROM `doc_specialist` WHERE id = '$s_id'";
//        seve to db and check
    $result  = mysqli_query($conn, $sql_sp);
    $specialist = mysqli_fetch_assoc($result);
}


?>

<!-- ***** Header Area Start ***** -->
<?php include "frontend/navigation.php"; ?>




    <section class="content pt-5">
        <div class="container py-5 mt-5">
            <div class="row pt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2>Appointment Information </h2>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="lead">Appointment Id: <?php echo htmlspecialchars($doc['id']); ?></p>
                                    <p class="lead">Doctor Name: <?php echo htmlspecialchars($doc['f_name']); ?> <?php echo htmlspecialchars($doc['l_name']); ?></p>
                                    <p class="lead">Doctor's Speciality: <?php echo htmlspecialchars($specialist['specialist_at']); ?></p>
                                    <p class="lead">Date: <?php echo htmlspecialchars($doc['ap_date']); ?></p>
                                    <p class="lead">Time: <?php echo htmlspecialchars($doc['ap_time']); ?></p>
                                    <p class="lead">Created at: <?php echo htmlspecialchars($doc['created_at']); ?></p>
                                    <p class="lead <?php
                                    if($doc['status'] == 1){
                                        echo "bg-info" ;
                                    }else{
                                        echo "bg-denger" ;
                                    }
                                    ?>">Appointment Status: <?php
                                        if($doc['status'] == 1){
                                            echo '<span class=" badge badge-info">Approved</span>Approved' ;
                                        }else{
                                            echo '<span class=" badge badge-danger">unapproved</span>' ;
                                        }
                                        ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="lead">Doctor Phone: <?php echo htmlspecialchars($doc['phone']); ?></p>
                                    <p class="lead">Sex:  <?php echo htmlspecialchars($doc['sex']); ?></p>
                                    <p class="lead">Time: <?php echo htmlspecialchars($doc['starting_time']); ?> <?php echo htmlspecialchars($doc['end_time']); ?></p>
                                    <p class="lead">Off day: <?php echo htmlspecialchars($doc['off_day']); ?></p>
                                    <p class="lead">Doctor Fees: <?php echo htmlspecialchars($doc['fees']); ?> Taka</p>
                                    <p class="lead">Doctor Room No: <?php echo htmlspecialchars($doc['room_no']); ?></p>



                                </div>

                            </div>
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


<!-- ***** Emergency Area End ***** -->
<?php include "frontend/foot.php"; ?>


