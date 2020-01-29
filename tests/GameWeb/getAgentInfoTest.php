<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class getAgentInfoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $testUserId = '1891';
        $key = 'getvipinfo';
        $myDebugVar = '/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId;

        $this->get($myDebugVar);

        $this->seeJson([
                "code" => 0
            ]
        );
    }
}
