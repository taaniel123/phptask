<?php

$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_DATABASE = "testtask";
//$total_letters = 0;
//$letters_array = array();

// Create connetion
$conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create query
$query = "SELECT p.pn, p.last, p.first, i.iname, i.from_date, i.to_date FROM patient AS p LEFT JOIN insurance AS i ON p._id=i.patient_id ORDER BY i.from_date ASC, p.last ASC";
$result = $conn->query($query);
echo "Results are: \n";
while ($row = $result->fetch_assoc()) {
        $patient_number = $row["pn"];
        $last_name = $row["last"];
        $first_name = $row["first"];
        $insurance_name = $row["iname"];
        $from_date = date('m-d-y', strtotime($row["from_date"]));
        $to_date = date('m-d-y', strtotime($row["to_date"]));
        echo $patient_number. ",\t" .$last_name. ",\t" .$first_name. ",\t" .$insurance_name. ",\t" .$from_date. ",\t" .$to_date;
    }



?> 