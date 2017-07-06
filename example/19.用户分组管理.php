<?php

//麒麟外汇   weixin.buqiu.com   index.php

//openId   oNlnUjjiomTdfHcnsPZg3frmzuJo     每个用户关注不同的微信公众号，都会在这个微信公众号里面产生一个特殊的编号，这个编号是唯 一，每个用户在不同的公众号里面都不一样。

//

include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/groups/update?access_token=' . $token;

$data['group']['id'] = 105;
$data['group']['name'] = '戒情人';

$json = json_encode($data, JSON_UNESCAPED_UNICODE);

var_dump(post($url, $json));

/*
$url = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token=' . $token;

$data['openid'] = 'oNlnUjjiomTdfHcnsPZg3frmzuJo';

$json = json_encode($data);

var_dump(post($url, $json));

/*
$url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token=' . $token;

var_dump(get($url));


$url = 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token=' . $token;

$data['group']['name'] = '小蜜';

$json = json_encode($data, JSON_UNESCAPED_UNICODE);

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