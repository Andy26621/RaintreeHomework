<?php

require_once 'PatientRecord.php';

class Insurance implements PatientRecord
{
    private $id;
    private $pn;
    private $iname;
    private $fromDate;
    private $toDate;

    public function __construct($id, $pn, $iname, $fromDate, $toDate = null)
    {
        $this->id = $id;
        $this->pn = $pn;
        $this->iname = $iname;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function getRecordId(): int
    {
        return $this->id;
    }

    public function getPatientNumber(): string
    {
        return $this->pn;
    }

    public function getInsuranceName(): string
    {
        return $this->iname;
    }

    public function getToDate(): string
    {
        return $this->toDate !== null ? $this->toDate : '';
    }

    public function isDateInRange($compareDate): bool
    {
        $compareDateTime = DateTime::createFromFormat('m-d-y', $compareDate);
        if (!$compareDateTime) {
            echo "Invalid date format\n";

            return false;
        }

        $compareTimestamp = $compareDateTime->getTimestamp();
        $fromDateTimestamp = strtotime($this->fromDate);
        $toDateTimestamp = $this->toDate ? strtotime($this->toDate) : PHP_INT_MAX;

        return $compareTimestamp >= $fromDateTimestamp && $compareTimestamp <= $toDateTimestamp;
    }
}
