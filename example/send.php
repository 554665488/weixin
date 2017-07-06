<?php

//dl3OqbpnD5fn6Ygs2WbO7_zkgoEMjSajd3Zo-oMg9HI

include 'mem.php';

$token = get_token();

//oNlnUjjiomTdfHcnsPZg3frmzuJo

$json = '{
    "touser":"oNlnUjjiomTdfHcnsPZg3frmzuJo",
    "msgtype":"text",
    "text":
    {
         "content":"希望你跟着我能学到更多的内容，从html一直到PHP千万PV的解决方案"
    }
}';

$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . $token;

var_dump(post($url, $json));

/*
$url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=' . $token;

$json = '{
"filter":{
"is_to_all":false,
"group_id":"104"
},
"mpnews":{
"media_id":"dl3OqbpnD5fn6Ygs2WbO7_zkgoEMjSajd3Zo-oMg9HI"
},
"msgtype":"mpnews"
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

function get_token() {

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
