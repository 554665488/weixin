<?php

include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=' . $token;

$data['action'] = 'long2short';
$data['long_url'] = 'http://baike.baidu.com/link?url=LHe2hvgLQNIsHiKDdCE04BMjlOVEUDQmB9INofND0qA2sOPv5PDeDMOIRIB-4pm1ujuOWwe_9AOZH8mcaS5Tz_';

$json = json_encode($data);

var_dump(post($url, $json));

/*

$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $token;

$json = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123"}}}';

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