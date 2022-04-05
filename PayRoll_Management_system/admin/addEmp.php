<!doctype html>
<html lang="en">
<?php

use function PHPSTORM_META\type;

include "./conn.php";
session_start();
$Staus_of_deduction = $Staus_of_salary = $Staus_of_payroll = $Staus_of_employee = false;
if (empty($_SESSION["Uname"])) {
    $SessionBol = false;
    header("location: http://localhost/PayRoll_Management_system/index.html");
} else {
    $SessionBol = true;
}
$LG_SALARY_ID;
$LG_DEDUCTION_ID;
$LG_PAYROLLS_ID;
$LG_EMPLOYEES_ID;
$transaction_id_f;

// ----------------------------------- GETTIN G LAGGE ID NUMBER FROM DEDUCTION TABLE
$Large_DED_ID = "SELECT * FROM deduction ORDER BY ded_id DESC LIMIT 0,1";
$LG_DED_ID = mysqli_query($conn, $Large_DED_ID);
if ($LG_DED_ID->num_rows > 0) {
    while ($row = $LG_DED_ID->fetch_assoc()) {
        $LG_DEDUCTION_ID = $row['ded_id'];
        $LG_DEDUCTION_ID = $LG_DEDUCTION_ID + 1;
    }
}
// ----------------------------------- GETTIN G LAGGE ID NUMBER FROM employee TABLE
$Large_EMP_ID = "SELECT * FROM employee ORDER BY emp_id  DESC LIMIT 0,1";
$LG_EMP_ID = mysqli_query($conn, $Large_EMP_ID);
if ($LG_EMP_ID->num_rows > 0) {
    while ($row = $LG_EMP_ID->fetch_assoc()) {
        $LG_EMPLOYEES_ID = $row['emp_id'];
        $LG_EMPLOYEES_ID = $LG_EMPLOYEES_ID + 1;
    }
}
// ----------------------------------- GETTIN G LAGGE ID NUMBER FROM salary TABLE
$Large_SALA_ID = "SELECT * FROM salary ORDER BY salary_id  DESC LIMIT 0,1";
$LG_SALA_ID = mysqli_query($conn, $Large_SALA_ID);
if ($LG_SALA_ID->num_rows > 0) {
    while ($row = $LG_SALA_ID->fetch_assoc()) {
        $LG_SALARY_ID = $row['salary_id'];
        $LG_SALARY_ID = $LG_SALARY_ID + 1;
    }
}
// ----------------------------------- GETTIN G LAGGE ID NUMBER FROM payroll TABLE
$Large_PAYROLL_ID = "SELECT * FROM payroll ORDER BY payroll_id  DESC LIMIT 0,1";
$LG_PAYROLL_ID = mysqli_query($conn, $Large_PAYROLL_ID);
if ($LG_PAYROLL_ID->num_rows > 0) {
    while ($row = $LG_PAYROLL_ID->fetch_assoc()) {
        $LG_PAYROLLS_ID =  $row['payroll_id'];
        $LG_PAYROLLS_ID = $LG_PAYROLLS_ID + 1;
        $transaction_id = $row['transaction_id'];
        $transaction_id  = (int)$transaction_id;
        $transaction_id_f = "ABCD" . $transaction_id;
    }
}
$transID = "ABCD" . strval($LG_PAYROLLS_ID);
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['ADDEMP'])) {
        $pos_id  = $_POST['postid'];
        $Emp_id =  $LG_EMPLOYEES_ID;
        $payroll_id = $LG_PAYROLLS_ID;
        $salary_id = $LG_SALARY_ID;
        $ded_id = $LG_DEDUCTION_ID;
        $pfAmount = $_POST['pfAmount'];
        $advanced_salary_amount = $_POST['advanced_salary_amou'];
        $loan_amount = $_POST['loan_amou'];
        $total_ded = (int)$pfAmount + (int)$advanced_salary_amount + (int)$loan_amount;
        $total_salary = 150000;
        if ($_POST['EMP_NAME'] == "" || $_POST['EMP_EMAIL'] == "") {
        } else {
            // ------------------------------------------------------- INSERTION TO DEDUCTION  
            $inser_Ded = "INSERT INTO  deduction (ded_id,pf_amount,advanced_salary_amount,   loan_amount,total_ded) VALUES ( $LG_DEDUCTION_ID, $pfAmount, $advanced_salary_amount, $loan_amount, $total_ded)";
            $result_DED_INSERT = mysqli_query($conn, $inser_Ded);
            echo $result_DED_INSERT;
            if ($conn->query($inser_Ded) === TRUE) {
                ?>
                <script
                >
                alert("true by DECTIUION")</script>
                <?php
            }else{
                $Staus_of_deduction = true;
                ?>
                <script
                >
                alert("False by DECTIUION")</script>
                <?php
            }
            $Staus_of_deduction = true;
            // ------------------------------------------------------- INSERTION TO SALARY
            if ($Staus_of_deduction) {
                (int)$total_payroll = $total_salary - $total_ded;
                $insert_salary = "INSERT INTO salary (salary_id,pos_id,total_salary,ded_id,net_salary) VALUES ( $LG_SALARY_ID, $pos_id,$total_salary,$LG_DEDUCTION_ID,$total_salary)";
                $transID = "ABCD" . strval($LG_PAYROLLS_ID);
                $result_SALARY_INSERT = mysqli_query($conn, $insert_salary);
                if ($conn->query($insert_salary) === TRUE) {
                    $Staus_of_salary = true;
                } else {
                    $Staus_of_salary = true;
                    // echo "Error: "  . "<br>" . $conn->error;
                }
                $p = "Unpaid";
                // ------------------------------------------------------- INSERTION TO PAYROLL
                $insert_payroll = "INSERT INTO payroll(payroll_id, total_payroll, transaction_id, payment_status) VALUES (
                    $LG_PAYROLLS_ID,$total_payroll,'{$transID}','UnPaid'
                    )";
                if ($conn->query($insert_payroll) === TRUE) {
                    $Staus_of_payroll = true;
                } else {
                    $Staus_of_payroll = true;
                    // echo "Error: "  . "<br>" . $conn->error;
                }
                // ------------------------------------------------------- INSERTION TO EMPLOYEES
                if ($Staus_of_payroll) {
                    $name  = $_POST['EMP_NAME'];
                    $email = $_POST['EMP_EMAIL'];
                    $hire_date = date("Y-m-d");
                    $insert_employee = "INSERT INTO employee(emp_id, name, email, hire_date, pos_id, payroll_id, salary_id, total_deduction) VALUES ($LG_EMPLOYEES_ID,'{$name}','{$email}','{$hire_date}',$pos_id ,$LG_PAYROLLS_ID,$LG_SALARY_ID,$total_ded)";
                    if ($conn->query($insert_employee) === TRUE) {
                        $Staus_of_employee = true;
                    } else {
                        $Staus_of_employee = false;
                        // echo "Error: "  . "<br>" . $conn->error;
                    }
                    $insetLeft = "UPDATE deduction SET emp_id = $LG_EMPLOYEES_ID WHERE ded_id = $LG_DEDUCTION_ID;";
                    $insetLeft .= "UPDATE salary SET emp_id=$LG_EMPLOYEES_ID WHERE salary_id= $LG_SALARY_ID;";
                    $insetLeft .= "UPDATE payroll SET emp_id=$LG_EMPLOYEES_ID WHERE payroll_id= $LG_PAYROLLS_ID";

                    if ($conn->multi_query($insetLeft) === TRUE) {
                      } else {
                      }
?>
                    <script>
                        window.location = "./index.php";
                    </script>
<?php

                }
            }
        }
        $conn->close();
    }
} else {
}
?>

