<?php
header("Content-type:text/html;charset=utf-8");
require_once 'curl.func.php';
 
$appkey = '3fae3d43b6fc0b64';//你的appkey
$date = $_POST['date'];
$url = "http://api.jisuapi.com/calendar/query?appkey=$appkey&date=$date";
$result = curlOpen($url);
$jsonarr = json_decode($result, true);
//exit(var_dump($jsonarr));
 
if($jsonarr['status'] != 0)
{
    echo $jsonarr['msg'];
    exit();
}
 
$result = $jsonarr['result'];
echo $result['year'].' '.$result['month'].' '.$result['day'].' '.$result['week'].' '.$result['lunaryear'].' '.$result['lunarmonth'].' '.$result['lunarday'].' '.'<br>';
$huangli = $result['huangli'];
echo $huangli['nongli'].' '.$huangli['taishen'].' '.$huangli['wuxing'].' '.$huangli['chong'].' '.$huangli['sha'].' '.$huangli['jiri'].' '.'<br>';
foreach($huangli['yi'] as $val)
{
    echo $val.'<br>';
}