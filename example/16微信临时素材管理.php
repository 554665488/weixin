<?php

//__FILE__  常量   返回当前文件的绝对路径   /abc

// dirname() 返回路径的  文件夹路径    /abc

include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=' . $token . '&media_id=KAozamx4DlsZ2glxuHTa9oWzS3p1R486FvHZpdVpNHNPB6Yl3Zv0Jz0WqNMGGiUT';

file_put_contents('img/hello.amr', file_get_contents($url));

/*

KAozamx4DlsZ2glxuHTa9oWzS3p1R486FvHZpdVpNHNPB6Yl3Zv0Jz0WqNMGGiUT

$url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $token . '&type=voice';

$data['media'] = '@' . dirname(__FILE__) . '/img/maibao.mp3';

var_dump(post($url, $data));

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