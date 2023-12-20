<?php

$host = 'localhost';
$username = 'andydev';
$password = 'Wy(R*C@D)@JY8jNY';
$database = 'raintree_homework';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_errno) {
    echo 'Failed to connect to MySQL: '.$mysqli->connect_error;
    exit;
}

// Perform query
$sql = "SELECT 
            p.pn AS 'Patient Number',
            p.last AS 'Patient Last Name',
            p.first AS 'Patient First Name',
            i.iname AS 'Insurance Name',
            DATE_FORMAT(i.from_date, '%m-%d-%y') AS 'Insurance From Date',
            DATE_FORMAT(i.to_date, '%m-%d-%y') AS 'Insurance To Date'
        FROM 
            patient p
        JOIN 
            insurance i ON p._id = i.patient_id
        ORDER BY 
            i.from_date ASC, p.last ASC;
";

$result = $conn->query($sql);

// Process data
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "{$row['Patient Number']}, {$row['Patient Last Name']}, {$row['Patient First Name']}, {$row['Insurance Name']}, {$row['Insurance From Date']}, {$row['Insurance To Date']}\n";
    }
    $result->free();
} else {
    echo 'Error: '.$sql.'<br>'.$conn->error;
}

// Close conn
$conn->close();
