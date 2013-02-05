<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/*
 * TODO Trouver comment sortir la variable globale $wpdb pour pouvoir réaliser des Tests.
 */

/**
 * Description of Peuples
 *
 * @author throdo
 */
class Peuples {
	
	private $pd;
	private $content;
	
	/**
	 * @return the $pd
	 */
	public function getPd() {
		return $this->pd;
	}

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param PeuplesDAO $pd
	 */
	public function setPd($pd) {
		$this->pd = $pd;
	}

	/**
	 * @param Peuple $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 */
	function __construct() {
		$this->pd = new PeuplesDAO();
		foreach ($this->pd->getData() as $key => $value) {
			if (gettype($value) == 'object') {
				$this->content[$value->idPeuple] = new Peuple($value->idPeuple, $value->nomPeuple, $value->indexPeuple, $value->descriptionCourtePeuple, $value->introductionPeuple, $value->descriptionLonguePeuple, $value->niveauDeViePeuple, $value->avantageCulturelPeuple);
			} else {
				echo "Erreur";
			}
		}
	}
	
	/**
	 * @return NULL
	 */
	public function getPeupleList() {
		$retArray = array();
		foreach ($this->getContent() as $key => $value) {
			//$retArray[$key] = $value->getNomPeuple();
			$retArray[$key] = $value->getPeupleToArray();
		}
		return ($retArray);
	}

	/**
	 * @return NULL
	 */
	public function getPeupleNom($pId) {
		$retArray =$this->getContent();
		return ($retArray[$pId]->getNomPeuple());
	}
	
}

?>
