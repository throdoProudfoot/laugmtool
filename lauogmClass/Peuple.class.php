<?php

/**
 *
 * @author throdo
 *        
 */
class Peuple {
	private $idPeuple;
	private $nomPeuple;
	private $descriptionCourtePeuple;
	private $introductionPeuple;
	private $descriptionLonguePeuple;
	private $niveauDeViePeuple;
	private $avantageCulturelPeuple;
	
	/**
	 *
	 * @return the $idPeuple
	 */
	public function getIdPeuple() {
		return $this->idPeuple;
	}
	
	/**
	 *
	 * @return the $nomPeuple
	 */
	public function getNomPeuple() {
		return $this->nomPeuple;
	}
	
	/**
	 *
	 * @return the $descriptionCourtePeuple
	 */
	public function getDescriptionCourtePeuple() {
		return $this->descriptionCourtePeuple;
	}
	
	/**
	 *
	 * @return the $introductionPeuple
	 */
	public function getIntroductionPeuple() {
		return $this->introductionPeuple;
	}
	
	/**
	 *
	 * @return the $descriptionLonguePeuple
	 */
	public function getDescriptionLonguePeuple() {
		return $this->descriptionLonguePeuple;
	}
	
	/**
	 *
	 * @return the $niveauDeViePeuple
	 */
	public function getNiveauDeViePeuple() {
		return $this->niveauDeViePeuple;
	}
	
	/**
	 *
	 * @return the $avantageCulturelPeuple
	 */
	public function getAvantageCulturelPeuple() {
		return $this->avantageCulturelPeuple;
	}
	
	/**
	 *
	 * @param field_type $idPeuple        	
	 */
	public function setIdPeuple($idPeuple) {
		$this->idPeuple = $idPeuple;
	}
	
	/**
	 *
	 * @param field_type $nomPeuple        	
	 */
	public function setNomPeuple($nomPeuple) {
		$this->nomPeuple = $nomPeuple;
	}
	
	/**
	 *
	 * @param field_type $descriptionCourtePeuple        	
	 */
	public function setDescriptionCourtePeuple($descriptionCourtePeuple) {
		$this->descriptionCourtePeuple = $descriptionCourtePeuple;
	}
	
	/**
	 *
	 * @param field_type $introductionPeuple        	
	 */
	public function setIntroductionPeuple($introductionPeuple) {
		$this->introductionPeuple = $introductionPeuple;
	}
	
	/**
	 *
	 * @param field_type $descriptionLonguePeuple        	
	 */
	public function setDescriptionLonguePeuple($descriptionLonguePeuple) {
		$this->descriptionLonguePeuple = $descriptionLonguePeuple;
	}
	
	/**
	 *
	 * @param field_type $niveauDeViePeuple        	
	 */
	public function setNiveauDeViePeuple($niveauDeViePeuple) {
		$this->niveauDeViePeuple = $niveauDeViePeuple;
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
	function __construct($pIdPeuple, $pNomPeuple, $pDescriptionCourtePeuple, $pIntroductionPeuple, $pDescriptionLonguePeuple, $pNiveauDeViePeuple, $pAvantageCulturelPeuple) {
		$this->idPeuple = $pIdPeuple;
		$this->nomPeuple = $pNomPeuple;
		$this->descriptionCourtePeuple = $pDescriptionCourtePeuple;
		$this->introductionPeuple = $pIntroductionPeuple;
		$this->descriptionLonguePeuple = $pDescriptionLonguePeuple;		
		$this->niveauDeViePeuple = $pNiveauDeViePeuple;
		$this->avantageCulturelPeuple = $pAvantageCulturelPeuple;		
	}
}

?>