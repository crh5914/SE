<?php
function dispatch_msg($msg_xml){
	//$msg_xml = file_get_contents('php://input');
	if(!empty($msg_xml)){
		$msg_obj = simplexml_load_string($msg_xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		$msg_type = $msg_obj->MsgType;
		if($msg_type=='event'){
			event_handler($msg_obj);
		}
	}
}
function event_handler($msg){
	if($msg->Event=='CLICK'){
		click_handler($msg);
		return;
	}
	if($msg->EventKey=''){
		uband_handler($msg);
		return;
	}
}
function click_handler($msg){
	if($msg->EventKey=='123'){
		band_handler($msg);
		return;
	}
}
function band_handler($msg){
	$from_user = $msg->FromUserName;
	$to_user =$msg->ToUserName; 
	$timestamp = time();
	$band_url = "http://115.159.211.193/weichat/band.php?id=$from_user&stamp=$timestamp";
	$rep_str ="<xml>
                    <ToUserName><![CDATA[$from_user]]></ToUserName>
                    <FromUserName><![CDATA[$to_user]]></FromUserName>
                    <CreateTime>$timestamp</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[$band_url]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
	echo $rep_str;
}
?>