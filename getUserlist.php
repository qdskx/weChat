<?php
include 'token.php';
$token = cacheToken();
$url='https://api.weixin.qq.com/cgi-bin/user/get?access_token=' . $token;
$curl = new MyCurl($url);
//$str是json数据的
$str = $curl->get();
// var_dump($str);
//将json数据转化为php数组，这个数组包含，total，count,以及data（这是个数组），取出data
$arr = json_decode($str, true);
// var_dump($arr);die;
//取出data数组
$openid = $arr['data']['openid'];



// 分页
$number = 2;
$totalCount = $arr['total'];
// $totalCount = 2;
$totalPage = ceil($totalCount / $number);
if (empty($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}
// 得到分页链接
$pageUrl['first'] = "getUserlist.php?page=1";
if ($page - 1 < 1) {
	$pageUrl['prev'] = "getUserlist.php?page=1";
} else {
	$pageUrl['prev'] = "getUserlist.php?page=" . ($page - 1);
}
if ($page + 1 > $totalPage) {
	$pageUrl['next'] = "getUserlist.php?page=$totalPage";
} else {
	$pageUrl['next'] =  "getUserlist.php?page=" . ($page + 1);
}
$pageUrl['end'] = "getUserlist.php?page=" . $totalPage;

////

// 查询黑名单用户
$url2 = 'https://api.weixin.qq.com/cgi-bin/tags/members/getblacklist?access_token='. $token;
$data2 = [
	"openid_list"=>null
];
$data2 = json_encode($data2);
$curl2 = new MyCurl($url2);
$result2 = $curl2->post($data2);
$result2 = json_decode($result2 , true);
$lhOpenid = $result2['data']['openid'];//获取所有的拉黑人员id组成的数组
// var_dump($lhOpenid);
//var_dump($lhOpenid);


////

// 已获取openID，根据openID获取用户详细信息，二维json数组
// 先用6个人做测试，$i<count($openID)
$arr = [];
//偏移量
$offset = ($page - 1) * $number;
for ($i = $offset ; $i < ($offset + $number) && $i < $totalCount ; $i++) {
	$url='https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $token;
	$data['openid'] = $openid[$i]; 
	$url = $url . '&'. http_build_query($data);
	$curl = new MyCurl($url);
	$str = $curl->get();
	$array = json_decode($str, true);
	//拉黑相关的
	if(in_array($array['openid'], $lhOpenid)){
		$isdel = 1;
		//1是已经被拉黑的
	} else {
		$isdel = 0;
	}
	//
	$arr[] = ['openid'=>$array[openid] , 'nickname'=>$array[nickname] , 'sex'=>$array[sex] , 'country'=>$array[country] , 'province'=>$array[province] , 'city'=>$array[city] ,'isdel'=>$isdel];
}


$value['allPage'] = $pageUrl;
//$value['data'] 包含 openid ，nickname（名字），sex,国家，省份，城市
$value['data'] = $arr;
// var_dump($value['data']);
echo json_encode($value);