<?php include "templates/doctor-header.php"; ?>
<?php

include '../config.php';

$user_id = 0;
if (isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

}




$sql = "SELECT a.id, a.email,a.created_at,  d.f_name, d.l_name, d.phone, d.sex, d.address
FROM users as a , details as d
WHERE d.user_id = '$user_id'  and a.id =  '$user_id'" ;

    $result  = mysqli_query($conn, $sql);

    $doc = mysqli_fetch_assoc($result);


?>




<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<title>Appointment details</title>
</head>
<body>

<div class="wrapper">

<?php include "templates/doctor-navigation.php"; ?>


    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">My profile</li>
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
                            <h2>Profile Information </h2>

                           
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                <p class="lead">Id: <?php echo htmlspecialchars($doc['id']); ?></p>
                            <p class="lead">First Name: <?php echo htmlspecialchars($doc['f_name']); ?></p>
                            <p class="lead">Last Name: <?php echo htmlspecialchars($doc['l_name']); ?></p>
                            <p class="lead">Email : <?php echo htmlspecialchars($doc['email']); ?></p>
                            <p class="lead">Join date: <?php echo htmlspecialchars($doc['created_at']); ?></p>
                            
                                </div>
                                <div class="col-md-6">
                                <p class="lead">Phone: <?php echo htmlspecialchars($doc['phone']); ?></p>
                            <p class="lead">Sex:  <?php echo htmlspecialchars($doc['sex']); ?></p>
                            <p class="lead">Address: <?php echo htmlspecialchars($doc['address']); ?></p>
                           
                        
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

</body>
</html>
