<?php
class TarifsController extends \DefaultController {
	public function initialize(){
		parent::initialize();
		$this->model="Tarif";
	}

	protected function _deleteMessage($object){
		return "Confirmez-vous la suppression du tarif <b>".$object."</b> ?";
	}
}