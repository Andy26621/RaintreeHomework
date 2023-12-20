<?php

require_once 'Patient.php';
require_once 'Insurance.php';

$host = 'localhost';
$username = 'andydev';
$password = 'Wy(R*C@D)@JY8jNY';
$database = 'raintree_homework';
// db conn
$mysqli = new mysqli($host, $username, $password, $database);

// db check
if ($mysqli->connect_error) {
    exit('Connection failed: '.$mysqli->connect_error);
}

$query = 'SELECT 
            patient._id, patient.pn,
            patient.first, patient.last,
            insurance._id AS insurance_id,
            insurance.iname, insurance.from_date,
            insurance.to_date
          FROM 
            patient
          JOIN 
            insurance ON patient._id = insurance.patient_id
          ORDER BY patient._id';

$result = $mysqli->query($query);

// creation of patient/insurance objects
$patients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $patientId = $row['_id'];
        $pn = $row['pn'];
        $firstName = $row['first'];
        $lastName = $row['last'];

        // create patient and add that patient to array
        if (!isset($patients[$patientId])) {
            $patients[$patientId] = new Patient($patientId, $pn, $firstName, $lastName, []);
        }

        // create insurance and add that insurance to a patient
        if (!empty($row['insurance_id'])) {
            $insuranceId = $row['insurance_id'];
            $insuranceName = $row['iname'];
            $fromDate = $row['from_date'];
            $toDate = $row['to_date'];

            $insurance = new Insurance($insuranceId, $pn, $insuranceName, $fromDate, $toDate);
            $patients[$patientId]->addInsuranceRecord($insurance);
        }
    }
}

$today = date('m-d-y'); // todays date

// testing a patient object
// print_r($patients[1]);
// Print patient and insurance information

foreach ($patients as $patient) {
    $patient->printInsuranceTable($today);
}

$mysqli->close();
