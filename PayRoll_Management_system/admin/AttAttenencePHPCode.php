<?php
include "./conn.php";
$Emp_ID = $_GET['empid'];
$todayDtae = date("Y-m-d");
printf($Emp_ID);
$name = $attendance_name = $date_of_attendance = $attendance_status = "";
$sql = "SELECT * FROM employee WHERE emp_id = '$Emp_ID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        // echo $row["emp_id"];
        $name =     $row["name"];
    }
};
$attendance_status = "";
if (isset($_POST['Present'])) {
    $attendance_status =  "Present";
}
if (isset($_POST['Absent'])) {
    $attendance_status =  "Absent";
}



$AttCHECK = "SELECT * FROM attendance WHERE emp_id = '$Emp_ID'";
$resultAttCHECK = $conn->query($AttCHECK);
$co = 0;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $resultAttCHECK->fetch_assoc()) {
        echo "------------------" . $row["emp_id"] . "\n";

        if ($row['date_of_attendance'] == $todayDtae) {


            $co++;
        };

        // $name =     $row["name"];
    }
};
if ($co == 0) {
    $insertATTENDANCE =
        "INSERT INTO  attendance ( emp_id ,  attendance_name ,  date_of_attendance ,  working_hours ,  attendance_status ) VALUES (
    {$Emp_ID},'{$name}','{$todayDtae}','12','{$attendance_status}')";
    if ($conn->query($insertATTENDANCE) === TRUE) {
        header("location: http://localhost/PayRoll_Management_system/admin/TakeAttendance.php");
    } else {
        echo "Error: "  . "<br>" . $conn->error;
    }
} else {
    $update = "UPDATE  attendance  SET  attendance_status='{$attendance_status}' WHERE emp_id = $Emp_ID AND date_of_attendance= '$todayDtae'";
    echo $attendance_status;
    if ($conn->query($update) === TRUE) {
        header("location: http://localhost/PayRoll_Management_system/admin/TakeAttendance.php");
        echo "UPDATED ";
    } else {
        echo "Error: "  . "<br>" . $conn->error;
    }
}
$conn->close();
