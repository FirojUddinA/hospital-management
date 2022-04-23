<?php


include '../config.php';

$sql = "SELECT id, user_id, doctor_id, ap_date, status, ap_time
 FROM appointment ORDER BY status ASC, ap_date ASC " ;

$result  = mysqli_query($conn, $sql);

$doc = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);
//close the connection
mysqli_close($conn);


?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>All appointments</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All appointments</h1>
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
                                        <th>Patient Id</th>
                                        <th>Doctor Id</th>
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
                                            <td><?php echo $item['user_id'];?></td>
                                            <td><?php echo $item['doctor_id'];?></td>
                                            <td><?php echo $item['ap_date'];?></td>
                                            <td><?php echo $item['ap_time'];?></td>
                                            <td>
                                                <a href="appointment-view.php?id=<?php echo $item['id'];?>" class="btn btn-info">View</a>
                                                <a href="appointment-update.php?id=<?php echo $item['id'];?>" 
                                                class="btn btn-warning"><?php

                                                if($item['status'] ==1){
                                                    echo "approved";
                                                }else {
                                                    echo "approve";
                                                }

                                                ?></a>

                                                <a href="appointment-delete.php?id=<?php echo $item['id'];?>" class="btn btn-danger">delete</a>

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

    <?php include "templates/admin-footer.php"; ?>
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