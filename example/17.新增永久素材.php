<?php

//__FILE__  常量   返回当前文件的绝对路径   /abc

// dirname() 返回路径的  文件夹路径    /abc

include 'mem.php';

$token = get_token();

$url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=' . $token;

$data['articles'][0] = array(

	'title' => '每天努力一点点，你有多历害',
	'thumb_media_id' => 'RACMFE8veCqA6j_nqJnwSiVLPZBX4kTIYZNTKr-1QzA',
	'author' => '麒麟外汇',
	'digest' => '这是一个摘要',
	'show_cover_pic' => 1,
	'content' => '我是李文凯，我的感受就是人类世界就是动物世界。在生产力水平一定的情况下。有钱人是恒定。不是你有钱，就是别人有钱',
	'content_source_url' => 'http://www.baidu.com',

);

$json = json_encode($data, JSON_UNESCAPED_UNICODE);

var_dump(post($url, $json));

//图文素材的永久media_id：RACMFE8veCqA6j_nqJnwSq7NHUNqHsTM1wom0APL-ds

/*

$url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=' . $token;

$data['media'] = '@' . dirname(__FILE__) . '/img/top1.png';

var_dump(post($url, $data));



上传永久素材：图片的ID：RACMFE8veCqA6j_nqJnwSiVLPZBX4kTIYZNTKr-1QzA

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