<?php

include 'model.php';
include 'Page2.php';

//分页

$model = new Model();

//分页处理
$count = $model->table('sucai')->count('*');

$count = $count[0]['count'];


$num = 3;

$page = new Page($num, $count);
 
$offset = $page->limit();

$result = $model->table('sucai')->order('time desc')->limit($offset)->select();

$info['data']= $result;
$info['page']= $page->allPage();

// 通过json格式给客户端提供数据
if (!empty($info)) {
	echo json_encode($info);
}