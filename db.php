<?php
class DB
{
  private $host;
  private $port;
  private $dbname;
  private $user;
  private $password;
  private $charset;
  private $conn;
  function __construct($config){
	  $this->host = isset($config['host'])?$config['host']:'localhost';
	  $this->port = isset($config['port'])?$config['port']:3306;
	  $this->user = isset($config['user'])?$config['user']:'root';
	  $this->password = isset($config['password'])?$config['password']:'root';
	  $this->dbname = isset($config['dbname'])?$config['dbname']:'test';
	  $this->charset = isset($arr['charset']) ? $arr['charset'] : 'utf8';
	  $this->conn = mysql_connect($this->host.":".$this->port,$this->user,$this->password)or die("connect to database failed!");
      $this->select_db();
  }
  private function select_db(){
	  mysql_query("set names ".$this->charset,$this->conn);
      mysql_select_db($this->dbname,$this->conn);
  }
  function select($table,$config){
	$sql = 'select ';
	$field_str = '';
	$where = '';
	$order = '';
	$limit = '';
	if(isset($config['fields'])){
		foreach($config['fields'] as $value){
			$field_str .= ",$value";
		}
		$field_str = substr($field_str,1);
	}else{
		$field_str = '*'; 
	}
	if(isset($config['where'])){
		$where .= " where ";
		foreach($config['where'] as $key=>$value){
			$where .= "$key=$value and";
		}
		$where = substr($where,0,strlen($where)-4);
	}
	if(isset($config['order'])){
		$order = " order by ".$config['order'];
	}
	if(isset($config['limit'])){
		$order = " limit ".$config['limit'];
	}
	$sql =$sql.$field_str." from $table".$where.$order.$limit;
	echo $sql;
    $res = mysql_query($sql,$this->conn);
	if(!$res)
		return $res;
	$arr = array();
	while($row=mysql_fetch_row($res)){
		$arr[] = $row;
	}
	return $arr;
  } 
  function execute($sql){
	   $res = mysql_query($sql,$this->conn);
	   if(!$res)
		return $res;
	   $arr = array();
	   while($row=mysql_fetch_row($res)){
		   $arr[] = $row;
	   }
	   return $arr;
  }
  function update($table,$data){
	  $sql = "update $table set ";
	  $data_str = "";
	  foreach($data as $key=>$value){
		  $data_str .= "$key=$value "; 
	  }
	  $data_str = substr($data_str,0,strlen($data_str)-1);
	  $sql .= $data_str; 
	  $res = mysql_query($sql,$this->conn);
      return mysql_affected_rows($res);
  }  
  function insert($table,$record){
	  $sql = "insert into $table values ( ";
	  $in = '';
	  foreach($record as $value){
		  $in .= "$value ,";
	  }
	  $in = substr($in,0,strlen($in)-2);
	  $sql = $sql.$in." )";
	  $res = mysql_query($sql,$this->conn);
      return mysql_insert_id();	  
  }
  function close(){
	 if(isset($this->conn)){
		 mysql_close($this->conn);
	 }
  }
}
?>