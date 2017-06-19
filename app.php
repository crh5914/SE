<?php
include_once('userservice.php');
include_once('appservice.php');
class App{
	//与用户相关的逻辑
	private $userService;
	//与应用相关的逻辑
	private $appService;
	
	public function __construct(){
		$userService = new UserService();
		$appService = new AppService();
	}
	public function requestDispatcher(){
		if(empty($_GET['role'])||empty($_GET['op'])){
			$error = array('code'=>1,'msg'=>'bad request');
			echo json_encode($error);
			return false;
		}
		//调用用户业务类型处理逻辑
		if(trim($_GET['role'],' ')=='u'){
			return $this->userService->exec($_GET['op']);
		}
		//调用业务类型处理逻辑
		if(trim($_GET['role'],' ')=='s'){
			return $this->appService->exec($_GET['op']);
		}
		//未定义业务类型
		$res = array('code'=>1,'msg'=>'out of handle');
		echo json_encode($res);
		return false;
	}
}
$app = new App();
$app->requestDispatcher();