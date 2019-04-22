<?php
header("Content-type:text/html;charset=utf-8");
include 'upload.php';

include 'model.php';

include 'MyCurl.php';

$up = new Upload(["path"=>"upload"]);

$upload = $up->up('file');

if(empty($upload)){

    exit("<a href='http://weChat.skxto9314.com/up.html'>图片不合法</a>");
}

//素材
$sucai = new sucai();

$madia = $sucai->addImg($upload);

//添加到数据库
$model = new Model();

$data['madia'] = $madia;
$data['time'] = time();
$data['img'] = $upload;
$insert = $model->table('sucai')->add($data);

if($insert){

     // echo "<meta http-equiv='refresh' content='http://weChat.skxto9314.com/up.html , 3' />";
	 exit("<a href='http://weChat.skxto9314.com/up.html'>上传成功</a>");
}else{
    // echo "<meta http-equiv='refresh' content='http://weChat.skxto9314.com/up.html , 3' />";
	 exit("<a href='http://weChat.skxto9314.com/up.html'>上传失败</a>");
}


//素材处理

class Sucai
{	

	//获取toten
	
	public function getToken()
	{
		$token = file_get_contents('token.txt');

		$curl = json_decode($token);

		$token = $curl->access_token;

		return $token;

	}


	 //添加图片
    
    public function addImg($upload)
    {
        $token = $this->getToken();

        
        $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=image";

        
        //括号里面是你的资源在根目录下的位置
        if (class_exists('\CURLFile')) { 

            $data = array('media' => new \CURLFile(realpath($upload)));                
        } else {  

            $data = array('media' => '@' . realpath($upload));  
        } 

        
        $curl = new MyCurl($url );

        $obj = $curl->post($data); 
        $newImg = json_decode($obj);

        $madia = $newImg->media_id;
        //echo $madia;
        return $madia;
    }

}





