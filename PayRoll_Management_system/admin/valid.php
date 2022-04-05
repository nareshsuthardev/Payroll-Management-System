<?php
$YG = false;
if (isset($_POST['log'])) {
   include './conn.php';
   function NotValid()
   {
      header("location: http://localhost/PayRoll_Management_system/index.html");
   }
   $username = $_POST["username"];
   $password = $_POST["passworsd"];

   $sql = "SELECT   emp_id  name FROM   employee   WHERE name= '$username' AND emp_id= $password";
   $result = mysqli_query($conn, $sql) or (NotValid());
   $row = mysqli_num_rows($result);

   if ($row == 1) {
      $SessionBol = true;
      session_start();
      $_SESSION["Uname"] = $username;
      header("location: http://localhost/PayRoll_Management_system/admin/");
   } else {

      $SessionBol = false;
      echo $SessionBol;
      echo "NOT Valid!!";
   }
   echo $SessionBol;
}
