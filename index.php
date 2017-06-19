<?php
header('Content-type:text');
define("TOKEN", "helper");
include_once('service.php');
$wechatObj = new WechatCallback();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class WechatCallback
{
	private $service;
	function __construct(){
		$this->service = new Service();	
	}
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            header('content-type:text');
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        //获取微信后台推送的消息
    	$postStr = file_get_contents('input.txt');
        //如果不为空，进入事件循环中
        if(!empty($postStr)){
        	$xml = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        	//进入业务处理
        	$this->service->messageDispatcher($xml);
        }else{
        	echo "";
        	exit;
        }
    }
}
?>