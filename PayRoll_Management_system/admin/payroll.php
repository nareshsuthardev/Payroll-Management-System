<!doctype html>
<html lang="en">
<?php
include "./conn.php";
session_start();
if (empty($_SESSION["Uname"])) {
    $SessionBol = false;
    header("location: http://localhost/PayRoll_Management_system/index.html");
} else {
    $SessionBol = true;
}
?>
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>PayRoll</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container-fluid " style="height: 100vh;">
        <div class="row side-menu" style="height: 100vh;">
            <div class="col-3 bg-dark p-0">
                <h1 class="link-heding">reports</h1>
                <a class="link-heding2" href="./index.php"><i class="fad fa-tachometer-alt-slowest"></i> Dashboard</a>                 <h1 class="link-heding">manage</h1>
                <a class="link-heding2 text-decoration-none " href="./attendance.php"><i class="far fa-calendar-alt"></i> attendance</a>
                <a class="link-heding2 text-decoration-none " href="./Employees.php"><i class="fas fa-users"></i> Employees</a>

                <ul class="list-group">
                    <li class="list-group-item"><a href="./addEmp.php" class="alinks"><i class="far fa-address-card"> </i> Add Employee</a></li>
                    <li class="list-group-item"><a href="./TakeAttendance.php" class="alinks"><i class="fal fa-clipboard-user"></i> Take Attendance</a></li>
                </ul>
                <a class="link-heding2 text-decoration-none " href="./deduction.php"><i class="fas fa-file-alt"></i> deduction</a>
                <a class="link-heding2 text-decoration-none " href="./position.php"><i class="fas fa-briefcase"></i> position</a>
                <h1 class="link-heding">Printable</h1>
                <a class="link-heding2 text-decoration-none active" href="./payroll.php"><i class="far fa-paste"></i> PayRoll</a>
            </div>
            <div class="col-9 ">
                <div class="row">
                    <div class="col-12 TableName-box">
                        <h1 class="TableName" id="TableName"><i class="fad fa-table"></i> Pyroll</h1>
                                                <ul class="nav justify-content-end subNavbars">
                            <li class="nav-item">
                                <a class="nav-link " href=""><?php
                                 if ($SessionBol == TRUE) {
                                                                    echo $_SESSION["Uname"];
                                                                }else{
                                                                    echo "";
                                                                } ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="../logout.php"><i class="fad fa-sign-out-alt"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 pt-5">
                    <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-warning">
                                    <th scope="col hed">Sr.No</th>
                                    <th scope="col hed">PayRoll ID</th>
                                    <th scope="col hed">Employee ID</th>
                                    <th scope="col hed">PayRoll Date</th>
                                    <th scope="col hed">Total PayRoll</th>
                                    <th scope="col hed">Transaction ID</th>
                                    <th scope="col hed">Payment Status</th>
                                </tr>
                            </thead>
                            <?php
                            $Empl_Table_Query = "SELECT * FROM payroll";
                            $result = $conn->query($Empl_Table_Query);
                            $count = 1;

                            ?>
                            <?php
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><?php echo $count++; ?></th>
                                            <td><?php echo $row["payroll_id"]  ?></td>
                                            <td><?php echo $row["emp_id"]  ?></td>
                                            <td><?php echo $row["payroll_date"]  ?></td>
                                            <td><?php echo $row["total_payroll"]  ?></td>
                                            <td><?php echo $row["transaction_id"]  ?></td>
                                            <td ><p class="alert alert-info mb-0 p-2 text-center text-uppercase fw-bold"><?php echo $row["payment_status"]  ?></p></td>
                                          
                                        </tr>
                                    </tbody>

                            <?php
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<style>
    td {
    font-weight: bold;
}
</style>
</body>

</html>