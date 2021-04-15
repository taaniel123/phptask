<?php

include("PatientRecord.php");

$host     = "localhost";
$username = "root";
$password = "";
$database = "testtask";
// Create connection
if ($conn = new mysqli($host, $username, $password, $database)) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
    } else {
        $query = "SELECT pn FROM patient;";
        foreach ($conn->query($query) as $row) {
            $patient = new Patient($row["pn"]);
            $patient->print_insurance_records(date("m-d-y"));
        }
    }
}

?>