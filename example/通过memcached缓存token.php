<?php

//设置有效期后，服务器自行维护，不需要我们手动去管理有效期了

//第一步，是连接到服务器

//a4df0d3e370811e4.m.cnqdalicm9pub001.ocs.aliyuncs.com

//第二步，是否能获得到 access_token    key  ==  token

//第三步，如果能获取到 token 就说明没有过期，获取不到就说明过期了。重新通过get_token函数向微信公众号服务器发起获得token的指令

//第四步，重新得到token后，向memcached中写入token的key（名字）,value(值)，有效期

define('APP_ID', 'wx5c174c50435941e6');

define('APP_SECRET', '689bee27131ef4d87d520dd3319baafe');

//连接到memcached  设置几个参数

//  get（名字）  就得到了数据

//  set('名字'，值，有效期)  创建了数据

function mem_token() {
//声明一个新的memcached链接
	$connect = new Memcached;
//关闭压缩功能
	$connect->setOption(Memcached::OPT_COMPRESSION, false);
//使用binary二进制协议
	$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
//添加OCS实例地址及端口号
	$connect->addServer('a4df0d3e370811e4.m.cnqdalicm9pub001.ocs.aliyuncs.com', 11211);

	$token = $connect->get('token');

//empty 如果为null 返回真，如果是非空的值，返回false

//如果 token 存在为false   进行一次非操作  true    ==  输出token

//如果$token 为true 即为token 不存在，我重新获取一次

	if (!empty($token)) {

		return $token;

	} else {

		$token = get_token();

		$connect->set('token', $token, 7000);
	}

	return $token;
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