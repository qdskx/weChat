<?php
header("Content-type:text/html;charset=utf-8");
require_once 'curl.func.php';
 
$appkey = '3fae3d43b6fc0b64';//你的appkey
$city = $_POST['city'];//utf8
$url = "http://api.jisuapi.com/aqi/query?appkey=$appkey&city=$city";
$result = curlOpen($url);
$jsonarr = json_decode($result, true);
//exit(var_dump($jsonarr));
if($jsonarr['status'] != 0)
{
    echo $jsonarr['msg'];
    exit();
}
 
$result = $jsonarr['result'];
echo $result['cityid'].' '.$result['city'].' '.$result['so2'].' '.$result['so224'].' '.$result['no2'].' '.$result['no224'].' '.$result['co'].' '.$result['co24'].' '.$result['o3'].' '.$result['o38'].' '.$result['o324'].' '.$result['pm10'].' '.$result['pm1024'].' '.$result['pm2_5'].' '.$result['pm2_524'].' '.$result['iso2'].' '.$result['ino2'].' '.$result['ico'].' '.$result['io3'].' '.$result['io38'].' '.$result['ipm10'].' '.$result['ipm2_5'].' '.$result['aqi'].' '.$result['primarypollutant'].' '.$result['quality'].' '.$result['timepoint'].'<br>';
echo $result['aqiinfo']['level'].' '.$result['aqiinfo']['color'].' '.$result['aqiinfo']['affect'].' '.$result['aqiinfo']['measure'].' '.'<br>';
 
foreach($result['position'] as $position)
{
    echo $position['positionname'].' '.$position['so2'].' '.$position['so224'].' '.$position['no2'].' '.$position['no224'].' '.$position['co'].' '.$position['co24'].' '.$position['o3'].' '.$position['o38'].' '.$position['o324'].' '.$position['pm10'].' '.$position['pm1024'].' '.$position['pm2_5'].' '.$position['pm2_524'].' '.$position['iso2'].' '.$position['ino2'].' '.$position['ico'].' '.$position['io3'].' '.$position['io38'].' '.$position['ipm10'].' '.$position['ipm2_5'].' '.$position['aqi'].' '.$position['primarypollutant'].' '.$position['quality'].' '.$position['timepoint']. '<br>';
}