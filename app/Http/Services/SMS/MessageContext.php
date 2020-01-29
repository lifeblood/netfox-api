<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 16:45
 */

namespace App\Http\Services\SMS;
use App\Http\Services\SMS\QixintongMessage;


class MessageContext
{
    private $message;
    private $messageChannel = 'App\\Http\\Services\\SMS';

    /**
     * 构造方法
     * 此处使用到了依赖注入和类型约束的概念，
     * MessageContext constructor.
     * @param $channel
     */
    public function __construct($channel)
    {
        $channel = $this->messageChannel .'\\'.$channel;
        $this->message = new $channel;
    }
    public function SendMessage($mobile)
    {
        return $this->message->send($mobile);
    }
}
