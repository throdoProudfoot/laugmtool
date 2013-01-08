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
	private $content;

	/**
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param field_type $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @param string $type
	 * @throws LauDataFileNotFoundException
	 * @throws LauDataFileParsingException
	 */
	function __construct($type) {
		try {
			$drd = new DataReferencesDAO ( $type );
		} catch ( LauDataFileNotFoundException $e ) {
			throw $e;
		}
		
		try {
			$this->content = $drd->getDataReferenceContent();
		} catch ( LauDataFileParsingException $e ) {
			throw $e;
		} catch (LauDataFileStructureException $e) {
			throw $e;
		}
		
	}
	
	/**
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
	 * @param array $post        	
	 * @throws Exception
	 * @return array $retArray
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
					$drd->setDataReferenceContents ( $value ['nom'], $this->getStructure ( $key ) );
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
