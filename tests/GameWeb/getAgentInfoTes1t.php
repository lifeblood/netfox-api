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
        $key = 'getagentinfo';
        $myDebugVar = array(1, 2, 3);
//        fwrite(STDERR, print_r($myDebugVar, TRUE));
        dd($this->get('/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId));

        $this->seeJson([
                "code" => 0
            ]
        );
    }
}
