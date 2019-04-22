<?php

//写天龙八部
//1连接数据库
$link = mysqli_connect('localhost','root','skxto9314_');
//判断数据库连接是否成功
if ($link == false) {
	exit(mysqli_connect_error());
}
//选择数据库

mysqli_select_db($link,'wechat');
//设置字符集
mysqli_set_charset($link,'utf8');

$mid = $_GET['mid'];

$sql = "delete from wx_msg where mid = $mid";

$result = mysqli_query($link,$sql);

$data = [];
if ($result && mysqli_num_rows($result)) {
	while($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
		
		
	}
}
echo json_encode($data);






















