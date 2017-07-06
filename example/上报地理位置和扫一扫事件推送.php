<?php

//将微信发过来的xml数据接收到，赋值给$postStr
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//fopen(文件路径，打开模式)  打开指定目录的某个文件（追加的模式）

//用户写入文件的，不删除原有的内容，向文件的最后，追加新的内容。

//fwrite(向哪个资源当中写入，)

$fp = fopen('loc.txt', 'a+');

fwrite($fp, $postStr);

fclose($fp);

libxml_disable_entity_loader(true);
$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
$fromUsername = $postObj->FromUserName;
$toUsername = $postObj->ToUserName;
$keyword = trim($postObj->Content);
$time = time();
$textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";

if ($postObj->EventKey == 'music' && $postObj->Event == 'CLICK') {

	$key = '大半夜的，我要对着月亮，唱情歌';
	echo sprintf($textTpl, $fromUsername, $toUsername, time(), 'text', $key);
}
