<?php
class ServicesController extends \DefaultController {
	public function initialize(){
		parent::initialize();
		$this->model="Service";
	}

	protected function _deleteMessage($object){
		return "Confirmez-vous la suppression du service <b>".$object."</b> ?";
	}
}