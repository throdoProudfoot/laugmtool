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
			$returnArray[$value['nom']]=$value;
		}
		return ($returnArray);
	}
	
	/**
	 */
	public function setDataReferenceContents($structure) {
		//$this->storeData ($structure);
		return 0; 
	}
	
	/**
	 * 
	 */
	private function storeData($structure) {
		global $wpdb;
		
		// require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
		$table_name = $wpdb->prefix . $this->arrayValue ["nom"];
		
		$dynDropTable = "DROP TABLE IF EXISTS `" . $table_name . "`;";
		
		$e = $wpdb->query ( $dynDropTable );
		
		$dynCreateTable = "CREATE TABLE " . $table_name . " (";
		$dynCreateTable .= 'id MEDIUMINT NOT NULL AUTO_INCREMENT,';
		
		foreach ( $name ["structure"] as $key => $value ) {
			$dynCreateTable .= ' ' . $key;
			foreach ( $value->attributes () as $k => $v ) {
				if ($k == 'type') {
					$dynCreateTable .= ' ' . strtoupper ( $v );
				}
				if ($k == 'nullable') {
					if ($v == 'Yes') {
						$dynCreateTable .= ' NULL,';
					} else {
						$dynCreateTable .= ' NOT NULL,';
					}
				}
			}
		}
		
		$dynCreateTable .= ' PRIMARY KEY  (id));';
		$e = $wpdb->query ( $dynCreateTable );
	}
}

?>
