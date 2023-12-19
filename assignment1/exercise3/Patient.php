<?php

require_once 'PatientRecord.php';

class Patient implements PatientRecord
{
    private $id;
    private $pn;
    private $firstName;
    private $lastName;
    private $insuranceRecords = [];

    public function __construct($id, $pn, $firstName, $lastName, $insuranceRecords)
    {
        $this->id = $id;
        $this->pn = $pn;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->insuranceRecords = $insuranceRecords;
    }

    public function getRecordId(): int
    {
        return $this->id;
    }

    public function getPatientNumber(): string
    {
        return $this->pn;
    }

    public function getFullName(): string
    {
        return $this->firstName.' '.$this->lastName;
    }

    public function addInsuranceRecord(Insurance $insurance)
    {
        $this->insuranceRecords[] = $insurance;
    }

    public function getInsuranceRecords(): array
    {
        return $this->insuranceRecords;
    }

    public function printInsuranceTable($compareDate)
    {
        foreach ($this->insuranceRecords as $insurance) {
            $isValid = $insurance->isDateInRange($compareDate) ? 'Yes' : 'No';
            $toDateVariable = $insurance->getToDate() !== '' ? $insurance->getToDate() : 'undefined';
            echo "{$this->getPatientNumber()}\t{$this->getFullName()}\t{$insurance->getInsuranceName()}\t$isValid\t$toDateVariable\n";
        }
    }
}
