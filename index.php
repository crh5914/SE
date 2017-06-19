<?php
header('Content-type:text');
define("TOKEN", "helper");
$wechatObj = new wechatCallbackapiTest();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest
{
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
        $postStr = file_get_contents('php://input');
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            $time = time();
			$picTpl	=  "<xml>
							<ToUserName><![CDATA[$fromUsername]]></ToUserName>
							<FromUserName><![CDATA[$toUsername]]></FromUserName>
							<CreateTime>$time</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>2</ArticleCount>
							<Articles>
								<item>
									<Title><![CDATA[智能扫楼助手]]></Title> 
									<Description><![CDATA[智能扫楼助手]]></Description>
									<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
									<Url><![CDATA[http://115.159.211.193/weichat/test.php?openid=$fromUsername]]></Url>
								</item>
								<item>
									<Title><![CDATA[智能扫楼助手]]></Title> 
									<Description><![CDATA[智能扫楼助手]]></Description>
									<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
									<Url><![CDATA[http://115.159.211.193/weichat/test.php?openid=$fromUsername]]></Url>
								</item>
							</Articles>
						</xml>"; 
            if($keyword == "?" || $keyword == "？")
            {
                $msgType = "text";
                $contentStr = 'http://183.3.139.134:6464/app/#/login';
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                echo $picTpl;
            }
        }else{
            echo "";
            exit;
        }
    }
}
?>
