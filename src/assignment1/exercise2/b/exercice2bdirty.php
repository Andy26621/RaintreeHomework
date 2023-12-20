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
$sql = 'SELECT 
            p.first,
            p.last
        FROM 
            patient p;
';

$result = $conn->query($sql);

// Process data
if ($result) {
    $letters = [];

    while ($row = $result->fetch_assoc()) {
        $firstName = $row['first'];
        $lastName = $row['last'];

        // combine both names
        $fullName = $firstName.$lastName;

        // keep only alphabetic chars
        // $combinedName = strtolower(str_replace([' ', '-'], '', $fullName)); Maybe use a regex... And lowercase the string
        $combinedName = preg_replace('/[^a-zA-Z]/', '', strtolower($fullName));
        // print_r("$combinedName\n");

        // count alphabetic chars and get string info (option 1 returning an array with the char key as ASCCI code and the number of times it appears in the string)
        $letterCount = count_chars($combinedName, 1);

        // update letters array
        foreach ($letterCount as $asciiCode => $count) {
            $letter = chr($asciiCode);
            if (!isset($letters[$letter])) {
                $letters[$letter] = $count;
            } else {
                $letters[$letter] += $count;
            }
        }
    }

    // calculate total count
    $totalCount = array_sum($letters);

    // order letters and print percentages
    ksort($letters, SORT_REGULAR);

    foreach ($letters as $letter => $count) {
        $percentage = number_format(($count / $totalCount) * 100, 2);
        echo "$letter\t$count\t$percentage%\n";
    }

    $result->free();
} else {
    echo 'Error: '.$sql.'<br>'.$conn->error;
}

// Close connection
$conn->close();
