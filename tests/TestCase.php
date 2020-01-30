<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    public const TEST_URL = '/WS/NewMoblieInterface.ashx?';
    public const TEST_USER_ID = '1891';

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function getConfigAction(){
        return config('NetFox.action');
    }
}
