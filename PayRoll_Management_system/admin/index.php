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

    <title>DASHBOARD</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        body {
            background-color: #ffd65b;
        }
    </style>
</head>

<body>
    <div class="container-fluid " style="height: 100vh;">
        <div class="row side-menu" style="height: 100vh;">
            <div class="col-3 bg-dark p-0">
                <h1 class="link-heding">reports</h1>
                <a class="link-heding2 active" href="./index.php"><i class="fad fa-tachometer-alt-slowest"></i> Dashboard</a>
                <h1 class="link-heding">manage</h1>
                <a class="link-heding2 text-decoration-none " href="./attendance.php"><i class="far fa-calendar-alt"></i> attendance</a>
                <a class="link-heding2 text-decoration-none " href="./Employees.php"><i class="fas fa-users"></i> Employees</a>

                <ul class="list-group">
                    <li class="list-group-item"><a href="./addEmp.php" class="alinks"><i class="far fa-address-card"> </i> Add Employee</a></li>
                    <li class="list-group-item"><a href="./TakeAttendance.php" class="alinks"><i class="fal fa-clipboard-user"></i> Take Attendance</a></li>
                </ul>
                <a class="link-heding2 text-decoration-none " href="./deduction.php"><i class="fas fa-file-alt"></i> deduction</a>
                <a class="link-heding2 text-decoration-none " href="./position.php"><i class="fas fa-briefcase"></i> position</a>
                <h1 class="link-heding">Printable</h1>
                <a class="link-heding2 text-decoration-none " href="./payroll.php"><i class="far fa-paste"></i> PayRoll</a>
            </div>
            <div class="col-9 ">
                <div class="row">
                    <div class="col-12 TableName-box d-flex justify-content-between">
                        <h1 class="TableName" id="TableName"><i class="fad fa-table"></i> Dashboard</h1>
                        <ul class="nav justify-content-end subNavbars">
                            <li class="nav-item">
                                <a class="nav-link " href=""><?php
                                                                if ($SessionBol) {
                                                                    echo $_SESSION["Uname"];
                                                                } else {
                                                                    echo "";
                                                                } ?></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" href="../logout.php"><i class="fad fa-sign-out-alt"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 pt-3">
                        <h1 class="text-capitalize fw-bold" style="color: #32383dfb;"> payRoll Management System</h1>
                    </div>
                    <div class="col-12 warning">

                        <div class="row p-5 d-flex justify-content-center flex-wrap">
                            <div class="card  m-2 " style="width: 45%;">
                                <img src="./images/salaerymg.png" class="card-img-top mt-2" alt="..." height="200px">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">salary management </h5>
                                </div>
                            </div>
                            <div class="card m-2 " style="width: 45%;">
                                <img src="./images/payroll.jpeg" class="card-img-top mt-2" alt="..." height="200px">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">PayRoll</h5>
                                </div>
                            </div>
                            <div class="card  m-2 " style="width: 45%;">
                                <img src="./images/attendance-management.png" class="card-img-top mt-2" alt="..." height="200px">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">attendance system</h5>
                                </div>
                            </div>



                            <div class="card  m-2 " style="width: 45%;">
                                <img src="./images/annie-spratt-hCb3lIB8L8E-unsplash.jpg" class="card-img-top mt-2" alt="..." height="200px">
                                <div class="card-body pb-0" style="font-size: 35px;
    font-weight: bold;">
                                    <h5 class="card-title">Employees details</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>

</html>