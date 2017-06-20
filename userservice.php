<?php
include_once('dbconfig.php');
class UserService{
	private $ops = array('band'=>'band','login'=>'login','unband'=>'unband');
	private $dbh;
	public function __construct(){
		try{
			$dbh = new PDO($dsn,$user,$pass,array(PDO::ATTR_PERSISTENT => true));
		}catch(PDOException $e){
			die('error message '.$e->getMessage());
		}
	}
	private function hasOps($op){
		if(array_key_exists($op, $this->ops)){
			return true;
		}
	    $res = array('success'=>false,'msg'=>'operation unidentified!');
		echo json_encode($res);
		return false;
	}
	public function exec($op){
		if(!$this->hasOps($op)){
			return false;
		}
		$handler = $this->ops[$op];
		return $this->$handler();
	}
	private function bind(){
		$name = isset($_POST['name'])?$_POST['name']:'';
		$pwd = isset($_POST['password'])?$_POST['password']:'';
		$openId = isset($_POST['openid'])?$_POST['openid']:'';
		$res = array();
		//判断参数是否齐全
		if(empty($name)||empty($pwd)||empty($openId)){
			$res = array('code'=>1,'msg'=>'lack of parameter');
			echo json_encode($res);
			return false;
		}
		//判断用户是否存在及密码是否正确
		$cr = checkUser($name,$password);
		if(!cr[0]){
			$res = array('code'=>1,'msg'=>'incorrect username or password');
			echo json_encode($res);
			return false;
		}
		$uid = cr[1];
		//判断是否被绑定过
		if(hasBanded(openid,uid)){
			$res = array('code'=>1,'msg'=>'here has existed banding links belongs to weichat number or user number');
			echo json_encode($res);
			return false;
		}
		//绑定业务
		$sql = 'INSERT INTO link VALUES(:openid,:uid)';
		$stmt = $dbh->prepare($sql);
		$rs = $stmt->execute(array(':openid'=>$openid,':uid'=>$uid));
		if(!$rs){
			$res = array('code'=>1,'msg'=>'band failed');
		    echo json_encode($res);
			return false;
		}
		$res = array('code'=>0,'userinfo'=>array('uid'=>$uid,'name'=>$name,'linkwc'=>$openId));
		echo json_encode($res);
		return true;
	}
	private function unbind(){
		$openId = isset($_POST['openid'])?$_POST['openid']:'';
		$res = array();
		//判断参数是否齐全
		if(empty($openId)){
			$res = array('code'=>1,'msg'=>'lack of parameter');
			echo json_encode($res);
			return false;
		}
		//解绑定业务
		$sql = 'DELETE FROM link WHERE openid = :openid';
		$stmt = $dbh->prepare($sql);
		$rs = $stmt->execute(array(':openid'=>$openid));
		//解绑定失败
		if(!$rs){
			$res = array('code'=>1,'msg'=>'unband failed');
		    echo json_encode($res);
			return false;
		}
		//解绑定成功
		$res = array('code'=>0,'msg'=>'unband success');
		echo json_encode($res);
		return true;
	}
	private function login(){
		$name = isset($_POST['name'])?$_POST['name']:'';
		$pwd = isset($_POST['password'])?$_POST['password']:'';
		$res = array();
		//判断参数是否齐全
		if(empty($name)&&empty($pwd)){
				$res = array('code'=>1,'msg'=>'lack of parameter');
				echo json_encode($res);
				return false;
		}
	    return loginNormal($name,$password);
	}
	private function loginNormal($name,$password){
		//用常规登录
		$cr = checkUser($name,$password);
		if(!$cr[0]){
			$res = array('code'=>1,'msg'=>'incorrect name or password ');
			echo json_encode($res);
			return false;
		}
		$_SESSION['uid'] = $cr[1];
		$res = array('code'=>0,'uid'=>$cr[1]);
		echo json_encode($res);
		return false;
	}
	private function checkUser($name,$password){
		$res = array();
		$sql = 'SELECT * FROM account WHERE Name=:name AND PWD=:pwd';
		$stmt = $dbh->prepare($sql);
		$stmt->execute(array(':name'=>$name,':pwd'=>$password));
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
		if(empty($rs)){
			$res[0]=false;
			return $res;
		}
		$res[1] = $rs['ID'];
		return $res;
	}
}