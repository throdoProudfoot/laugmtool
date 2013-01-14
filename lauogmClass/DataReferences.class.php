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
	
	/**
	 * @var array : les données de réference
	 */
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
	 * @param string $key
	 * 		La clé recherchée
	 * @param array $array
	 * 		Le tableau dans lequel on recherche la clé
	 * @param string $nameArray
	 * 		Le nom du tableau affiché si il y a une exception 
	 * @throws LauKeyInArrayNotFoundException
	 * 		L'exception qui est levée si la clé n'est pas trouvée dans le tableau
	 * @return 
	 * 		la valeur du tableau si la clé existe sinon throw l'exception LauKeyInArrayNotFoundException
	 */	
	public function certifyKeyInArray($key, $array, $nameArray) {
		if (array_key_exists ( $key, $array )) {
			return $array[$key];
		} else {
			throw new LauKeyInArrayNotFoundException($key, $nameArray);
		}
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
