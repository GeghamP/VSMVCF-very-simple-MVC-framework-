<?php
namespace Application\Controllers;

use Application\Core\AbstractController;

class AccountController extends AbstractController{
	public function actionLogin(){
		$this->view->render('login');
	}
	
	public function actionRegister(){
		$this->view->render('register');
	}
}
?>