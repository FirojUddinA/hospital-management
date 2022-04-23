
<?php include "frontend/head.php"; ?>
<?php

include 'config.php';


$role = 0;
$user_id=0;
if (isset($_SESSION['role'])) {
    $role = ($_SESSION['role']);
}
$user_id=0;
if (isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];

}

//var_dump($_SESSION);


$sql = "SELECT id, user_id, doctor_id, ap_date, status, ap_time
 FROM appointment where user_id = '$user_id' ORDER BY status ASC, ap_date ASC " ;

$result  = mysqli_query($conn, $sql);

$doc = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);
//close the connection
mysqli_close($conn);


?>

<!-- ***** Header Area Start ***** -->
<?php include "frontend/navigation.php"; ?>



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
    <section class="content pt-5">
        <div class="container py-5 mt-5">
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
                                    <th>Status</th>
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
                                        <td >
                                            <?php
                                                if($item['status'] ==1){
                                                    echo "approved";
                                                }else {
                                                    echo "approve";
                                                }
                                            ?>
                                        </td>
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

<!-- ***** Emergency Area End ***** -->
<?php include "frontend/foot.php"; ?>


