<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\b;

class exercise2bOOP
{
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->conn = new \mysqli($host, $username, $password, $database);

        if ($this->conn->connect_errno) {
            echo 'Failed to connect to MySQL: '.$this->conn->connect_error;
            exit;
        }
    }

    public function getData(): array
    {
        $sql = 'SELECT 
                    p.first, 
                    p.last 
                FROM 
                    patient p;';
        $result = $this->conn->query($sql);

        if ($result) {
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            $result->free();

            return $data;
        } else {
            throw new \Exception('Error: '.$sql.'<br>'.$this->conn->error);
        }
    }

    public function processData(array $data): array
    {
        $letters = [];

        foreach ($data as $row) {
            $firstName = $row['first'];
            $lastName = $row['last'];

            $fullName = $firstName.$lastName;

            $combinedName = preg_replace('/[^a-zA-Z]/', '', strtolower($fullName));

            $letterCount = count_chars($combinedName, 1);

            foreach ($letterCount as $asciiCode => $count) {
                $letter = chr($asciiCode);
                $letters[$letter] = ($letters[$letter] ?? 0) + $count;
            }
        }

        $totalCount = array_sum($letters);

        ksort($letters, SORT_REGULAR);

        $processedData = [];

        foreach ($letters as $letter => $count) {
            $percentage = number_format(($count / $totalCount) * 100, 2);
            $processedData[] = ["$letter", "$count", "$percentage%"];
        }

        return $processedData;
    }

    public function printData(array $data): void
    {
        foreach ($data as $dataRow) {
            echo implode("\t", $dataRow)."\n";
        }
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}
