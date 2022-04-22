<?php


include '../config.php';

$sql = "SELECT d.f_name, d.l_name, d.phone, u.email, u.id
FROM details as d, users as u
WHERE d.user_id=u.id and u.role_id='4'";

$result  = mysqli_query($conn, $sql);

$doc = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);
//close the connection
mysqli_close($conn);


?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>All patients</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All patients</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">All patients</li>
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
                                        <th>Patient Id</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>email</th>
                                        <th>Phone</th>
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
                                            <td><?php echo $item['l_name'];?></td>
                                            <td><?php echo $item['email'];?></td>
                                            <td><?php echo $item['phone'];?></td>
                                            <td>
                                                <a href="user-view.php?id=<?php echo $item['id'];?>" class="btn btn-info">View</a>
                                                <a href="user-update.php?id=<?php echo $item['id'];?>" class="btn btn-warning">Update</a>
                                                <a href="user-delete.php?id=<?php echo $item['id'];?>" class="btn btn-danger">delete</a>

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