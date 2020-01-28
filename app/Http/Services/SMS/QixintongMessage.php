<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/1/27
 * Time: 16:41
 */

namespace App\Http\Services\SMS;
use App\Http\Services\GameUtils;
use Illuminate\Support\Facades\Log;
use GuzzleHttp;


class QixintongMessage implements Message
{
    public $qxt;
    public $SMSUrl = 'http://60.205.220.32:8888/sms.aspx?action=send&userid={userid}&account={account}&password={password}&mobile={mobile}&content={content}&sendTime=&extno=';

    public function __construct()
    {
        $this->qxt['uid'] = config('NetFox.SMS.qixintong.SMS_uid');
        $this->qxt['acc'] = config('NetFox.SMS.qixintong.SMS_acc');
        $this->qxt['pass'] = config('NetFox.SMS.qixintong.SMS_pwd');
        $this->qxt['content'] = config('NetFox.SMS.SMS_content');

    }


    /**
     * 企信通
     * 管理后台地址：http://60.205.220.32:8888/Index.aspx
     * @param $mobile
     * @return mixed
     */
    public function send($mobile)
    {
        $smsNumber = rand(100000,999999);
        $vars = [
            '{code}'       => $smsNumber
        ];
        $strContent = strtr($this->qxt['content'], $vars);

        $postVars = [
            '{userid}' => $this->qxt['uid'],
            '{account}' => $this->qxt['acc'],
            '{password}' => $this->qxt['pass'],
            '{mobile}' => $mobile,
            '{content}' => $strContent
        ];

        $postUrl = strtr($this->SMSUrl, $postVars);

        /**
         * 返回结果格式
         * {
         *     "returnstatus":"Success",   返回状态值：成功返回Success 失败返回：Faild
         *     "message":"ok",             返回信息
         *     "remainpoint":"19499",      返回余额
         *     "taskID":"1873046",         返回本次任务的序列ID
         *     "successCounts":"1"         成功短信数：当成功后返回提交成功短信数
         * }
         */

        $client = new GuzzleHttp\Client();
        try {
            $res  = $client->get($postUrl);
            $data = json_encode(simplexml_load_string($res->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE);


           if (json_decode($data)->returnstatus != 'Success') {
               Log::error(  __CLASS__ .' / '. __FUNCTION__ .' / '. __LINE__.': '.'企息通短们发送失败:'.$data);
               return "";
           }
           return $smsNumber;

        }catch (GuzzleHttp\Exception\ClientExceptiona $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            Log::error('GuzzleHttp\Client error：' .$responseBodyAsString);
            return "";
        }

    }
}