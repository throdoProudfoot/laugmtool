<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/*
 * TODO Trouver comment sortir la variable globale $wpdb pour pouvoir réaliser des Tests.
 */

/**
 * Description of VocationsParPeuple
 *
 * @author throdo
 */
class VocationParPeuple {

	private $idPeuple;
	private $idVocation;
	private $nomPeuple;
	private $nomVocation;
	private $priorite;
	
	/**
	 */
	function __construct($pIdPeuple, $pIdVocation, $pNomPeuple, $pNomVocation, $pPriorite) {
		$this->idPeuple=$pIdPeuple;
		$this->idVocation=$pIdVocation;
		$this->nomPeuple=$pNomPeuple;
		$this->nomVocation=$pNomVocation;
		$this->priorite=$pPriorite;		
	}
	/**
	 * @return the $idPeuple
	 */
	public function getIdPeuple() {
		return $this->idPeuple;
	}

	/**
	 * @return the $idVocation
	 */
	public function getIdVocation() {
		return $this->idVocation;
	}

	/**
	 * @return the $nomPeuple
	 */
	public function getNomPeuple() {
		return $this->nomPeuple;
	}

	/**
	 * @return the $nomVocation
	 */
	public function getNomVocation() {
		return $this->nomVocation;
	}

	/**
	 * @return the $priorite
	 */
	public function getPriorite() {
		return $this->priorite;
	}

	/**
	 * @param field_type $idPeuple
	 */
	public function setIdPeuple($idPeuple) {
		$this->idPeuple = $idPeuple;
	}

	/**
	 * @param field_type $idVocation
	 */
	public function setIdVocation($idVocation) {
		$this->idVocation = $idVocation;
	}

	/**
	 * @param field_type $nomPeuple
	 */
	public function setNomPeuple($nomPeuple) {
		$this->nomPeuple = $nomPeuple;
	}

	/**
	 * @param field_type $nomVocation
	 */
	public function setNomVocation($nomVocation) {
		$this->nomVocation = $nomVocation;
	}

	/**
	 * @param field_type $priorite
	 */
	public function setPriorite($priorite) {
		$this->priorite = $priorite;
	}

	
}

?>
