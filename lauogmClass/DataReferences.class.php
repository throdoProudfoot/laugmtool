<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/**
 * Description of DataReferences
 *
 * @author throdo
 */
class DataReferences {
	private $tableReferences;
	
	/**
	 *
	 * @return the $tableReferences
	 */
	public function getTableReferences() {
		return $this->tableReferences;
	}
	
	/**
	 *
	 * @param DataReferencesDAO $tableReferences        	
	 */
	public function setTableReferences($tableReferences) {
		$this->tableReferences = $tableReferences;
	}
	function __construct() {
		try {
			$drd = new DataReferencesDAO ( 'tables' );
		} catch ( LauDataFileNotFoundException $e ) {
			throw $e;
		}
		
		try {
			$this->tableReferences = $drd->getDataReferenceContents ();
		} catch ( LauDataFileParsingException $e ) {
			throw $e;
		}
	}
	
	/**
	 *
	 * @return multitype:NULL unknown
	 */
	public function getTableList() {
		foreach ( $this->tableReferences as $key => $value ) {
			$infoTables [$key] = array (
					'libelle' => $value ['libelle'],
					'toolTip' => $value ['description'] ['courte'] 
			);
		}
		
		return $infoTables;
	}
	
	/**
	 *
	 * @param unknown_type $index        	
	 * @return unknown
	 */
	private function getStructure($index) {
		$tr = $this->getTableReferences ();
		
		if (array_key_exists ( 'structure', $tr [$index] )) {
			$retArray = $tr [$index] ['structure'];
		} else {
			throw new LauDataFileStructureNotFoundException ( $tr [$index] );
		}
		
		return $retArray;
	}
	
	/**
	 *
	 * @param unknown_type $post        	
	 * @throws Exception
	 * @return Ambigous <the, DataReferencesDAO, multitype:>
	 */
	public function processFormResult($post) {
		$retArray = array ();
		foreach ( $this->getTableReferences () as $key => $value ) {
			if (isset ( $post [$key] )) {
				try {
					$dataRef = strtolower ( $value ['libelle'] );
					$drd = new DataReferencesDAO ( $dataRef );
				} catch ( Exception $e ) {
					throw $e;
				}
				
				try {
					$drd->setDataReferenceContents ( $this->getStructure ( $key ) );
					array_push ( $retArray, $dataRef );
				} catch ( Exception $e ) {
					throw $e;
				}
				
				
			}
		}
		return $retArray;
	}
}

?>
