<?php

header("Content-type:text/html;charset=utf-8");
include 'token.php';
include 'Model.php';
$config = include 'config.php';
define('TOKEN', 'HiGentalMen');


class WeChat
{

	//二级菜单
	function subMenu () 
	{
		$token = cacheToken();
		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='. $token;
			$data['button'][0] = ['name' => '主菜单'];
			$data['button'][0]['sub_button'][0] = [
				'type' => 'location_select',
				'name' => '发送位置',
				'key' => 'location'
			];
			$data['button'][0]['sub_button'][1] = [
				'type' => 'view',
				'name' => '搜索',
				'url' => 'http://www.baidu.com'
			];
			$data['button'][0]['sub_button'][2] = [
				'type' => 'scancode_waitmsg',
				'name' => '扫一扫',
				'key' => 'sao'
			];

			$data['button'][1] = ['name' => '微娱乐'];
			$data['button'][1]['sub_button'][0] = [
				'type' => 'view',
				'name' => '天气',
				'url' => 'http://weChat.skxto9314.com/api/wea.html',
			];
			$data['button'][1]['sub_button'][1] = [
				'type' => 'view',
				'name' => '空气质量',
				'url' => 'http://weChat.skxto9314.com/api/ox.html'
			];
			$data['button'][1]['sub_button'][2] = [
				'type' => 'view',
				'name' => '日历',
				'url' => 'http://weChat.skxto9314.com/api/year.html',
			];
			$data['button'][1]['sub_button'][3] = [
				'type' => 'view',
				'name' => '音乐',
				'url' => 'https://music.163.com',
			];

			$data['button'][2] = [
				'type' => 'pic_photo_or_album',
				'name' => '发图',
				'key' => 'photo'
			];



 		$curl = new MyCurl($url);
		
		
		$str = json_encode($data, JSON_UNESCAPED_UNICODE);
		$ret = $curl->post($str);



	}


	//建立自己的服务器和微信的服务器的连接
	public function check()
	{
		$echoStr = $_GET['echostr'];
		if ($this->checkSignature()) {
			//赞正成功
			echo $echoStr;
		} else {

		}
	}
	private function checkSignature()
	{
    $signature =  $_GET["signature"];
    $timestamp = $_GET["timestamp"];
    $nonce =  $_GET["nonce"];
	$token = TOKEN;
	$tmpArr = array($token, $timestamp, $nonce);
	sort($tmpArr, SORT_STRING);
	$tmpStr = implode( $tmpArr );
	$tmpStr = sha1( $tmpStr );

	if( $signature == $tmpStr ){
			return true;
	}else{
			return false;
		}
	}

