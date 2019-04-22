<?php

include 'token.php';

$token =  cacheToken();
$openid = $_GET['openid'];
$data = [
	"openid_list"=>[$openid]
];
$data = json_encode($data);

$url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchunblacklist?access_token=' . $token;

$curl = new MyCurl($url);
$result = $curl->post($data);

$result = json_decode($result , true);//返回的json数据包转换成变量
// // 拉黑成功
// var_dump($result);
if ($result['errcode'] == 0 && $result['errmsg'] == 'ok') {
	echo json_encode(['state' => 1]);
}