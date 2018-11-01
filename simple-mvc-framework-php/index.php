<?php
require(__DIR__."/vendor/autoload.php");

use Application\Core\Router;
use Application\Log\Logger;
use Application\Core\View;

session_start();
try{	
	$router=new Router();
	$router->run();
}
catch(Exception|Error $e){
	$logger=new Logger();
	$logger->log($e);
	View::errorPage(404);
}
?>