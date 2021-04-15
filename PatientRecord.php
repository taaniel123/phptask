<?php

interface PatientRecord {
    public function return_id();
    public function return_pn();
}

class Patient implements PatientRecord{
    private $_id;
    private $pn;
    private $first;
    private $last;
    private $dob;
    private $insurance_records = array();
    
    function __construct($pn){
        $host     = "localhost";
        $username = "root";
        $password = "";
        $database = "testtask";
        // Create connection
        if ($conn = new mysqli($host, $username, $password, $database)) {
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                
            } else {
                // Create queries
                $query = "SELECT * FROM patient WHERE pn = '" . $pn . "';";
                foreach ($conn->query($query) as $row) {
                    $this->_id   = $row['_id'];
                    $this->pn    = $row['pn'];
                    $this->first = $row['first'];
                    $this->last  = $row['last'];
                    $this->dob   = $row['dob'];
                }
                $insurance_query = "SELECT _id FROM insurance WHERE patient_id = " . $this->_id . ";";
                foreach ($conn->query($insurance_query) as $row) {
                    $insurance = new Insurance($row['_id']);
                    array_push($this->insurance_records, $insurance);
                }
            }
        }
    }
    
    function return_id(){
        return $this->_id;
    }
    
    function return_pn(){
        return $this->pn;
    }
    
    function return_name(){
        return $this->first . " " . $this->last;
    }
    
    function return_insurances(){
        return $this->insurance_records;
    }
    
    function print_insurance_records($date){
        foreach ($this->insurance_records as $insurance) {
            if ($insurance->is_valid($date)) {
                $is_valid = "Yes";
            } else {
                $is_valid = "No";
            }
            printf("%s, %s, %s, %s\n", $this->return_pn(), $this->return_name(), $insurance->return_iname(), $is_valid);
        }
    }
}

class Insurance implements PatientRecord{
    private $_id;
    private $pn;
    private $patient_id;
    private $iname;
    private $from_date;
    private $to_date;
    
    function __construct($_id){
        $host     = "localhost";
        $username = "root";
        $password = "";
        $database = "testtask";
        // Create connection
        if ($conn = new mysqli($host, $username, $password, $database)) {
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                
            } else {
                // Create query
                $query = "SELECT i._id, p.pn, i.patient_id, i.iname, i.from_date, i.to_date FROM insurance AS i JOIN patient AS p ON i.patient_id = p._id WHERE i._id = " . $_id . ";";
                foreach ($conn->query($query) as $row) {
                    $this->_id        = $row['_id'];
                    $this->pn         = $row['pn'];
                    $this->patient_id = $row['patient_id'];
                    $this->iname      = $row['iname'];
                    $this->from_date  = $row['from_date'];
                    $this->to_date    = $row['to_date'];
                }
            }
        }
    }
    
    function return_id(){
        return $this->_id;
    }
    
    function return_pn(){
        return $this->pn;
    }
    
    function return_iname(){
        return $this->iname;
    }
    
    function is_valid($date){
        $new_date  = DateTime::createFromFormat("m-d-y", $date);
        $from_date = DateTime::createFromFormat("Y-m-d", $this->from_date);
        $to_date   = DateTime::createFromFormat("Y-m-d", $this->to_date);
        if ($new_date >= $from_date && $new_date <= $to_date) {
            return true;
        } else {
            return false;
        }
    }
}

?>