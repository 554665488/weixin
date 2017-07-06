<?php

include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=' . $token;

$message['touser'] = 'oNlnUjjiomTdfHcnsPZg3frmzuJo';
$message['template_id'] = 'ANVzz8sPFNtCU9dvbqn7XLmaJsdKeoIPDTbYFwuTWW8';
$message['url'] = 'http://www.baidu.com';
$message['topcolor'] = '#ff0000';
$message['data']['first'] = array(
	'value' => '我们提醒的股票发现了变化，我们将要提醒您：',
	'color' => '#173177',
);
$message['data']['keyword1'] = array(
	'value' => '中国国电',
	'color' => '#173177',
);
$message['data']['keyword2'] = array(
	'value' => '12.38',
	'color' => '#173177',
);
$message['data']['keyword3'] = array(
	'value' => '9.8%',
	'color' => '#173177',
);
$message['data']['remark'] = array(
	'value' => '点击查看更多详情内容',
	'color' => '#173177',
);

$json = json_encode($message, JSON_UNESCAPED_UNICODE);

var_dump(post($url, $json));

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
