<?php
class DisquesController extends \DefaultController {
	public function initialize(){
		parent::initialize();
		$this->model="Disque";
	}

    /**
     * Affecte membre à membre les valeurs du tableau associatif $_POST aux membres de l'objet $object<br>
     * Prévoir une sur-définition de la méthode pour l'affectation des membres de type objet<br>
     * Cette méthode est utilisée par update()
     * @see DefaultController::update()
     * @param multitype:$className $object
     */
	protected function setValuesToObject(&$object) {
		parent::setValuesToObject($object);
		//TODO 4.4.1
	}

	public function frmAction($id=NULL){
		$disque=$this->getInstance($id);
		//TODO 4.4.1
		$this->view->setVars(array("disque"=>$disque,"siteUrl"=>$this->url->getBaseUri(),"baseHref"=>$this->dispatcher->getControllerName()));
		parent::frmAction($id);
	}

	/**
	 * Action à exécuter après update
	 * par défaut forward vers l'index du contrôleur en cours
	 * @param array $params
	 */
	protected function _postUpdateAction($params){
		//TODO 4.4.1
	}


	protected function _deleteMessage($object){
		return "Confirmez-vous la suppression du disque <b>".$object."</b> ?";
	}
}