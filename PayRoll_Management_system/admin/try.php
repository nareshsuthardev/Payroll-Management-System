$DROP_EMP_PAY_ID =  "ALTER TABLE employee DROP FOREIGN KEY employee_payroll_id";
        $DROP_EMP_POS_ID =  "ALTER TABLE employee DROP FOREIGN KEY employee_pos_id";
        $DROP_EMP_SAL_ID =  "ALTER TABLE employee DROP FOREIGN KEY employee_salary_id";

        // $RESULT = mysqli_query($conn, $DIASBLE) or die("dis");
        // $RESULUT_DROP_EMP_PAY_ID = mysqli_query($conn,$DROP_EMP_PAY_ID) or die("DROP OF DROP_EMP_PAY_ID  FAILED!");
        $RESULUT_DROP_EMP_POS_ID = mysqli_query($conn,$DROP_EMP_POS_ID) or die("DROP OF DROP_EMP_POS_ID FAILED!");
        $RESULUT_DROP_EMP_SAL_ID = mysqli_query($conn,$DROP_EMP_SAL_ID) or die("DROP OF DROP_EMP_SAL_ID FAILED!");
    //   echo  $RESULUT_DROP_EMP_PAY_ID ;
      echo  $RESULUT_DROP_EMP_POS_ID ;
      echo  $RESULUT_DROP_EMP_SAL_ID;

        $ADD_EMP_PAY_ID = "ALTER TABLE employee ADD CONSTRAINT employee_payroll_id_fk FOREIGN KEY (payroll_id) REFERENCES payroll (payroll_id)";
        $ADD_EMP_POS_ID = "ALTER TABLE employee ADD CONSTRAINT employee_pos_id_fk FOREIGN KEY (pos_id) REFERENCES position (pos_id)";
        $ADD_EMP_SAL_ID = "ALTER TABLE employee ADD CONSTRAINT employee_salary_id_fk FOREIGN KEY (salary_id) REFERENCES salary(salary_id)";