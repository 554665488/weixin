<?php

//设置常量，设置APP_ID和APP_SECRET

//判断一个文件 token.txt文件是否存在  也就是说，我们曾经获取过access_token

// 创建时间  unix时间戳   1970年1月1日至当前时间经过的秒数  整型

//  越来越大   当前获取文件创建时间，会比文件真正的创建时间要大

//   access_token  7200秒  2个小时后过期

//  token.txt 中间写入了一个token  并且这个文件有一个创建时间。我用我当前的时间【此时此刻，执行index.php时候的时间】

//  -  文件创建时间    如果这个一个时间  >＝ 7200  我就必须重新获取access_token【票据】

//  两个小时之内，每次进行操作的时候，就获取access_token

//  如果说时间 > = 7200 的话，我们就 重新

//   我们就直接读取 token.txt文件里面的值

//  函数  file_exists()  判断文件是否存在

// 函数filectime()  file create time

//函数 time()  就是得到当前的unix时间戳

// unlink()  删除一个文件

// file_get_contents()  得到指定文件里面的内容

define('APP_ID', 'wx5c174c50435941e6');

define('APP_SECRET', '689bee27131ef4d87d520dd3319baafe');

function get_file_token() {
	if (exists_token()) {

		if (exprise_token()) {
			//重新获取一次，$token，并且将文件删除，重新向文件里面写一次
			$token = get_token();

			unlink('token.txt');
			file_put_contents('token.txt', $token);

		} else {

			$token = file_get_contents('token.txt');

		}

	} else {

		$token = get_token();

		file_put_contents('token.txt', $token);

	}
}

/*


完成获得到token 之后的业务逻辑代码


 */

//token.txt

//判断文件是否存在？
function exists_token() {

//判断token文件是否存在
	if (file_exists('token.txt')) {
		return true;
	} else {
		return false;
	}

}

//获取token.txt的创建时间，并且与当前执行index.php 文件的时间进行对比
function exprise_token() {
//文件创建时间
	$ctime = filectime('token.txt');

	if ((time() - $ctime) >= 7000) {
		return true;
	} else {
		return false;
	}
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
