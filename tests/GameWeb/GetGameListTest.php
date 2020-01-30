<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class GetGameListTest extends TestCase
{
    public $serviceName = 'getgamelist';
     /**
     * 获取游戏列表单元测试
     *
     * @return void
     */
    public function testExample()
    {
        $testUserId = '1892';
        $url = parent::TEST_URL;
        $action = parent::getConfigAction();
        $testCase = $url . $action[$this->serviceName]['testCase'];

        $this->get($testCase);

        $this->seeJson([
                "code" => 0
            ]
        );
    }
}
