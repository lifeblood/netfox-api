<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 16:45
 */

namespace App\Http\Services\SMS;


class MessageContext
{
    private $message;

    /**
     * 构造方法
     * 此处使用到了依赖注入和类型约束的概念，
     * MessageContext constructor.
     * @param Message $msg
     */
    public function __construct(Message $msg)
    {
        $this->message = $msg;
    }
    public function SendMessage($mobile)
    {
        return $this->message->send($mobile);
    }
}
