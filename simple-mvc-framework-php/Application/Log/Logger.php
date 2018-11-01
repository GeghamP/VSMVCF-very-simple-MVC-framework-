<?php
namespace Application\Log;

class Logger{
	
	private $file;
	private $e;
	
	public function __construct(){
		$this->file=fopen(__DIR__."/error_log","a+");
	}
	
	public function log($e){
		fwrite($this->file,"Error: ".$e->getTraceAsString().PHP_EOL);
	} 
	
	public function __destruct(){
		fclose($this->file);
	}
}

?>