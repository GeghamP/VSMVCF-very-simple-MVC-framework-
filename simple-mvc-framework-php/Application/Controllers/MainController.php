<?php
namespace Application\Controllers;

use Application\Core\AbstractController;

class MainController extends AbstractController{
	
	public function actionIndex(){
		$this->view->render("Main page");
	}
}
?>