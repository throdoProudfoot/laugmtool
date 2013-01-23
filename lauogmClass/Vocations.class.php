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
class Vocations {
	
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
		$this->pd = new VocationsDAO();
		foreach ($this->pd->getData() as $key => $value) {
			if (gettype($value) == 'object') {
				$this->content[$value->idVocation] = new Vocation($value->idVocation, $value->nomVocation, $value->descriptionVocation);
			} else {
				echo "Erreur";
			}
		}		
	}
	
	/**
	 * @return NULL
	 */
	public function getVocationList() {
		$retArray = array();
		foreach ($this->getContent() as $key => $value) {
			$retArray[$key] = $value->getNomVocation();
		}
		return ($retArray);
	}

	/**
	 * @return NULL
	 */
	public function getVocationNom($pId) {
		$retArray =$this->getContent();
		return ($retArray[$pId]->getNomVocation());
	}
	
}

?>
