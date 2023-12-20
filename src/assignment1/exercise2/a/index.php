<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\a;

require_once 'DatabaseConnection.php';
require_once 'PatientData.php';

$dbConnection = new DatabaseConnection('localhost', 'andydev', 'Wy(R*C@D)@JY8jNY', 'raintree_homework');

$fetcher = new PatientData($dbConnection);

try {
    $patientData = $fetcher->getPatientData();

    foreach ($patientData as $row) {
        echo "{$row['Patient Number']}, {$row['Patient Last Name']}, {$row['Patient First Name']}, {$row['Insurance Name']}, {$row['Insurance From Date']}, {$row['Insurance To Date']}\n";
    }
} catch (\Exception $e) {
    echo 'Error: '.$e->getMessage();
}
