<?php
//自定义菜单的演示代码

// 遇到问题，可以直接向我来提问。我会给大家进行解答的

include 'mem.php';

$token = mem_token();

//json_decode(第一个参数写上字符串的json，第二个参数写上布尔型的true)  是将json结构体转为对象或者是数组

//json_encode(数组); 返回一个json字符串

/*
echo '<pre>';
var_dump(json_decode($string, true));
echo '</pre>';
 */
//key---value的 json结构体

/*
//查询自定义查当中的结果
//$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $token;

$url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $token;

$result = get($url);

var_dump($result);


 */

//有三个一级菜单
$menu = array();

$menu['button'][0] = array(
	'type' => 'click',
	'name' => '李文凯帅',
	'key' => 'wenkai',
);

$menu['button'][1] = array(
	'type' => 'view',
	'name' => '搜索',
	'url' => 'http://www.baidu.com',
);

/*
$menu['button'][2] = array(
'type' => 'click',
'name' => '微信视频',
'key' => 'weixin',
);
 */
$menu['button'][2]['name'] = '二级菜单';
$menu['button'][2]['sub_button'] = array();
$menu['button'][2]['sub_button'][0] = array(
	'type' => 'click',
	'name' => '点击',
	'key' => 't',
);
$menu['button'][2]['sub_button'][1] = array(
	'type' => 'view',
	'name' => '替',
	'url' => 'http://www.baidu.com',
);
$menu['button'][2]['sub_button'][2] = array(
	'type' => 'view',
	'name' => '天',
	'url' => 'http://www.baidu.com',
);
$menu['button'][2]['sub_button'][3] = array(
	'type' => 'view',
	'name' => '行',
	'url' => 'http://www.baidu.com',
);
$menu['button'][2]['sub_button'][4] = array(
	'type' => 'view',
	'name' => '道',
	'url' => 'http://www.baidu.com',
);

$json = json_encode($menu, JSON_UNESCAPED_UNICODE);

$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $token;

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
