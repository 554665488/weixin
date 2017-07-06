<?php

include_once "wxBizMsgCrypt.php";

// 第三方发送消息给公众平台

$token = "zidingyitoken";
$encodingAesKey = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG";
$appId = "wxb11529c136998cb6";
$pc = new WXBizMsgCrypt($token, $encodingAesKey, $appId); //开发者Token  ASE密钥  开发者公共平台的AppId  实例化一个加密对象
//var_dump($pc);


$timeStamp = time();
$nonce = rand(1000, 9999);
$text = "<xml>
<ToUserName><![CDATA[oia2Tj我是中文jewbmiOUlr6X-1crbLOvLw]]></ToUserName>
    <FromUserName><![CDATA[gh_7f083739789a]]></FromUserName>
        <CreateTime>1407743423</CreateTime>
        <MsgType><![CDATA[video]]></MsgType>
    <Video>
        <MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId>
        <Title><![CDATA[testCallBackReplyVideo]]></Title>
        <Description><![CDATA[testCallBackReplyVideo]]></Description>
    </Video>
</xml>";
$encryptMsg = '';
$errCode = $pc->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
//echo time();
//sleep(5);
//echo '<br/>';
//echo time();
if ($errCode == 0) {
    echo "加密后数据";
    var_dump($encryptMsg);  // 加密后的可以直接回复用户的密文，包括msg_signature, timestamp, nonce, encrypt的xml格式的字符串,
//    print("加密后: " . $encryptMsg . "\n");
} else {
    print($errCode . "\n");
}

$xml_tree = new DOMDocument();
$xml_tree->loadXML($encryptMsg);
var_dump($xml_tree);
$array_e = $xml_tree->getElementsByTagName('Encrypt');     //加密后的密文节点
//var_dump($array_e);
$array_s = $xml_tree->getElementsByTagName('MsgSignature'); //签名数据节点  用于验签
$encrypt = $array_e->item(0)->nodeValue;//加密后的密文
//var_dump($encrypt);
$msg_sign = $array_s->item(0)->nodeValue;  //签名数据字符串
//var_dump($msg_sign);
$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
$from_xml = sprintf($format, $encrypt);

// 第三方收到公众号平台发送的消息
$msg = '';
$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);//  签名串  时间戳  随机数  密文  解密后的原文
var_dump($errCode);
if ($errCode == 0) {
    echo "解密后";
    var_dump($msg);
//    print("解密后: " . $msg . "\n");
} else {
    print($errCode . "\n");
}
$array=$pc->test('554665488');  //加密后的数据
var_dump($array);
$pc->test2($array[1]);


