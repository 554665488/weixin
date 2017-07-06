<?php

//用户，进行一个行为的时候。微信，将用户产生的行为。推送给开发者！！！

//开发者分情况来进行处理。

//subscribe  关注

$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

/*
file_put_contents('demo.txt', $postStr);

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

	echo sprintf($textTpl, $fromUsername, $toUsername, $time, $msType, '李文凯，我相信你');

}

/*
include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $token;

$json = ' {
"button":[
{
"type":"click",
"name":"今日歌曲",
"key":"music"
},
{
"name":"菜单",
"sub_button":[
{
"type":"view",
"name":"搜索",
"url":"http://www.soso.com/"
},
{
"type": "scancode_push",
"name": "扫码推事件",
"key": "rselfmenu_0_1",
},
]
}]
}';

var_dump(post($url, $json));
 */
function post($url, $data) {

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

function get($url) {

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	$output = curl_exec($ch);

	curl_close($ch);

	return $output;
}