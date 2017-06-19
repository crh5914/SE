<?php
class UserService{
	private $ops = array('band'=>'band','login'=>'login','unband'=>'unband');
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
		return $this->$op();
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
		$res = array('code'=>0,'userinfo'=>array('uid'=>$uid,'name'=>$name,'password'=>$password,'linkwc'=>$openId));
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
		
	}
	private function login(){
		$name = isset($_POST['name'])?$_POST['name']:'';
		$pwd = isset($_POST['password'])?$_POST['password']:'';
		$openId = isset($_POST['openid'])?$_POST['openid']:'';
		$res = array();
		//判断参数是否齐全
		if(empty($name)&&empty($pwd)){
			if(!empty($openId)){
				return $this->loginWithWc($openId);
			}else{
				$res = array('code'=>1,'msg'=>'lack of parameter');
				echo json_encode($res);
				return false;
			}
		}
	    return loginNormal($name,$password);
	}
	private function loginWithWc($openId){
		//用微信关联登录
		
	}
	private function loginNormal($openId){
		//用常规登录
		
	}
	private function checkUser($name,$password){
		
		
	}
}