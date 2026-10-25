<?php
namespace Leadrock\tests;

use Leadrock\Items\Lead;
use Leadrock\Providers\Leadrock;
use PHPUnit\Framework\TestCase;

class LeadTest extends TestCase
{
    public function testEmpty()
    {
        $lead = new Lead(0);
        $this->assertEquals([
            'track_id' => 0,
            'status' => Lead::STATUS_HOLD,
        ], $lead->getFullData());
    }

    public function testDataSet()
    {
        $lead = new Lead(0);
        $lead->setParam('param_name', 'param_value');
        $this->assertEquals([
            'track_id' => 0,
            'status' => Lead::STATUS_HOLD,
            'param_name' => 'param_value',
        ], $lead->getFullData());

        $lead->setParam('param_name2', 'param_value2');
        $this->assertEquals([
            'track_id' => 0,
            'status' => Lead::STATUS_HOLD,
            'param_name' => 'param_value',
            'param_name2' => 'param_value2',
        ], $lead->getFullData());
    }

    public function testStatusSet()
    {
        $lead = new Lead(0);
        $this->assertEquals([
            'track_id' => 0,
            'status' => Lead::STATUS_HOLD,
        ], $lead->getFullData());

        foreach ([Lead::STATUS_HOLD, Lead::STATUS_APPROVED, Lead::STATUS_REJECTED, Lead::STATUS_TRASH] as $allowedStatus) {
            $lead->changeStatus($allowedStatus);
            $this->assertEquals([
                'track_id' => 0,
                'status'   => $allowedStatus,
            ], $lead->getFullData());
        }

        $lead->changeStatus(Lead::STATUS_APPROVED);
        $lead->changeStatus(9999);
        $this->assertNotEquals([
            'track_id' => 0,
            'status'   => 9999,
        ], $lead->getFullData());
        $this->assertEquals([
            'track_id' => 0,
            'status'   => Lead::STATUS_APPROVED,
        ], $lead->getFullData());
    }
}