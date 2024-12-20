<?php

namespace Unloq;

use PHPUnit\Framework\TestCase;

class LogletTest extends TestCase
{
    /**
     * Tests the response when invalid credentials have been provided
     */
    public function testWrongCredentials()
    {
        $loglet = new Loglet('Loglet PHP Library', 'wrong-key');

        $request = $loglet->log('Test Message', 'TRACE', ['testKey' => 'testValue']);

        $this->assertEquals(403, $request['code']);
    }

    /**
     * Tests the response with proper credentials.
     */
    public function testSaveLog()
    {
        $loglet = new Loglet('Loglet PHP Library', 'fill-with-a-correct-key');

        $request = $loglet->log('Test Message', 'WARN', ['testKey' => 'testValue']);

        $this->assertEquals(200, $request['code']);
    }
}