<?php
//autoload function 
spl_autoload_register(function($className){
	$classpath=str_replace("\\",'/',$className);
	if(file_exists("./{$classpath}.php")){
		require("./{$classpath}.php");
	}	
	else{
		throw new \Application\Exceptions\ClassNotFoundException("Such class does not exist");
	}	
});
?>