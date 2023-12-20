<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\a;

class PatientData
{
    private $dbConnection;

    public function __construct(DatabaseConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function getPatientData(): array
    {
        $conn = $this->dbConnection->getConnection();
        $result = $conn->query(
            "SELECT 
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
                i.from_date ASC,
                p.last ASC");

        $patientData = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $patientData[] = $row;
            }

            $result->free();
        } else {
            throw new \Exception('Error: '.$conn->error);
        }

        $this->dbConnection->closeConnection();

        return $patientData;
    }
}
