<?php
//第一步，将mem.php  这个文件包含 进来。这个文件即能获取access_token，又能让我们直接调用memcached缓存中的token,不用我们反复来获取了。

include 'mem.php';

//第二步，向https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=ACCESS_TOKEN 发送get请求
//CURL

$token = mem_token();

$ch = curl_init();

$url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=' . $token;

curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$output = curl_exec($ch);

curl_close($ch);

$obj = json_decode($output, true);

var_dump($obj);