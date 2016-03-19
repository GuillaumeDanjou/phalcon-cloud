<?php
class HistoriquesController extends \DefaultController {
	public function initialize(){
		parent::initialize();
		$this->model="Historique";
	}

	protected function _deleteMessage($object){
		return "Confirmez-vous la suppression de l'historique <b>".$object."</b> ?";
	}
}