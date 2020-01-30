<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class StartTurnTableTest extends TestCase
{
    public $serviceName = 'startturntable';
     /**
     * 启动转盘
     *
     * @return void
     */
    public function testExample()
    {
        $url = parent::TEST_URL;
        $action = parent::getConfigAction();
        $testCase = $url . $action[$this->serviceName]['testCase'];

        $postVars = [
            '{userId}' => parent::TEST_USER_ID,
            '{index}' => 0
        ];

        $testCase = strtr($testCase, $postVars);
        //
        //dd($testCase);
        $this->get($testCase);

        $this->seeJson([
                "code" => 2001,
            ]
        );
    }
}
