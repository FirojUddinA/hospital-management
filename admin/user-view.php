<?php


include '../config.php';
if (isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query
    $sql = "SELECT d.f_name, d.l_name, d.phone, d.address, d.sex, u.email, u.id
FROM  details as d join users as u
on (d.user_id = '$id')  and u.id = '$id'";

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);

}


?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>User details</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Patient Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">View Patient</li>
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
                            <div class="card-header"><h2>Patient Information </h2></div>
                            <div class="card-body">
                                <p class="lead">Id: <?php echo htmlspecialchars($doc['id']); ?></p>
                                <p class="lead">Name: <?php echo htmlspecialchars($doc['f_name']) ." ". htmlspecialchars($doc['l_name']) ?></p>
                                <p class="lead">Email: <a href="mailto:<?php echo htmlspecialchars($doc['email']); ?>"><?php echo htmlspecialchars($doc['email']); ?></a></p>
                                <p class="lead">Phone: <a href="tel:<?php echo htmlspecialchars($doc['phone']); ?>"><?php echo htmlspecialchars($doc['phone']); ?></a></p>
                                <p class="lead">Gender: <?php echo htmlspecialchars($doc['sex']); ?></p>
                                <p class="lead">Address: <?php echo htmlspecialchars($doc['address']); ?></p>
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
