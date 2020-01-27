<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class NetfoxTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $testUserId = '1843';

        $action = config('NetFox.action');

        //dd($action);
        foreach ($action as $key => $data) {

            $this->get('/WS/NewMoblieInterface.ashx?action='.$key.'&userid='.$testUserId);

            $this->seeJson([
                "code" => 0
                ]
            );
        }
    }
}
