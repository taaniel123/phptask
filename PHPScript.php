<?php

$host     = "localhost";
$username = "root";
$password = "";
$database = "testtask";

// Create connection
if ($conn = new mysqli($host, $username, $password, $database)) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        
    } else {
        // Create query and print results
        $query  = "SELECT p.pn, p.last, p.first, i.iname, DATE_FORMAT(i.from_date, '%m-%d-%y') from_date, DATE_FORMAT(i.to_date, '%m-%d-%y') to_date FROM patient AS p LEFT JOIN insurance AS i ON p._id=i.patient_id ORDER BY i.from_date ASC, p.last ASC";
        $result = $conn->query($query);
        echo "Patient data:\n";
        while ($row = $result->fetch_assoc()) {
            printf("%s, %s, %s, %s, %s, %s\n", $row['pn'], $row['last'], $row['first'], $row['iname'], $row['from_date'], $row['to_date']);
        }
        
        
        // Create statistics and print results
        $query  = "SELECT CONCAT(first, last) AS full_name FROM patient";
        $result = $conn->query($query);
        $row    = $result->fetch_assoc();
        if ($result) {
            $full_string        = "";
            $full_string_length = 0;
            while ($row = $result->fetch_assoc()) {
                $full_string .= $row['full_name'];
            }
            $full_string        = strtoupper($full_string);
            $full_string_length = strlen($full_string);
            echo "\nHow many times each letter occurs in first and last names:\n";
            foreach (count_chars($full_string, 1) as $fs => $value) {
                $fs      = chr($fs);
                $percent = round(($value * 100) / $full_string_length, 2);
                echo ($fs), "\t", $value, "\t", $percent, "%\n";
            }
        }
    }
}

?> 