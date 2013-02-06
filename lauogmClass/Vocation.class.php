<?php

/**
 *
 * @author throdo
 *        
 */
class Vocation {
	private $idVocation;
	private $nomVocation;
	private $indexVocation;
	private $descriptionCourteVocation;
	private $descriptionLongueVocation;
	
	
	/**
	 * @return the $idVocation
	 */
	public function getIdVocation() {
		return $this->idVocation;
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
	 * @param field_type $idVocation
	 */
	public function setIdVocation($idVocation) {
		$this->idVocation = $idVocation;
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
	 */
	function __construct($pIdVocation,$pNomVocation,$pIndexVocation,$pDescriptionCourteVocation,$pDescriptionLongueVocation) {
		$this->idVocation = $pIdVocation;
		$this->nomVocation = $pNomVocation;
		$this->indexVocation = $pIndexVocation;
		$this->descriptionCourteVocation = $pDescriptionCourteVocation;
		$this->descriptionLongueVocation = $pDescriptionLongueVocation;
	}
	
	public function getVocationToArray() {
		$vocationArray = array ();

		$vocationArray ['IdVocation'] = $this->idVocation;
		$vocationArray ['NomVocation'] = $this->nomVocation;
		$vocationArray ['IndexVocation'] = $this->indexVocation;
		$vocationArray ['DescriptionCourteVocation'] = $this->descriptionCourteVocation;
		$vocationArray ['DescriptionLongueVocation'] = $this->descriptionLongueVocation;
	
		return $vocationArray;
	}	
}

?>