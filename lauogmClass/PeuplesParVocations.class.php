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
		$this->pd = new PeuplesParVocationsDAO();
		foreach ($this->pd->getData() as $key => $value) {
			if (gettype($value) == 'object') {
				$this->content[$value->idPeuple] = new Vocation($value->idPeuple, $value->idVocation, $value->priorite);
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
		return ($retArray);
	}
	
}

?>
