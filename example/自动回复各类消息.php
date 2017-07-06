<?php
/*
include 'mem.php';

echo mem_token();

exit;


//如何来接收消息，之后的返回消息给客户

$postObj->ToUserName

$postObj->MsgType

//测试的接收到的文字样例
<xml>
<ToUserName><![CDATA[toUser]]></ToUserName>
<FromUserName><![CDATA[fromUser]]></FromUserName>
<CreateTime>1348831860</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[this is a test]]></Content>
<MsgId>1234567890123456</MsgId>
</xml>

//文本

$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";


//声音
$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Voice>
<MediaId><![CDATA[%s]]></MediaId>
</Voice>
</xml>";


//回复视频
$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Video>
<MediaId><![CDATA[%s]]></MediaId>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
</Video>
</xml>";

$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $mediaId, $title, $desc)

 */
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//empty 如果为空就返回真
if (!empty($postStr)) {

	libxml_disable_entity_loader(true);

	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

	//得到的是来源用户，是哪个用户跟我们发的消息
	$fromUsername = $postObj->FromUserName;
	//发给谁的。ToUserName   原始ID
	$toUsername = $postObj->ToUserName;
	//trim  删除两边空格   将得到抽容赋值给了变量keywords
	$keyword = trim($postObj->Content);
	//unix时间戳
	$time = time(); //我mysql的密码是多少

	if ($keyword == '宝宝') {

		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $title, $desc, $url, $url, $mediaId);
		echo $resultStr;
	} else {
		echo "Input something...";
	}

} else {
	echo "";
	exit;
}