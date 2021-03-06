

<?php include "templates/doctor-header.php"; ?>
<?php


$user_id=0;
if (isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

}

include '../config.php';

$sql = "SELECT a.id, a.user_id, a.doctor_id, a.ap_date, a.status, a.ap_time, d.f_name, d.l_name, d.phone, d.sex, d.address
FROM appointment as a , details as d
WHERE a.user_id = d.user_id and a.doctor_id = '$user_id'
ORDER BY status ASC" ;

$result  = mysqli_query($conn, $sql);

$doc = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);
//close the connection
mysqli_close($conn);


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
                        <h1>All appointments  <?php echo $user_id;?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">All appointments</li>
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
                                <table id="example1" class="table table-hover table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Patient Name</th>
                                        <th>Phone Number</th>
                                        <th>Appointment Date</th>
                                        <th>Time(Created)</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($doc as $item){

                                    ?>
                                        <tr>
                                            <td><?php echo $item['id'];?></td>
                                            <td><?php echo $item['f_name'];?></td>
                                            <td><?php echo $item['phone'];?></td>
                                            <td><?php echo $item['ap_date'];?></td>
                                            <td><?php echo $item['ap_time'];?></td>
                                            <td>
                                                <a href="appointment-view.php?id=<?php echo $item['id'];?>" class="btn btn-info">View</a>
                                               

                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
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