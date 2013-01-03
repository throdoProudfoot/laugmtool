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
class DataReferencesDAO {
	
	// Fichier initial, contenant les données
	private $file;
	private $root;
	
	/**
	 * Contructeur de la classe.
	 *
	 * @param unknown_type $dataFileType
	 *        	nom du fichier à prendre en compte
	 * @param unknown_type $absolute
	 *        	si true alors chemin du fichier en absolue
	 *        	sinon juste le type de fichier à prendre
	 * @throws LauDataFileNotFoundException Si le fichier est introuvable
	 */
	function __construct($dataFileType, $absolute = false, $root = null) {
		if (! $absolute) {
			$filename = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $dataFileType . 'References.xml';
			$this->root = $dataFileType;
		} else {
			$filename = $dataFileType;
			$this->root = $root;
		}
		if (file_exists ( $filename )) {
			$this->file = $filename;
		} else {
			throw new LauDataFileNotFoundException ( $filename );
		}
	}
	
	/**
	 *
	 * @return the $file
	 */
	public function getFile() {
		return $this->file;
	}
	
	/**
	 *
	 * @param string $file        	
	 */
	public function setFile($file) {
		$this->file = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $file . 'References.xml';
		;
	}
	
	/**
	 *
	 * @return array
	 */
	public function getDataReferenceContents() {
		$dom = new DOMDocument ();
		try {
			$returnValue = $dom->load ( $this->getFile () );
		} catch ( Exception $e ) {
			throw new LauDataFileParsingException ( $this->getFile () );
		}
		$retArray = XML2Array::createArray ( $dom );
		$childNode = $retArray [$this->root] ['@attributes'] ['childNode'];
		foreach ( $retArray [$this->root] [$childNode] as $key => $value ) {
			$returnArray [$value ['nom']] = $value;
		}
		return ($returnArray);
	}
	
	/**
	 */
	public function setDataReferenceContents($nomTable, $structure) {
		$this->createTable ( $nomTable, $structure );
		$this->storeData ( $nomTable, $structure, $this->getDataReferenceContents () );
		return 0;
	}
	
	/**
	 *
	 * @param unknown_type $nomTable        	
	 * @param unknown_type $structure        	
	 * @param unknown_type $data        	
	 */
	private function createTable($nomTable, $structure) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $nomTable;
		
		$dynDropTable = "DROP TABLE IF EXISTS `" . $table_name . "`;";
		
		$e = $wpdb->query ( $dynDropTable );
		// echo '$dynDropTable = ' . $dynDropTable . '<hr>';
		
		$dynCreateTable = "CREATE TABLE " . $table_name . " (";
		
		foreach ( $structure [colonne] as $key => $value ) {
			$dynCreateTable .= ' ' . $value ['nom'];
			switch ($value ['type']) {
				case 'indexAuto' :
					$tableIndex = $value ['nom'];
					$dynCreateTable .= " MEDIUMINT NOT NULL AUTO_INCREMENT,";
					break;
				default :
					$dynCreateTable .= " " . $value ['type'] . " " . strtoupper ( $value ['null'] ) . ",";
					break;
			}
			// foreach ( $value->attributes () as $k => $v ) {
			// if ($k == 'type') {
			// $dynCreateTable .= ' ' . strtoupper ( $v );
			// }
			// if ($k == 'nullable') {
			// if ($v == 'Yes') {
			// $dynCreateTable .= ' NULL,';
			// } else {
			// $dynCreateTable .= ' NOT NULL,';
			// }
			// }
			// }
		}
		
		$dynCreateTable .= ' PRIMARY KEY  (' . $tableIndex . '));';
		$e = $wpdb->query ( $dynCreateTable );
	}
	
	/**
	 *
	 * @param unknown_type $nomTable        	
	 * @param unknown_type $structure        	
	 * @param unknown_type $data        	
	 * @return number
	 */
	private function storeData($nomTable, $structure, $data) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $nomTable;
		
		$ajouteVirgule = false;
		foreach ( $structure [colonne] as $key => $value ) {
			if ($ajouteVirgule) {
				$dynListColonne .= ',';
			}
			if ($value ['type'] != "indexAuto") {
				$dynListColonne .= '`' . $value ['nom'] . '`';
				$ajouteVirgule = true;
			}
		}
		
		foreach ( $data as $key => $value ) {
			$dynInsertTable = "INSERT INTO " . $table_name . " (" . $dynListColonne . ") VALUES(";
			$ajouteVirgule = false;
			
			foreach ( $value as $k => $v ) {
				if ($ajouteVirgule) {
					$dynInsertTable .= ',';
				}
				$dynInsertTable .= '"' . $v . '"';
				$ajouteVirgule = true;
			}
			$dynInsertTable .= ');';
			$e = $wpdb->query ( $dynInsertTable );
		}
	}
}

?>