	// 自动回复的方法
	public function responseMessage()
	{
		$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>
				<MsgType><![CDATA[%s]]></MsgType>
				<Content><![CDATA[%s]]></Content>
			</xml>";
		//$postr = $GLOBALS('HTTP_RAW_POST_DATA');
		$postr = file_get_contents('php://input');
		file_put_contents('msg.txt', $postr);
		$obj = simplexml_load_string($postr);

		//发送给用户的id可以获取到   是杨洋的
		$fromUser = $obj->ToUserName;
		$toUser = $obj->FromUserName;
		//用户发给我的内容
		$content = $obj->Content;

		$time = time();
		$type = 'text';
		



		if($obj->MsgType == 'voice'){
			$id = $obj->MediaId;
			$this->responseSound($obj,$id);
			die;
		}

		if($obj->MsgType == 'image'){
			$id = $obj->MediaId;
			$this->responseImg($obj,$id);
			die;
		}

		if($obj->MsgType == 'event'){
			$this->responseSub($obj);
			die;
		}

		if (strstr($content, '音乐')) {
			$this->responseMusic($obj);
			die;
		} else if (strstr($content, '图片')) {
			$this->responseImage($obj);
			die;
		}else if(strstr($content, '视频')) {
			$this->responseVideo($obj);
			die;
		}else if(strstr($content, '时间'))
		{
			$value = date('Y-m-d H:i:s' , time());
		}else if(strstr($content, '图文'))
		{
			$this->ImgText($obj);
			die;
		}else if(strstr($content, '素材'))
		{
			// $this->source();
			die;
		}else
		{
			$rand = mt_rand(1,9);

			switch($rand)
			{
				case 1:
					$value = 'What makes the desert beautiful is that somewhere it hides a well…
					沙漠之所以美丽，是因为在它的某个角落隐藏着一口井水……';
					break;
				case 2:
					$value = 'You know — one loves the sunset, when one is so sad…
					你知道 — 当一个人情绪低落的时候，他会格外喜欢看日落……';
					break;
				case 3:
					$value = "It doesn't matterthat you are not here in person as long as you are here in my heart.就算你不在这里也没关系，因为你在我心里";
					break;	
				case 4:
					$value = '既入得我门来,当尊我教旨。本门行事,以率性为先。该吃饭时吃饭,该睡觉时睡觉,该怼时开怼,自可立地飞升。如能转发,则功德倍增。只修今生,不待来世。一万年太久,只争朝夕。';
					break;	
				case 5:
					$value = 'It is the time you have wasted for your rose that makes your rose so important。
					你在你的玫瑰花身上耗费的时间使得你的玫瑰花变得如此重要';
					break;
				case 6:
					$value = '我们都是第一次过自己的人生，所以会笨拙生疏，所以会觉得抱歉，所以有点小失误也是可以的！';
					break;
				case 7:
					$value = '世上最暴力的语言就是：像个男人，像个女人，像个妈妈，像个医生，像个学生……';
					break;	
				case 8:
					$value = '离别也需要慢慢练习，以后会慢慢好起来的！';
					break;
				case 9:
					$value = '沙漠的游牧民族，一到晚上就会把骆驼这么拴起来， 而到了早上就会解开缰绳，但即使这样骆驼也不会逃走 ，因为它永远记得被拴在树上的那个夜晚 。就像我们记得曾经的伤痛一样，它会拴住现在的我们。';
					break;				
			}


		}

		
		echo sprintf($str,$toUser,$fromUser, $time, $type, $value);
	}	


