<?php

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class ControllerBase extends Controller{
	public function initialize(){
		$this->view->setVar("infoUser",Auth::getInfoUser($this));
 		$bc=$this->jquery->bootstrap()->htmlBreadcrumbs("breadcrumb",array("Accueil"),true,1,function($e){if($e->getContent()!=="Scan") return $e->getContent();});
		$bc->fromDispatcher($this->dispatcher);
		$bc->addGlyph("glyphicon-home",0);
		$bc->jsSetContent($this->jquery);
		$bc->autoGetOnClick("#content");
		if($this->request->isAjax()){
			$this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
		}
	}
}
