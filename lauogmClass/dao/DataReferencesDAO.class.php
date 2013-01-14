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
	
	/**
	 * @var array : Le contenu du fichier sous forme de tableau
	 */
	private $contentFile;
	
	/**
	 * @var string : le noeud fils contenant le contenu data du fichier
	 */
	private $childNode;
	
	/**
	 * @var string : le noeud racine du fichier
	 */
	private $root;
	
	/**
	 *
	 * @return the $contentFile
	 */
	public function getContentFile() {
		return $this->contentFile;
	}
	
	/**
	 *
	 * @return the $childNode
	 */
	public function getChildNode() {
		return $this->childNode;
	}
	
	/**
	 *
	 * @return the $root
	 */
	public function getRoot() {
		return $this->root;
	}
	
	/**
	 *
	 * @param
	 *        	Ambigous <string, unknown_type> $contentFile
	 */
	public function setContentFile($contentFile) {
		$this->contentFile = $contentFile;
	}
	
	/**
	 *
	 * @param field_type $childNode        	
	 */
	public function setChildNode($childNode) {
		$this->childNode = $childNode;
	}
	
	/**
	 *
	 * @param
	 *        	Ambigous <unknown_type, unknown> $root
	 */
	public function setRoot($root) {
		$this->root = $root;
	}
	
	/**
	 * Contructeur de la classe.
	 *
	 * @param string $dataFileType
	 *        	nom du fichier à prendre en compte
	 * @param boolean $absolute
	 *        	si true alors chemin du fichier en absolue
	 *        	sinon juste le type de fichier à prendre
	 * @param string $root
	 * 			le node root du document XML        
	 * @throws LauDataFileNotFoundException 
	 * 			Si le fichier est introuvable
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
			$this->contentFile = $filename;
		} else {
			throw new LauDataFileNotFoundException ( $filename );
		}
	}
	
	/**
	 * @throws LauDataFileParsingException
	 * @throws LauDataFileStructureException
	 * @return array
	 */
	public function getDataReferenceContent() {
		$dom = new DOMDocument ();
		
		try {
			$returnValue = $dom->load ( $this->getFile () );
		} catch ( Exception $e ) {
			throw new LauDataFileParsingException ( $this->getFile () );
		}
		
		$retArray = XML2Array::createArray ( $dom );
		$step = "Utilisation de XML2Array ok";
		if (gettype ( $retArray ) == 'array') {
			$step = "Recupérer childNode valeur";
			if (array_key_exists ( 'childNode', $retArray [$this->root] ['@attributes'] )) {
				$this->childNode = $retArray [$this->root] ['@attributes'] ['childNode'];
				if (array_key_exists ( $this->childNode, $retArray [$this->root] )) {
					$step = "childNode existe dans structure";
					foreach ( $retArray [$this->root] [$this->childNode] as $key => $value ) {
						if (array_key_exists ( 'nom', $value )) {
							$resultArray [$value ['nom']] = $value;
						} else {
							$resultArray = null;
							break;
						}
					}
				}
			}
		} else {
			throw new LauDataFileStructureException ( $this->getFile () );
		}
		
		if (gettype ( $resultArray ) != 'array') {
			throw new LauDataFileStructureException ( $this->getFile (), $step );
		}
		return $resultArray;
	}
	
	/**
	 * @param unknown_type $nomTable
	 * @param unknown_type $structure
	 * @return number
	 */
	public function storeDataReferenceContents($nomTable, $structure) {
		$this->createTable ( $nomTable, $structure );
		$this->storeData ( $nomTable, $structure, $this->setDataContent () );
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
