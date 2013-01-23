<?php

/**
 *
 * @author throdo
 *        
 */
class Vocation {
	private $idVocation;
	private $nomVocation;
	private $descriptionVocation;
	
	/**
	 *
	 * @return the $idVocation
	 */
	public function getIdVocation() {
		return $this->idVocation;
	}
	
	/**
	 *
	 * @return the $nomVocation
	 */
	public function getNomVocation() {
		return $this->nomVocation;
	}
	
	/**
	 *
	 * @return the $descriptionVocation
	 */
	public function getDescriptionVocation() {
		return $this->descriptionVocation;
	}
	
	/**
	 *
	 * @param field_type $idVocation        	
	 */
	public function setIdVocation($idVocation) {
		$this->idVocation = $idVocation;
	}
	
	/**
	 *
	 * @param field_type $nomVocation        	
	 */
	public function setNomVocation($nomVocation) {
		$this->nomVocation = $nomVocation;
	}
	
	/**
	 *
	 * @param field_type $descriptionVocation        	
	 */
	public function setDescriptionVocation($descriptionVocation) {
		$this->descriptionVocation = $descriptionVocation;
	}
	
	/**
	 *
	 * @param field_type $avantageCulturelPeuple        	
	 */
	public function setAvantageCulturelPeuple($avantageCulturelPeuple) {
		$this->avantageCulturelPeuple = $avantageCulturelPeuple;
	}
	
	/**
	 */
	function __construct($pIdVocation,$pNomVocation,$pDescriptionVocation) {
		$this->idVocation = $pIdVocation;
		$this->nomVocation = $pNomVocation;
		$this->descriptionVocation = $pDescriptionVocation;
	}
}

?>