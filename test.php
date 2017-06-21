<?php
class Test{
	//数据访问对象
	private $dsn;
	private $user;
	private $pwd;
	private $opMap = array('band'=>'band','login'=>'login','query'=>'query');
	//数据访问对象
	public static $pdo;
	public function __construct(){
		$this->dsn = 'mysql:host=localhost;dbname=visit_assistant';
		$this->user = 'root';
		$this->pwd = 'root';
		if(!isset(self::$pdo)){
			try{
				self::$pdo = new PDO($this->dsn,$this->user,$this->pwd,array(PDO::ATTR_PERSISTENT=>true));
			}catch(PDOException $e){
				die('error message '.$e->getMessage());
			}
		}
	}
    function query($uid,$park,$block){
       $sql = 'SELECT * FROM buildingstructure WHERE Residentialarea_Name=:park';
       $stmt = self::$pdo->prepare($sql);
       $flag = $stmt->execute(array(':park'=>$park));
       if($flag){
       	  $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	  echo json_encode($rs);
       }
    }
}
$t = new Test();
$t->query('111', '海富花园', 'block')
?>
