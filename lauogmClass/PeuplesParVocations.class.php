<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/*
 * TODO Trouver comment sortir la variable globale $wpdb pour pouvoir réaliser des Tests.
 */

/**
 * Description of PeuplesParVocations
 *
 * @author throdo
 */
class PeuplesParVocations {
	
	private $pd;
	private $peuple;
	private $vocations;
	

	/**
	 */
	function __construct($pIdPeuple) {
		$this->pd = new PeuplesParVocationsDAO($pIdPeuple);
		foreach ($this->pd->getData() as $key => $value) {		
			if (gettype($value) == 'object') {
				$this->peuple[$value->idPeuple]=$value->nomPeuple;
				$this->vocations[$value->idVocation] = new VocationParPeuple($value->idPeuple, $value->idVocation, $value->nomPeuple, $value->nomVocation, $value->priorite);
			} else {
				echo "Erreur";
			}
		}
	}
	
	/**
	 * @return NULL
	 */
	public function getPeuplesParVocationsList() {
		$retArray = array();
		echo "Content : <pre>";
		print_r ($this);
		echo "</pre>";
		foreach ($this->vocations as $key => $value) {
			$retArray[$key] = $value->getNomVocation();
		}		
		return ($retArray);
	}
	
}

?>