	// 图片
	private function responseImage($obj)
	{

		$str = '<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>';

		$type="image";
$media_id="2Rn3HOxuchDu0XJAb6LQuHH4XRVHvF9l2XnKl8hLnNgw5E48mn-BTLtBNGlQAaio";

		echo sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$type,$media_id);
	}

	// 视频
	private function responseVideo($obj)
	{
$str = "<xml><ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Video><MediaId><![CDATA[%s]]></MediaId></Video>
            </xml>";

		$type = 'video';

$media_id='pxymbVFO-5G6kzbXtr6eywA5GbogApSc2qgSeMihLEBZ81JwJK2jJV2gQlAja00t';

		echo sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$type,$media_id);
	}

	// 语音
	private function responseSound($obj,$id)
	{

		$str = '<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[%s]]></MsgType>
			<Voice><MediaId><![CDATA[%s]]></MediaId></Voice>
			</xml>';
		$type="voice";
		echo sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$type,$id);
	}

	// 关注
	private function responseSub($obj)
	{
		$str = '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>';

		$cont = 'HEY GentalMen ！没什么好说的,你就直接回复 图文 音乐 视频 图片吧';
		echo sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$cont);
	}

	// 发图片回复图片
	private function responseImg($obj,$media_id) {
		$str = '<xml><ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[%s]]></MsgType>
		<Image><MediaId><![CDATA[%s]]></MediaId></Image></xml>';
		$type="image";
		echo sprintf($str,$obj->FromUserName,$obj->ToUserName,time(),$type,$media_id);
	
	}

	//自动回复音乐 
	private function responseMusic($obj)
	{
		$str = "
				<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Music>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<MusicUrl><![CDATA[%s]]></MusicUrl>
							<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
							<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
						</Music>
					</xml>
             ";
        $Title = '唯有你';
	    $Description = '金泰宇';
        $type = 'music';
    	$MusicUrl = 'http://weChat.skxto9314.com/public/唯有你.mp3';	
    	$HQMusicUrl = 'http://weChat.skxto9314.com/public/唯有你.mp3';  
    	$ThumbMediaId = 'krFMrxDY6cVfiGKTjJvICVaBEzQ6tiGy3EN9J4T0prTKeM9u5KcROwFK2SeNIrUI';
    	echo sprintf($str,$obj->FromUserName,$obj->ToUserName, time(),$type,$Title, $Description,$MusicUrl, $HQMusicUrl,$ThumbMediaId);
	}

	// 图文
	private function ImgText($obj)
	{
		$str = '<xml>
					<ToUserName><![CDATA[' . $obj->FromUserName . ']]></ToUserName>
					<FromUserName><![CDATA[' . $obj->ToUserName . ']]></FromUserName>
					<CreateTime>' . time() . '</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>2</ArticleCount>
					<Articles>
						<item>
							<Title><![CDATA[《三年二班》周杰伦同学，《等你下课》喝珍珠奶茶哦！]]></Title> 
							<Description><![CDATA[我唱告白气球 终于你回了头 躺在你学校的操场看星空 教室里的灯还亮着你没走 记得 我写给你的情书 都什么年代了 到现在我还在写着]]></Description>
							<PicUrl><![CDATA[http://weChat.skxto9314.com/public/006.jpg]]></PicUrl>
							<Url><![CDATA[https://mp.weixin.qq.com/s/kjJT9-Q89cAdedFz_5jtVQ]]></Url>
						</item>
						<item><Title><![CDATA[我正在努力，你不要喜欢别人！]]></Title>
							<Description><![CDATA[我也曾试着低三下气地去挽留过，但那种手段，就好像癌症晚期时他人的一句早日康复，除了徒增伤感和讽刺，没有任何用处]]></Description>
							<PicUrl><![CDATA[http://weChat.skxto9314.com/public/005.jpg]]></PicUrl>
							<Url><![CDATA[http://blog.weixin163.com/archives/31852]]></Url>
						</item>
					</Articles>
				</xml>';

		echo $str;

	}

	// 群发
    function sendinfo($word)
    {
        $token = cacheToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$token;
        //$curl = new MyCurl($url);

        $data['filter'] = ['is_to_all'=>true];
        $data['text'] = ['content'=> $word];
        $data['msgtype'] = 'text';

        $curl = new MyCurl($url);
        $str = json_encode($data, JSON_UNESCAPED_UNICODE);

        $ret = $curl->post($str);

        
    }

    function addSource()
    {

    	// $token = cacheToken();
    	$token = '6_56hTPAnNKHarML5RRWK95Q494Z8BKmhLqizijnQRkTxi8r7JG7PN0TE2ZTmcLYq-n-KHtcN6knKwZPBEq6dj7m1cHHO8vgFl0zkjTxBy6I2e5GhPmiK-x87YuFZFBkZyL5mmlI9_aPU78VjfTXRiAHAPTN';
    	$url = "https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=".$token."&type=image";

		$josn2 = array("media"=>"@1.jpg");
		$curl = new MyCurl($url);echo 55555555;
		$row = $curl->post($josn2);
		// $row = json_decode($content);
		var_dump($row);
		echo $row;
		echo $row->media_id;

    }

	//新增永久图文素材
	public function add()
	{
		$token=cacheToken();
		$time = time();
		$url ="https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=".$token;
		$str = '{
				"articles": [{
				"title": "Tomorrow",
				"thumb_media_id": "x1meQ9U6c2_XsVPuSYXa0JgmfSeD58HFjBNSoKuW_lIFNuZoFKBCO2Wlet4zIR3p",
				"author": "zhaojisheng",
				"digest": "The best preparation for tomorrow is doing your best today",
				"show_cover_pic": 1,
				"content": "The day you went away",
				"content_source_url":"http://www.baidu.com"
				}
				//若新增的是多图文素材，则此处应还有几段articles结构
				]
				}';
		// $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=image";
		// $str = '{"type":"image","media_id":"CLvUrKOzcFKI0RqkVXF8tN3Oa4qSlkgA1TbdSkr6HCTJdyNzuOlzoqrSTJeefKS7","created_at":"1516332123"}';
		$curl = new MyCurl($url);
		$ret = $curl->post($str);
		echo $ret;
	}
}










// 6_E7RR1GHkVnqWTm-B20ld2Q-9u-QOmbJMWqTVJrcuhMcAmxGv0il1e11m6muWWe_Xi_6iqmv5sURR1gmS9ldYXekDtqgsCAnx2dvOUdgpdDapi3u_u9lYncWh9El24jhxG37gqVjEc0dl3bloIXPbADADSK




