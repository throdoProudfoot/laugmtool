<?php

/**
 *
 * Classe qui permet d'instancier un Objet représentant la liste des Tables de référence.
 *
 * @author throdo
 *        
 */
class TableDataReferences extends DataReferences {
	
	/**
	 */
	function __construct() {
		parent::__construct ( 'tables' );
	}
	
	/**
	 *
	 * @param unknown_type $index        	
	 * @return unknown
	 */
	public function getStructure($index) {
		$tr = $this->getContent ();
		if (array_key_exists ( 'structure', $tr [$index] )) {
			$retArray = $tr [$index] ['structure'];
		} else {
			throw new LauDataFileStructureNotFoundException ( $tr [$index] );
		}
		
		return $retArray;
	}
	
	/**
	 *
	 * @return multitype:NULL unknown
	 */
	public function getTableList() {
		$returnArray = array ();
		$arrayName = 'Liste des Tables';
		foreach ( $this->getContent () as $key => $value ) {
			
			$descriptionArray = $this->certifyKeyInArray ( 'description', $value, $arrayName );
			
			$returnArray [$key] = array (
					'libelle' => $this->certifyKeyInArray ( 'libelle', $value, $arrayName ),
					'toolTip' => $this->certifyKeyInArray ( 'courte', $descriptionArray, $arrayName ) 
			);
		}
		
		return $returnArray;
	}
}

?>