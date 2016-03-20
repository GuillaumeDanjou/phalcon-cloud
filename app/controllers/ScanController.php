<?php

class ScanController extends ControllerBase {

	/**
	 * Affiche les informations relatives à l'id du disque passé en paramétre
	 * @param int $idDisque id du disque à afficher
	 */
	public function indexAction($idDisque) {
		//TODO 4.3
		$diskName = Disque::findFirst($idDisque)->getNom();
		$proprietaire = Auth::getUser($this);
		$cloud = $this->config->cloud;
		$disque = Disque::findFirst($idDisque);
		$idTarif = DisqueTarif::findFirst($disque->getId())->getIdTarif();
		$occupationEnOctet = ModelUtils::getDisqueOccupation($cloud,$disque);
		$uniteOccupation = ModelUtils::sizeConverter(Tarif::findFirst($idTarif)->getUnite());
		$occupation = round($occupationEnOctet/$uniteOccupation, 2);
		$quota = Tarif::findFirst($idTarif)->getQuota();
		$unite = Tarif::findFirst($idTarif)->getUnite();
		$pourcentage = round($occupation/$quota*100,2);

		$occupation = $occupation.' '.$unite.' ('.$pourcentage.' %) sur '.$quota.' '.$unite;
		$tarification = ModelUtils::getDisqueTarif($disque);
		$services = array();
		$idservices = DisqueService::find(array("idDisque = ".$idDisque));
		foreach($idservices as $idservice){
			array_push($services,Service::findFirst($idservice->getIdService())->getNom());
		}
		$listeTarification = Tarif::find();
		$this->view->setVars(array(
			"nomDisque" => $diskName,
			"proprietaire" => $proprietaire,
			"occupation" =>$occupation,
			"tarification" =>$tarification,
			"services" => $services,
			"listeTarification" => $listeTarification
		));

		$this->jquery->click("#modifier",'
			$("#nomDisque").toggle();
			$("#inputNom").toggle();
			$(this).toggle();
			$("#modifier2").toggle();
		');

		$this->jquery->click("#modifier2",'
			$("#nomDisque").toggle();
			$("#inputNom").toggle();
			$(this).toggle();
			$("#modifier").toggle();
			var nom = $("#inputNom").val();
			$.post( "../modifier/'.$idDisque.'",({nom:nom}), function( data ) {
				$( "#nomDisque" ).empty();
  				$( "#nomDisque" ).html( data );
			});
		');

		$this->jquery->click("#modifiertarif",'
			$("#nomTarif").toggle();
			$("#listeTarif").toggle();
			$(this).toggle();
			$("#modifiertarif2").toggle();
		');

		$this->jquery->click("#modifiertarif2",'
			$("#nomTarif").toggle();
			$("#listeTarif").toggle();
			$(this).toggle();
			$("#modifiertarif").toggle();
			var tarif = $("#listeTarif").val();
			$.post( "../modifierTarif/'.$idDisque.'",({tarif:tarif}), function( data ) {
				$( "#nomTarif" ).empty();
  				$( "#nomTarif" ).html( data );
			});
		');


		$this->jquery->execOn("click", "#ckSelectAll", "$('.toDelete').prop('checked', $(this).prop('checked'));$('#btDelete').toggle($('.toDelete:checked').length>0)");
		$this->jquery->execOn("click","#btUpload","$('#tabsMenu a:last').tab('show');");
		$this->jquery->doJQueryOn("click","#btDelete", "#panelConfirmDelete", "show");
		$this->jquery->postOn("click", "#btConfirmDelete", "scan/delete","$('.toDelete:checked').serialize()","#ajaxResponse");
		$this->jquery->doJQueryOn("click", "#btFrmCreateFolder", "#panelCreateFolder", "toggle");
		$this->jquery->postFormOn("click", "#btCreateFolder", "Scan/createFolder", "frmCreateFolder","#ajaxResponse");
		$this->jquery->exec("window.location.hash='';scan('".$diskName."')",true);
		$b=$this->jquery->bootstrap()->htmlModal("boite2");
		$b->renderContent($this->view,"aController","anAction");
		$b->addOkayButton();

		$this->jquery->compile($this->view);
	}

	/**
	 * Etablit le listing au format JSON du contenu d'un disque
	 * @param string $dir Disque dont le contenu est à lister
	 */

	public function modifierAction($id){
		echo"<h4>". $_POST['nom']."</h4>";
		Disque::findFirst($id)->setNom($_POST['nom'])->save();
	}

	public function modifierTarifAction($id){

		DisqueTarif::findFirst(array("idDisque" => $id))->setIdTarif($_POST['tarif'])->save();
		echo"<h4>". ModelUtils::getDisqueTarif(Disque::findFirst($id))."</h4>".$id.$_POST['tarif'];
		}

	public function filesAction($dir="Datas"){
		$this->view->disable();
		$cloud=$this->config->cloud;
		$root=$cloud->root.$cloud->prefix.$this->session->get("activeUser")->getLogin()."/";
		$response = DirectoryUtils::scan($root.$dir,$root);
		header('Content-type: application/json');
		echo json_encode(array(
				"name" => $dir,
				"type" => "folder",
				"path" => $dir,
				"items" => $response,
				"root" => $root
		));
	}




	/**
	 * Action d'upload d'un fichier
	 */
	public function uploadAction(){
		$this->view->disable();
		header('Content-Type: application/json');
		$allowed = array('png', 'jpg', 'gif','zip');
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $_POST["activeFolder"].'/'.$_FILES['upl']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
	}

	/**
	 * Action de suppresion d'un fichier
	 */
	public function deleteAction(){
		$message=array();
		if(array_key_exists("toDelete", $_POST)){
			foreach ($_POST["toDelete"] as $f){
				if(DirectoryUtils::deleteFile($f)===false){
					$message[]="Impossible de supprimer `{$f}`";
				}
			}
			if(sizeof($message)==0){
				$this->jquery->exec("scan()",true);
			}else{
				echo $this->showMessage(implode("<br>", $message), "warning");
			}
			$this->jquery->doJquery("#panelConfirmDelete", "hide");
			echo $this->jquery->compile();
		}
	}

	public function createFolderAction(){
		if(array_key_exists("folderName", $_POST)){
			$pathname=$_POST["activeFolder"].DIRECTORY_SEPARATOR.$_POST["folderName"];
			if(DirectoryUtils::mkdir($pathname)===false){
				echo $this->showMessage("Impossible de créer le dossier `".$pathname."`", "warning");
			}else{
				$this->jquery->exec("scan()",true);
			}
			$this->jquery->doJquery("#panelCreateFolder", "hide");
			echo $this->jquery->compile();
		}
	}

	/**
	 * Action permettant de mettre à jour l'historique du jour de tous les diques
	 */
	public function updateAllDaySizeAction(){
		$cloud=$this->config->cloud;
		DirectoryUtils::updateAllDaySize($cloud);
	}

	/**
	 * Affiche un message dans une alert Bootstrap
	 * @param String $message
	 * @param String $type Class css du message (info, warning...)
	 * @param number $timerInterval Temps d'affichage en ms
	 * @param string $dismissable Alert refermable
	 * @param string $visible
	 */
	public function showMessage($message,$type,$timerInterval=5000,$dismissable=true,$visible=true){
		$message=new DisplayedMessage($message,$type,$timerInterval,$dismissable,$visible);
		return $message->compile($this->jquery);
	}
}