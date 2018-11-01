<?php
namespace Application\Core; 

class View{
	public $path;
	//public $route;
	public $layout='default';
	
	public function __construct($route){
		//$this->route=$route;
		$this->path=$route["controller"]."/".$route["action"];
	}
	
	public function render($title,$vars=[]){
		//in real project we should not put in extract untrusted data of user input, we should validate first
		extract($vars);
		if(file_exists("./Application/views/{$this->path}.php")){
			ob_start();
			require("./Application/views/{$this->path}.php");
			$content=ob_get_clean();
			require("./Application/views/layouts/{$this->layout}.php");
		}
		else{
			echo "No view";
		}
	}
	
	public static function errorPage($code){
		http_response_code($code);
		if(file_exists("./Application/views/errors/{$code}.php")){
			require("./Application/views/errors/{$code}.php");
		}	
		exit();
	}
	
	public function redirect($url){
		header("Location: {$url}");
		exit();
	}
	
	// for account/login
	
	public function message($status,$message){
		exit(json_encode(["status"=>$status ,"message"=>$message]));
	}
	
	public function location($url){
		exit(json_encode(["url"=>$url]));
	}
	
}


?>