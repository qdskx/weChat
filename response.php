<?php
class Response
{
	public function responseMessage()
	{
		$postr = file_get_contents('php://input');
		file_put_contents('msg.txt',$postr);
		$obj = simplexml_load_string($postr);
		// var_dump($obj);
		//发送信息需要,信息上传数据库需要的参数
		//$formUser = $obj->ToUserName;
		$user = $obj->FromUserName;
		
		$time = $obj->CreateTime;
		$type = $obj->MsgType;
		if ($type == 'text') {
			if (!empty($obj->Content)) {
			$content = $obj->Content;
			} else {
				$content = '无';
			}
		}
		$msgid = $obj->MsgId;		

		// 将信息传到数据库
		if (!empty($user)) {
			$dsn = 'mysql:host=localhost;dbname=wechat;charset=utf8';
			$pdo = new PDO($dsn , 'root' , 'skxto9314_');
			$sql = "insert into wx_msg (openid , time , type , content  , msgid ) values ('$user' , '$time' , '$type' , '$content'  , '$msgid' )";
			$stmt = $pdo->exec($sql);
		}
		
		}

	}


