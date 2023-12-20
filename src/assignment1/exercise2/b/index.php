<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\b;

$host = 'localhost';
$username = 'andydev';
$password = 'Wy(R*C@D)@JY8jNY';
$database = 'raintree_homework';

$databaseConn = new exercise2bOOP($host, $username, $password, $database);

try {
    $data = $databaseConn->getData();

    $processedData = $databaseConn->processData($data);

    $databaseConn->printData($processedData);
} catch (\Exception $e) {
    echo 'Exception: '.$e->getMessage();
} finally {
    $databaseConn->closeConnection();
}
