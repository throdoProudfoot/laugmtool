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
	private $indexVocation;
	private $descriptionCourteVocation;
	private $descriptionLongueVocation;
	private $priorite;
	
	/**
	 */
	function __construct($pIdPeuple, $pIdVocation, $pNomPeuple, $pNomVocation, $pIndexVocation, $pDescriptionCourteVocation, $pDescriptionLongueVocation, $pPriorite) {
		$this->idPeuple=$pIdPeuple;
		$this->idVocation=$pIdVocation;
		$this->nomPeuple=$pNomPeuple;
		$this->nomVocation=$pNomVocation;
		$this->indexVocation=$pIndexVocation;
		$this->descriptionCourteVocation=$pDescriptionCourteVocation;
		$this->descriptionLongueVocation=$pDescriptionLongueVocation;		
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
	 * @return the $indexVocation
	 */
	public function getIndexVocation() {
		return $this->indexVocation;
	}

	/**
	 * @return the $descriptionCourteVocation
	 */
	public function getDescriptionCourteVocation() {
		return $this->descriptionCourteVocation;
	}

	/**
	 * @return the $descriptionLongueVocation
	 */
	public function getDescriptionLongueVocation() {
		return $this->descriptionLongueVocation;
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
	 * @param field_type $indexVocation
	 */
	public function setIndexVocation($indexVocation) {
		$this->indexVocation = $indexVocation;
	}

	/**
	 * @param field_type $descriptionCourteVocation
	 */
	public function setDescriptionCourteVocation($descriptionCourteVocation) {
		$this->descriptionCourteVocation = $descriptionCourteVocation;
	}

	/**
	 * @param field_type $descriptionLongueVocation
	 */
	public function setDescriptionLongueVocation($descriptionLongueVocation) {
		$this->descriptionLongueVocation = $descriptionLongueVocation;
	}

	/**
	 * @param field_type $priorite
	 */
	public function setPriorite($priorite) {
		$this->priorite = $priorite;
	}


	public function getVocationToArray() {
		$vocationArray = array ();
	
		$vocationArray ['IdPeuple'] = $this->idPeuple;
		$vocationArray ['IdVocation'] = $this->idVocation;
		$vocationArray ['NomPeuple'] = $this->nomPeuple;
		$vocationArray ['NomVocation'] = $this->nomVocation;
		$vocationArray ['IndexVocation'] = $this->indexVocation;
		$vocationArray ['DescriptionCourteVocation'] = $this->descriptionCourteVocation;
		$vocationArray ['DescriptionLongueVocation'] = $this->descriptionLongueVocation;
		$vocationArray ['Priorite'] = $this->priorite;
	
		return $vocationArray;
	}
		
	
}

?>
