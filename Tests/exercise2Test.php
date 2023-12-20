<?php

namespace AndresZeballos\RaintreeHomework\assignment1\exercise2\b;

use PHPUnit\Framework\TestCase;

class exercise2Test extends TestCase
{
    private $databaseConn;

    protected function setUp(): void
    {
        $host = 'localhost';
        $username = 'andydev';
        $password = 'Wy(R*C@D)@JY8jNY';
        $database = 'raintree_homework';

        $this->databaseConn = new exercise2bOOP($host, $username, $password, $database);
    }

    public function testGetData()
    {
        $data = $this->databaseConn->getData();

        $this->assertIsArray($data);
    }

    public function testProcessData()
    {
        $inputData = [
            ['first' => 'John', 'last' => 'Doe'],
        ];

        $processedData = $this->databaseConn->processData($inputData);

        $this->assertIsArray($processedData);
    }

    public function testPrintData()
    {
        ob_start();
        $this->databaseConn->printData([['A', 1, 'B1']]);
        $output = ob_get_clean();

        $this->assertStringContainsString('A', $output);
        $this->assertStringContainsString('1', $output);
        $this->assertStringContainsString('B1', $output);
    }
}
