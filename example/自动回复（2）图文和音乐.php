<?php
/*


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


//回复音乐
$textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[%s]]></MsgType>
<Music>
<Title><![CDATA[%s]]></Title>
<Description><![CDATA[%s]]></Description>
<MusicUrl><![CDATA[%s]]></MusicUrl>
<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
</Music>
</xml>";
$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $title, $desc, $url, $url, $mediaId);

 */
$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

//empty 如果为空就返回真
if (!empty($postStr)) {

	libxml_disable_entity_loader(true);

	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

	$fromUsername = $postObj->FromUserName;

	$toUsername = $postObj->ToUserName;
	//trim  删除两边空格   将得到抽容赋值给了变量keywords
	$keyword = trim($postObj->Content);
	//unix时间戳
	$time = time();

	$textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<ArticleCount>2</ArticleCount>
					<Articles>
						<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
						</item>
						<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
						</item>
					</Articles>
				</xml> ";

	if ($keyword == '图文') {

		$msgType = 'news';

		$title1 = '百度测试';

		$desc1 = '我的测试要求跳转到百度网上去';

		$picUrl1 = 'http://weixin.buqiu.com/img/top1.png';

		$url1 = 'http://www.baidu.com';

		$title2 = '新浪测试';

		$desc2 = '我的测试要求跳转到新浪网上去';

		$picUrl2 = 'http://weixin.buqiu.com/img/top2.png';

		$url2 = 'http://www.sina.com.cn';

		$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $title1, $desc1, $picUrl1, $url1, $title2, $desc2, $picUrl2, $url2);
		echo $resultStr;
	} else {
		echo "Input something...";
	}

} else {
	echo "";
	exit;
}