<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>ADD Employee</title>
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
                <a class="link-heding2 " href="./index.php"><i class="fad fa-tachometer-alt-slowest"></i> Dashboard</a>
                <h1 class="link-heding">manage</h1>
                <a class="link-heding2 text-decoration-none " href="./attendance.php"><i class="far fa-calendar-alt"></i> attendance</a>
                <a class="link-heding2 text-decoration-none " href="./Employees.php"><i class="fas fa-users"></i> Employees</a>

                <ul class="list-group">
                    <li class="list-group-item active"><a href="./addEmp.php" class="alinks"><i class="far fa-address-card"> </i> Add Employee</a></li>
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
                        <h1 class="TableName" id="TableName"><i class="fad fa-table"></i> Create Employee</h1>
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
                    <div class="col-12  pb-5">
                        <div class="row px-5 pb-3 d-flex justify-content-center flex-wrap">
                            <form class="row g-3" method="POST" action="./addEmp.php">
                                <div class="form-floating col-6">
                                    <input class="form-control " placeholder="Employee Name" id="floatingInput10" name="emp_idd" value="<?php echo $LG_EMPLOYEES_ID; ?>" disabled>
                                    <label for="floatingInput10">Employee ID</label>
                                </div>
                                <div class="form-floating col-6">
                                    <input type="text" class="form-control " placeholder="Employee Name" id="floatingInput" name="EMP_NAME" required>
                                    <label for="floatingInput">Employee Name</label>
                                </div>
                                <div class="form-floating col-md-6">
                                    <input type="email" class="form-control" placeholder="Email Address" id="floatingInput1" name="EMP_EMAIL" required>
                                    <label for="floatingInput1">Email Address</label>
                                </div>
                                <div class="form-floating col-md-6">
                                    <input type="date" class="form-control hh" placeholder="Hire Date" id="floatingInput2" name="EMP_HR">
                                </div>
                                <div class="form-floating col-md-6 g" >
                                    <select id="inputState" name="postid" class="form-select" required>
                                        <option value="1">Programmmer</option>
                                        <option value="2">Systems Engineer</option>
                                        <option value="3">HR</option>
                                    </select>
                                </div>

                                <div class="form-floating col-6">
                                    <input type="text" class="form-control" placeholder="PayRoll" id="ID" name="EMP_PAY" value="<?php echo $LG_PAYROLLS_ID + 1 ?>" disabled>
                                    <label for="floatingInput4">PayRoll ID</label>
                                </div>
                                <!-- <div class="form-floating col-6">
                                    <input type="text" class="form-control " id="floatingInput9" name="EMP_DED">
                                    <label for="floatingInput9">Total Deduction</label>
                                </div> -->
                                <h1>DEDUCTION DETAILS</h1>
                                <div class="form-floating col-6">
                                    <input type="email" class="form-control" id="floatingDEDID" value="<?php echo $LG_DEDUCTION_ID; ?>" disabled>
                                    <label for="floatingDEDID">Deduction ID</label>
                                </div>
                                <div class="form-floating col-6">
                                    <input type="number" class="form-control" id="Provident" name="pfAmount" required>
                                    <label for="Provident">Provident Fund Amount</label>
                                </div>

                                <div class="form-floating col-6">
                                    <input type="number" class="form-control" id="loan_amount" name="loan_amou">
                                    <label for="loan_amount" required>LoanAmount</label>
                                </div>
                                <div class="form-floating col-6">
                                    <input type="number" class="form-control" id="advanced_salary_amount" name="advanced_salary_amou" required>
                                    <label for="advanced_salary_amount">Advanced Salary Amount</label>
                                </div>

                                <h1>SALARY DETAILS</h1>
                                <div class="form-floating col-6">
                                    <input type="text" class="form-control" placeholder="Salaery ID" id="floatingInput3" name="EMP_SAL" value="<?php echo $LG_SALARY_ID + 1; ?>" disabled>
                                    <label for="floatingInput3">Salaery ID</label>
                                </div>
                                <div class="form-floating col-6">
                                    <input type="number" class="form-control" id="Total_amount" name="Total_amount" value="150000" disabled>
                                    <label for="advanced_salary_amount">Total Salary</label>
                                </div>
                                <h1>PAYROLL DETAILS</h1>

                                <div class="form-floating col-6">
                                    <input type="text" class="form-control" id="transaction_id_f" name="transaction_id_f" value="<?php echo $transID; ?>" maxlength=100>
                                    <label for="advanced_salary_amount">transaction ID</label>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="ADDEMP" class="btn btn-primary" id="add">ADD Employee</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        select,
        option {
            background-color: #ffde7c;
        }

        option,
        input,
        #floatingDEDID,
        #Provident {
            background-color: #ffde7c;
            font-weight: bold;
        }

        option,
        label {
            margin-left: 10px;
            font-weight: bold;
            text-transform: capitalize;
            letter-spacing: 1.5px;
            color: #242729e8;
        }

        #floatingInput,
        #floatingInput1,
        #floatingInput2,
        #floatingInput3,
        #floatingInput4,
        #floatingInput5,
        #ID,
        #transaction_id_f,
        body>div>div>div.col-9>div>div.col-12.pb-5>div>form>div:nth-child(7)>input,
        #inputState,
        #advanced_salary_amount,
        #loan_amount,
        #floatingInput9,
        #Total_amount,
        #floatingInput10 {
            background-color: #ffde7c;
            font-weight: bold;
        }
    </style>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script>
        // document.getElementById("add").addEventListener("click", () => {
        //     alert("gg");
        //     document.querySelector("#floatingInput").value = "";
        // })
        window.onload(() => {
            alert("gg");

            document.querySelector("#floatingInput").value = "";
            document.querySelector("#floatingInput1").value = "";
        })
    </script>
</body>

</html>