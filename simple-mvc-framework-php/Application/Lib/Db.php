<?php
namespace Application\Lib;

class Db{
	protected $db;
	
	public function __construct(){
		$db_config=require("./Application/config/db.php");
		$this->db=new \PDO("mysql:host=".$db_config["host"].";dbname=".$db_config["name"],$db_config["user"],$db_config["password"]);
	}
	
	public function query($sql,$params=[]){
		$stmt=$this->db->prepare($sql);
		if(!empty($params)){
			foreach($params as $key=>$val){
				$stmt->bindValue(":{$key}",$val);
			}
		}
		$stmt->execute();
		return $stmt;
	}
	
	public function row($sql,$params=[]){
		$result=$this->query($sql,$params);
		return $result->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	public function column($sql,$params=[],$num=0){
		$result=$this->query($sql,$params);
		return $result->fetchColumn($num);
	}
}

?>