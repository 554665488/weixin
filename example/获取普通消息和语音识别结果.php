<?php

// $_POST  接收用户表单的传参
/*
<input type="text" name="username" value="liwenkaihaha" />

<xml><ToUserName><![CDATA[gh_9a1a7e312b32]]></ToUserName>
<FromUserName><![CDATA[oNlnUjjiomTdfHcnsPZg3frmzuJo]]></FromUserName>
<CreateTime>1430842484</CreateTime>
<MsgType><![CDATA[video]]></MsgType>
<MediaId><![CDATA[St1iueKIxPmYLtjo_apsXS0kjXtiJ2YXVPtuwmuml3OEVQ5ppA3uAyxwwbT4ulZA]]></MediaId>
<ThumbMediaId><![CDATA[voebq08On1eM1NczWVGE1uBdihU9Yw2aG-6zBOfWME2dNQsVChMD74Dm4DcS50ci]]></ThumbMediaId>
<MsgId>6145421674711898483</MsgId>
</xml>




 */

//

//$_POST来接收的话，是接收不到腾讯的微信服务器发过来的任务数据

//要获得的未被处理过的原使的post数据，MIME类型可能是未知的或者是一些特殊的：text/xml

$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

file_put_contents('demo.txt', $postStr);

/*
include 'mem.php';

echo mem_token();
 */
