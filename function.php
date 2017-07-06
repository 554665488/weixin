<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12
 * Time: 11:17
 */
define('APP_ID', 'wx3baef8aed7cf89a9');

define('APP_SECRET', '7d1d7f26446bce615129d6a51a48b1b6');
function get_token()
{

    $ch = curl_init();

    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . APP_ID . '&secret=' . APP_SECRET;

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $output = curl_exec($ch);

    curl_close($ch);

    $obj = json_decode($output, true);

    //返回access_token
    return $obj['access_token'];
}

function send_event()
{

//用户，进行一个行为的时候。微信，将用户产生的行为。推送给开发者！！！

//开发者分情况来进行处理。

//subscribe  关注

    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];


    file_put_contents('demo.txt', $postStr);
    /*
        exit(); //中断执行，后面的代码不执啦
         */

//libxml_disable_entity_loader(true);
    $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

    $fromUsername = $postObj->FromUserName;
    $toUsername = $postObj->ToUserName;
    $type = $postObj->MsgType;
    $event = strtolower($postObj->Event);
    $key = strtolower($postObj->EventKey);

    $time = time();

    $msType = 'text';

    $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            </xml>";

    if ($postObj->MsgType == 'event' && $postObj->Event == 'subscribe') {
        //跟用户回复一句话：李文凯，我相信你！

        echo sprintf($textTpl, $fromUsername, $toUsername, $time, $msType, '我相信你');

    }
}

function pre($data, $is_die = false)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($is_die) {
        die();
    }
}

function post($url, $data)
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //声明使用POST方式来进行发送
    curl_setopt($ch, CURLOPT_POST, 1);

    //发送什么数据呢
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    //忽略证书
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $output = curl_exec($ch);

    curl_close($ch);

    return $output;
}

function get($url)
{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $output = curl_exec($ch);

    curl_close($ch);

    return $output;
}
