<?php

class MyDisquesController extends \ControllerBase {
	/**
	 * Affiches les disques de l'utilisateur
	 */
	public function indexAction(){
		//TODO 4.2


		$user = Auth::getUser($this);
		$idUser = Utilisateur::findFirst($user)->getId();
		$disques = Disque::find("idUtilisateur = ".$idUser);

		$occupationDisques = array();
		$quotaDisques = array();
		$uniteDisques = array();
		$progressBars = array();

		$cloud = $this->config->cloud;
		$bootstrap = $this->jquery->bootstrap();

		foreach($disques as $disque){
			//Occupation des Disques
			$idTarif = DisqueTarif::findFirst($disque->getId())->getIdTarif();
			$occupationEnOctet = ModelUtils::getDisqueOccupation($cloud,$disque);
			$uniteOccupation = ModelUtils::sizeConverter(Tarif::findFirst($idTarif)->getUnite());
			$occupation = round($occupationEnOctet/$uniteOccupation, 2);
			array_push($occupationDisques,$occupation);

			//Quota des Disques
			$quota = Tarif::findFirst($idTarif)->getQuota();
			array_push($quotaDisques,$quota);

			//Unite des Disques
			$unite = Tarif::findFirst($idTarif)->getUnite();
			array_push($uniteDisques,$unite);

			//% d'occupation des Disques
			$pourcentage = round($occupation/$quota*100,2);

			//Creation des ProgressBars
			$class =  array("info"=>10, "sucess"=>50,"warning"=>80, "danger"=>100);
			$progress = $bootstrap->HtmlProgressbar($disque->getId())
				->setStyleLimits($class)
				->setValue($pourcentage)
				->setMin(0)
				->setStriped(true)
				->showCaption(true)
				->setMax($quota);


			array_push($progressBars,$progress);

		}








		$this->view->setVars(array(
				"disques" => $disques,
				"occupationDisques" => $occupationDisques,
				"quotaDisques" => $quotaDisques,
				"uniteDisques" => $uniteDisques,
				"progressBars" => $progressBars

			)
		);



		$jquery=$this->jquery;
		//$jquery->click("#btn",$jquery->hide(".panel",2000));
		$jquery->compile($this->view);


	}
}