<?php
namespace Leadrock\tests;

use Leadrock\Items\Lead;
use Leadrock\Providers\Leadrock;
use PHPUnit\Framework\TestCase;

class LeadrockTest extends TestCase
{
    public function testConstructionSet()
    {
        $testKey = 'key';
        $testSecred = 'secret';
        $testDomain = 'test.leadrock.com';

        $leadrock = new Leadrock($testKey, $testSecred);
        $this->assertEquals( Leadrock::API_DEFAULT_DOMAIN, $leadrock->getApiDomain());
        $this->assertEquals($testKey, $leadrock->getApiKey());
        $this->assertEquals($testSecred, $leadrock->getApiSecret());

        $leadrock = new Leadrock($testKey . 'none', $testSecred . 'none', $testDomain);
        $this->assertEquals($leadrock->getApiDomain(), $testDomain);
        $this->assertNotEquals(Leadrock::API_DEFAULT_DOMAIN, $leadrock->getApiDomain());
        $this->assertNotEquals($testKey, $leadrock->getApiKey());
        $this->assertNotEquals($testSecred, $leadrock->getApiSecret());
    }

    public function testLeadSave()
    {
        $lead = new Lead(0);
        $this->assertEquals([], $lead->save());

        $lead->setParam('name', 'Integration test');
        $lead->setParam('phone', '111111111');

        $lead->addProvider(new Leadrock('1', '123', 'test.leadrock.com'));

        $this->assertEquals([], $lead->save());
    }
}