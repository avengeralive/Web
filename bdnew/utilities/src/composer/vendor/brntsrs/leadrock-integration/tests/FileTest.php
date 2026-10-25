<?php
namespace Leadrock\tests;

use GuzzleHttp\Client;
use Leadrock\Items\Lead;
use Leadrock\Providers\File;
use Leadrock\Providers\Leadrock;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    public function testLeadSave()
    {
        $testId = '123.321';
        $testName = 'Integration test';
        $testPhone = '+7912376891';

        $filePath = dirname(__FILE__) . '/../vendor/test.log';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        $this->assertFileNotExists($filePath);

        $lead = new Lead($testId);
        $this->assertEquals([], $lead->save());

        $lead->setParam('name', $testName);
        $lead->setParam('phone', $testPhone);

        $lead->addProvider(new File($filePath));

        $this->assertEquals([], $lead->save());

        $this->assertFileExists($filePath);

        $row = trim(file_get_contents($filePath));
        $this->assertNotEmpty($row);
        $this->assertJson($row);
        $data = json_decode($row, true);
        $this->assertNotEmpty($data);

        $this->assertArrayHasKey('name', $data);
        $this->assertArrayHasKey('phone', $data);
        $this->assertArrayHasKey('track_id', $data);
        $this->assertArrayHasKey('status', $data);

        $this->assertEquals($testName, $data['name']);
        $this->assertEquals($testPhone, $data['phone']);
        $this->assertEquals($testId, $data['track_id']);
        $this->assertEquals(Lead::STATUS_HOLD, $data['status']);

        unlink($filePath);
        $this->assertFileNotExists($filePath);
    }
}