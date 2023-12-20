<?php

interface PatientRecord
{
    public function getRecordId(): int;

    public function getPatientNumber(): string;
}
