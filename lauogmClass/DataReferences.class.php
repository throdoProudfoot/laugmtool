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
	 *
	 * @var array : les données de réference
	 */
	private $content;
	
	/**
	 *
	 * @var DataReferencesDAO
	 */
	private $drd;
	
	/**
	 *
	 * @return the $content
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 *
	 * @param field_type $content        	
	 */
	public function setContent($content) {
		$this->content = $content;
	}
	
	/**
	 *
	 * @param string $type        	
	 * @throws LauDataFileNotFoundException
	 * @throws LauDataFileParsingException
	 */
	function __construct($type) {
		try {
			$this->drd = new DataReferencesDAO ( $type );
		} catch ( LauDataFileNotFoundException $e ) {
			throw $e;
		}
		try {
			$this->content = $this->drd->getDataReferenceContent ();
		} catch ( Exception $e ) {
			throw $e;
		}
	}
	
	/**
	 *
	 * @param string $key
	 *        	La clé recherchée
	 * @param array $array
	 *        	Le tableau dans lequel on recherche la clé
	 * @param string $nameArray
	 *        	Le nom du tableau affiché si il y a une exception
	 * @throws LauKeyInArrayNotFoundException L'exception qui est levée si la
	 *         clé n'est pas trouvée dans le tableau
	 * @return la valeur du tableau si la clé existe sinon throw l'exception
	 *         LauKeyInArrayNotFoundException
	 */
	public function certifyKeyInArray($key, $array, $nameArray) {
		if (array_key_exists ( $key, $array )) {
			return $array [$key];
		} else {
			throw new LauKeyInArrayNotFoundException ( $key, $nameArray );
		}
	}
	
	/**
	 */
	public function storeDataRef($pNomTable, $pStructure) {
		$this->drd->storeDataReferenceContents($pNomTable, $pStructure,$this->getContent());
	}
}

?>
