<?php
//test code
require_once('utils.php');
require_once('service.php');
require_once('db.php');
//test get_access_token function
//echo get_access_token();
$tstr ="<xml>
		<ToUserName><![CDATA[toUser]]></ToUserName>
		<FromUserName><![CDATA[FromUser]]></FromUserName>
		<CreateTime>123456789</CreateTime>
		<MsgType><![CDATA[event]]></MsgType>
		<Event><![CDATA[CLICK]]></Event>
		<EventKey><![CDATA[123]]></EventKey>
		</xml>";
//dispatch_msg($tstr);
$arr = array(
'inarr'=>array('ass','2323')
);
foreach($arr['inarr'] as $value){
	echo $value;
}
$db = new DB(array());
var_dump($db->select('user',array('fields'=>array('name','age'),'where'=>array('name'=>'Nick'))));
?>