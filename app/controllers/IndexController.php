<?php

class IndexController extends ControllerBase
{

    public function indexAction(){
    	$bootstrap=$this->jquery->bootstrap();
    	$bt=$bootstrap->htmlButton("btMyDisques","Mes Disques","primary");
    	$bt->setProperty("data-ajax", "MyDisques")->addLabel("//TODO 4.2","info");

    	$bt=$bootstrap->htmlButton("btScanOne","Disque Datas (id=1)","info");
    	$bt->setProperty("data-ajax", "Scan/index/1")->addLabel("//TODO 4.3","primary");

    	$bt=$bootstrap->htmlButton("btCreateOne","Créer un disque","success");
    	$bt->setProperty("data-ajax", "Disques/create")->addLabel("//TODO 4.4.1","primary");

    	$this->jquery->getOnClick("a.btn, button.btn","","#content",array("attr"=>"data-ajax"));
    	$this->jquery->compile($this->view);
		$tarif  = ModelUtils::getDisqueTarif(1);
		$this->view->setVar(
			"tarif",
			$tarif
		);
    }
}

