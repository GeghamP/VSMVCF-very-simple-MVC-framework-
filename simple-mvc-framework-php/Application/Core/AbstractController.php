<?php
namespace Application\Core; 

abstract class AbstractController{
	protected $route;
	protected $view;
	protected $model;
	protected $acl_list;
	
	public function __construct($route){
		$this->route=$route;
		//$_SESSION["authorized"]["id"]=123;
		//$_SESSION["admin"]=123;
		if(!$this->checkAcl()){
			View::errorpage(403);
		}
		$this->view=new View($route);
		//$this->model=$this->loadModel($route["controller"]);
	}
	
	public function loadModel($name){
		$name=ucfirst($name);
		$class_path="\\Application\\Models\\{$name}";
		if(class_exists($class_path)){
			return new $class_path();
		}
		else{
			throw new \Application\Exceptions\ClassNotFoundException();
		}
	}
	
	public function checkAcl(){
		$this->acl_list=require("./Application/acl/".$this->route["controller"].".php");
		if($this->isAcl("all")){
			return true;
		}
		elseif(isset($_SESSION["authorized"]["id"]) && $this->isAcl("authorized")){
			return true;
		}
		elseif(!isset($_SESSION["authorized"]["id"]) && $this->isAcl("guest")){
			return true;
		}
		elseif(isset($_SESSION["admin"]) && $this->isAcl("admin")){
			return true;
		}
		return false;
	}
	
	
	public function isAcl($key){
		return in_array($this->route["action"],$this->acl_list[$key]);
	}
}
?>