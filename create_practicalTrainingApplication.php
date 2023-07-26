<?php

require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp


$sql = "CREATE TABLE IF NOT EXISTS practicalTrainingApplication(
		application_id INTEGER(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		company_name VARCHAR(30) NOT NULL,
		company_address VARCHAR(100) NOT NULL,
		company_phone VARCHAR(20) NOT NULL,
		company_email VARCHAR(30) NOT NULL,
		training_startdate DATE NOT NULL,
		training_enddate DATE NOT NULL,
		application_result VARCHAR(10) DEFAULT 'In Review' NOT NULL,
		stud_matric_no vARCHAR(10) NOT NULL,
		FOREIGN KEY (stud_matric_no) REFERENCES student(stud_matric_no))";

if (mysqli_query($conn, $sql)) {
  echo "<h3>Table practicalTrainingApplication created successfully</h3>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}
?>