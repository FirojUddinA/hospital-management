<?php


include '../config.php';
if (isset($_GET['id'])){

    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query
   
$sql = "SELECT a.id, a.user_id, a.doctor_id, a.ap_date, a.status, a.ap_time, a.created_at, d.f_name, d.l_name, d.phone, d.sex, d.address
FROM appointment as a , details as d
WHERE a.user_id = d.user_id and a.user_id = '$user_id'
ORDER BY status ASC" ;

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);

}


?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>Appointment details</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Appointment Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">View Appointment</li>
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
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h2>Appointment Information </h2>

                            <?php

                                if($doc['status'] !=1){
                                    ?>
                                    <a href="appointment-update.php?id=<?php echo $doc['id'];?>" 
                                class="btn btn-warning"> Approve Now</a>

                                    <?php
                                }

                            ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="lead">Id: <?php echo htmlspecialchars($doc['id']); ?></p>
                            <p class="lead">Patient Id: <?php echo htmlspecialchars($doc['user_id']); ?></p>
                            <p class="lead">Name: <?php echo htmlspecialchars($doc['f_name']); ?></p>
                            <p class="lead">Date: <?php echo htmlspecialchars($doc['ap_date']); ?></p>
                            <p class="lead">Time: <?php echo htmlspecialchars($doc['ap_time']); ?></p>
                            <p class="lead">Created at: <?php echo htmlspecialchars($doc['created_at']); ?></p>
                            
                                </div>
                                <div class="col-md-6">
                                <p class="lead">Phone: <?php echo htmlspecialchars($doc['phone']); ?></p>
                            <p class="lead">Sex:  <?php echo htmlspecialchars($doc['sex']); ?></p>
                            <p class="lead">Address: <?php echo htmlspecialchars($doc['address']); ?></p>
                           
                            <p class="lead <?php 
                                if($doc['status'] == 1){
                                    echo "bg-info" ;
                                }else{
                                    echo "bg-denger" ;
                                }
                            ?>">Status: <?php 
                                if($doc['status'] == 1){
                                    echo '<span class=" badge badge-info">Approved</span>Approved' ;
                                }else{
                                    echo '<span class=" badge badge-danger">unapproved</span>' ;
                                }
                            ?></p>
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

    </div>

    <?php include "templates/admin-footer.php"; ?>

</body>
</html>
