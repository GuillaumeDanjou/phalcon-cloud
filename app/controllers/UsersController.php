<?php

class UsersController extends DefaultController{
	public function initialize(){
		parent::initialize();
		$this->model="Utilisateur";
	}

	/* (non-PHPdoc)
	 * @see _DefaultController::setValuesToObject()
	 */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		$object->setAdmin((isset($_POST["admin"]))?1:0);
	}

	public function frmAction($id=NULL){
		$user=$this->getInstance($id);
		$this->view->setVars(array("user"=>$user,"siteUrl"=>$this->url->getBaseUri(),"baseHref"=>$this->dispatcher->getControllerName()));
		parent::frmAction($id);
	}

	protected function _deleteMessage($object){
		return "Confirmez-vous la suppression de l'utilisateur <b>".$object."</b> ?";
	}
}

