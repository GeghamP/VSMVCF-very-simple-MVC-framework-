<?php

namespace Application\Core; 
class Router {
	
	protected $routes=[];
	protected $params=[];
	
	public function __construct(){
		$arr=require("./Application/config/routes.php");
		foreach($arr as $key=>$val){
			$this->add($key,$val);
		}
	}
	
	public function add($route,$params){
		// we use #'s in $route because '/' will not be a valid delimiter 
		// we can use +'s or ()'s instead
		$route="#^".$route."$#";
		$this->routes[$route]=$params;
	}
	
	
	public function match(){
		$url=substr($_SERVER["REQUEST_URI"],1);
		$url=trim($url,"/");
		foreach($this->routes as $route=>$params){
			if(preg_match($route,$url,$matches)){
				$this->params=$params;
				return true;
			}
		}
		return false;
	}
	public function run(){
		if($this->match()){
			$controller_name=ucfirst($this->params["controller"]."Controller");
			$controller_path="\\Application\\Controllers\\".$controller_name;
			if(class_exists($controller_path)){
				$action="Action".ucfirst($this->params["action"]);
				if(method_exists($controller_path,$action) && is_callable($controller_path,$action)){
					$controller=new $controller_path($this->params);
					$controller->{$action}();
				}
				else {
					throw new \Application\Exceptions\BadActionCallException( "Action does not exist");
				}
			}
		}
		else{
			View::errorPage(404);
		}
	}	
	
}


?>