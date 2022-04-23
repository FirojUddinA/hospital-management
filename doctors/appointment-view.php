
<?php include "templates/doctor-header.php"; ?>
<?php

include '../config.php';
$user_id=0;

if (isset($_GET['id'])){

    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query


}


$sql = "SELECT a.id, a.user_id, a.doctor_id, a.ap_date, a.status, a.ap_time, a.created_at, d.f_name, d.l_name, d.phone, d.sex, d.address
FROM appointment as a , details as d
WHERE a.user_id = d.user_id and a.user_id = '$user_id'
ORDER BY status ASC" ;

$result  = mysqli_query($conn, $sql);

$doc = mysqli_fetch_assoc($result);

//free result from memory
mysqli_free_result($result);
//close the connection
mysqli_close($conn);


?>

<?php


?>


<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">


<title>Admin dashboard</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/doctor-navigation.php"; ?>

       

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
                        <div class="card-header"><h2>Appointment Information </h2></div>
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

  
    <?php include "templates/doctor-footer.php"; ?>

    <script  src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/plugins/jszip/jszip.min.js"></script>
    <script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>
</html>