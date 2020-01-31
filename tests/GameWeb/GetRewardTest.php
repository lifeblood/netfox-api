<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetRewardTest extends TestCase
{
    public $serviceName = 'getreward';
     /**
     * 获取代理奖励
     *
     * @return void
     */
    public function testExample()
    {
        $url = parent::TEST_URL;
        $action = parent::getConfigAction();
        $testCase = $action[$this->serviceName]['testCase'];
        $postVars = [
            '{userId}' => parent::TEST_USER_ID
        ];
        $testCase = strtr($testCase, $postVars);
        $sign = \App\Http\Services\GameUtils::getSignData('?' . $testCase);
        $testCase = $url . $testCase . '&sign=' . $sign;
        print $testCase;
        $this->get($testCase);

        $this->seeJson([
                "code" => 0,
            ]
        );
    }
}
