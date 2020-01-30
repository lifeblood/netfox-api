<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetShareRewardTest extends TestCase
{
    public $serviceName = 'getsharereward';
     /**
     * 分享玩家彩金
     *
     * @return void
     */
    public function testExample()
    {
        $url = parent::TEST_URL;
        $action = parent::getConfigAction();
        $testCase = $url . $action[$this->serviceName]['testCase'];

        $postVars = [
            '{userId}' => parent::TEST_USER_ID
        ];

        $testCase = strtr($testCase, $postVars);

        $this->get($testCase);

        $this->seeJson([
                "code" => 0,
            ]
        );
    }
}
