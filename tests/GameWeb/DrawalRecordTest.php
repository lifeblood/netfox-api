<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DrawalRecordTest extends TestCase
{
    public $serviceName = 'drawalrecord';
     /**
     * 提款记录
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
            '{index}' => 1
        ];

        $testCase = strtr($testCase, $postVars);

        $this->get($testCase);

        $this->seeJson([
                "code" => 0,
            ]
        );
    }
}
