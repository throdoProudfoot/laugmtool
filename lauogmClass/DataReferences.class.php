<?php

use LauDataFileNotFoundException;
use LauDataFileParsingException;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataReferences
 *
 * @author throdo
 */
class DataReferences {

	private $tableReferences;
	
    /**
	 * @return the $tableReferences
	 */
	public function getTableReferences() {
		return $this->tableReferences;
	}

	/**
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
    		$this->tableReferences = $drd->getDataReferenceContents();
    	} catch ( LauDataFileParsingException $e ) {
    		throw $e;
    	}
    	    	 
    }

    public function getTableList () {
echo '1';
    	foreach ($this->tableReferences as $key => $value) {
    		$infoTables[$key]=array(
    				'libelle' => $value['libelle'],
    				'toolTip' => $value['description']['courte'],    				
    				);
    	}
    	
    	return $infoTables;
    }
}

?>
