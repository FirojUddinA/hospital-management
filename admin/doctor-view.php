<?php


include '../config.php';
if (isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);
//        make query
    $sql = "SELECT d.f_name, d.l_name, d.phone,d.address, d.sex, doc.specialist_at,doc.room_no,
       doc.fees, doc.off_day, doc.starting_time,doc.end_time, u.email, u.id
FROM doctors as doc , details as d, users as u
WHERE doc.user_id = $id and d.user_id = $id and doc.user_id = u.id";

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);

}

$s_id =$doc['specialist_at'];

$sql_sp = "SELECT * FROM `doc_specialist` WHERE id = '$s_id'";
//        seve to db and check
$result  = mysqli_query($conn, $sql_sp);
$specialist = mysqli_fetch_assoc($result);



?>


<?php include "templates/admin-header.php"; ?>

<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>Doctors details</title>
</head>
<body>

<div class="wrapper">

    <?php include "templates/admin-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Doctor Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">View Doctors</li>
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
                            <div class="card-header"><h2>Doctor Information </h2></div>
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
                        <div class="card">
                            <div class="card-header"><h2>Doctor Time Shedule </h2></div>
                            <div class="card-body">
                                <p class="lead">Specialist: <?php echo htmlspecialchars($specialist['specialist_at']); ?></p>
                                <p class="lead">Fees: <?php echo htmlspecialchars($doc['fees']); ?> Taka</p>
                                <p class="lead">Room No: <?php echo htmlspecialchars($doc['room_no']); ?></p>
                                <p class="lead">off_day: <?php echo htmlspecialchars($doc['off_day']); ?></p>
                                <p class="lead">Time: <?php echo htmlspecialchars($doc['starting_time']) . " to ". htmlspecialchars($doc['end_time']); ?></p>
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
