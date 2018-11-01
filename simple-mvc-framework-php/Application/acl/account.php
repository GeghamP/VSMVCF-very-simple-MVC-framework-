<?php
//access control list
return [
	"all"=>[
		//"login",
	],
	"authorized"=> [
		"register"
	],
	"guest"=> [
		"login"
	],
	"admin"=> [
		"login","register"
	],
];

?>