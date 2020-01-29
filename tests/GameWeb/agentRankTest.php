<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class agentRank1Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $testUserId = '1843';
        $key = 'agentrank';
//        print('/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId.'&type=1');
        $this->get('/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId.'&type=1');

        $this->seeJson([
                "code" => 0
            ]
        );
    }

//    public function test2Example()
//    {
//        $testUserId = '1891';
//        $key = 'getagentinfo';
//        $myDebugVar = array(1, 2, 3);
////        fwrite(STDERR, print_r($myDebugVar, TRUE));
//        dd($this->get('/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId));
//
//        $this->seeJson([
//                "code" => 0
//            ]
//        );
//    }
}
