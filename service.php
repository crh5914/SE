<?php
class Service{
	private $handlerMap = array('text'=>'textMsgHandler','event'=>'eventMsgHandler');
	private $fromUserName;
	private $toUserName;
	private $msgType;
	//消息分发函数，根据消息类型负责分发消息
	public function messageDispatcher($xml){
		$this->msgType = $xml->MsgType->__toString();
		$this->fromUserName = $xml->FromUserName->__toString();
		$this->toUserName = $xml->ToUserName->__toString();
		//var_dump($this->msgType);
		if(array_key_exists($this->msgType, $this->handlerMap)){
			
			$handler = $this->handlerMap[$this->msgType];
			$this->$handler($xml);
		}else{
			echo "";
			exit;
		}
	}
	//文本消息处理
	private function textMsgHandler($xml){
		$content = $xml->Content->__toString();
		if(!empty($content)&&trim($content,' ')=='?'){
			$t = time();
			$resTpl = "<xml>
			<ToUserName><![CDATA[$this->fromUserName]]></ToUserName>
			<FromUserName><![CDATA[$this->toUserName]]></FromUserName>
			<CreateTime>$t</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>2</ArticleCount>
			<Articles>
			<item>
			<Title><![CDATA[智能扫楼助手]]></Title>
			<Description><![CDATA[智能扫楼助手]]></Description>
			<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
			<Url><![CDATA[http://115.159.211.193/weichat/login.php?openid=$this->fromUserName&t=$t]]></Url>
			</item>
			<item>
			<Title><![CDATA[智能扫楼助手]]></Title>
			<Description><![CDATA[智能扫楼助手]]></Description>
			<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
			<Url><![CDATA[http://115.159.211.193/weichat/login.php?openid=$this->fromUserName&t=$t]]></Url>
			</item>
			</Articles>
			</xml>"; 
			echo $resTpl;
		}else{
			return "";
			exit;
		}
	}
	//事件消息处理
	private function eventMsgHandler($xml){
		$event = trim($xml->Event->__toString(),' ');
		if(!empty($event)&&$event=='CLICK'){
			$eventKey = trim($xml->EventKey->__toString(),' ');
			$url = '';
			if(!empty($eventKey)&&$eventKey=='band'){
				$url = "http://115.159.211.193/weichat/band.php";
			}
			if(!empty($eventKey)&&$eventKey=='unband'){
				$url = "http://115.159.211.193/weichat/unband.php";
			}
			if(!empty($eventKey)&&$eventKey=='login'){
				$url = "http://115.159.211.193/weichat/login.php";
			}
			$t = time();
			$url =$url."?openid=$this->fromUserName&t=$t";
			$res = "<xml>
			<ToUserName><![CDATA[$this->fromUserName]]></ToUserName>
			<FromUserName><![CDATA[$this->toUserName]]></FromUserName>
			<CreateTime>$t</CreateTime>
			<MsgType><![CDATA[news]]></MsgType>
			<ArticleCount>2</ArticleCount>
			<Articles>
			<item>
			<Title><![CDATA[智能扫楼助手]]></Title>
			<Description><![CDATA[智能扫楼助手]]></Description>
			<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
			<Url><![CDATA[$url]]></Url>
			</item>
			<item>
			<Title><![CDATA[智能扫楼助手]]></Title>
			<Description><![CDATA[智能扫楼助手]]></Description>
			<PicUrl><![CDATA[http://115.159.211.193/weichat/images/logo2.png]]></PicUrl>
			<Url><![CDATA[$url]]></Url>
			</item>
			</Articles>
			</xml>";
			echo $res;
		}else{
			echo "";
			exit;
		}
	}
}
?>