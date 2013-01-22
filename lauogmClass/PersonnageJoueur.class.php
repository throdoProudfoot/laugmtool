<?php

/**
 *
 * @author throdo
 *        
 */
class PersonnageJoueur {
	private $idPeuple;
	private $nomPeuple;
	
	/**
	 * @return the $nomPeuple
	 */
	public function getNomPeuple() {
		return $this->nomPeuple;
	}

	/**
	 * @param field_type $nomPeuple
	 */
	public function setNomPeuple($nomPeuple) {
		$this->nomPeuple = $nomPeuple;
	}

	/**
	 *
	 * @return the $idPeuple
	 */
	public function getIdPeuple() {
		return $this->idPeuple;
	}	

	/**
	 *
	 * @param field_type $idPeuple        	
	 */
	public function setIdPeuple($idPeuple) {
		$this->idPeuple = $idPeuple;
	}
	

	/**
	 */
	function __construct($pIdPeuple) {
		$this->idPeuple = $pIdPeuple;
	}
}

?>