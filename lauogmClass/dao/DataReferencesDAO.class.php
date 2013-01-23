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
	 *
	 * @var string : Le nom du fichier qui contient les données
	 */
	private $contentFile;
	
	/**
	 *
	 * @var string : le noeud fils contenant le contenu data du fichier
	 */
	private $childNode;
	
	/**
	 *
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
	 *        	le node root du document XML
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
			$this->contentFile = $filename;
		} else {
			throw new LauDataFileNotFoundException ( $filename );
		}
	}
	
	/**
	 *
	 * @throws LauDataFileParsingException : si le parsing du fichier XML se
	 *         passe mal.
	 * @throws LauDataFileStructureException : si la structure du fichier n'est
	 *         pas valide.
	 * @return array : le contenu du fichier associé à l'objet si tout se passe
	 *         bien.
	 */
	public function getDataReferenceContent() {
		$dom = new DOMDocument ();
		$resultArray = array ();
		try {
			$returnValue = $dom->load ( $this->getContentFile () );
		} catch ( Exception $e ) {
			throw new LauDataFileParsingException ( $this->getContentFile () );
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
						/*
						 * Premier traitement si il y a plus de 1 enr dans le
						 * fichier XML donc on a un tableau Else si il n'y a
						 * qu'un seul enr dans le fichier XML
						 */
						if (gettype ( $value ) == 'array') {
							if (array_key_exists ( 'nom', $value )) {
								$resultArray [$value ['nom']] = $value;
							} else {
								array_push ( $resultArray, $value );
							}
						} else {
							if (array_key_exists ( 'nom', $retArray [$this->root] [$this->childNode] )) {
								$resultArray [$retArray [$this->root] [$this->childNode] ['nom']] = $retArray [$this->root] [$this->childNode];
							} else {
								array_push ( $resultArray, $value );
							}
						}
					}
				}
			}
		} else {
			throw new LauDataFileStructureException ( $this->getContentFile () );
		}
		if (gettype ( $resultArray ) != 'array') {
			throw new LauDataFileStructureException ( $this->getContentFile (), $step );
		}
		return $resultArray;
	}
	
	/**
	 *
	 * @param unknown_type $pNomTable        	
	 * @param unknown_type $pStructure        	
	 * @return number
	 */
	public function storeDataReferenceContents($pNomTable, $pStructure, $pContent) {
		$this->createTable ( $pNomTable, $pStructure );
		if (array_key_exists ( 'tableDeJointure', $pStructure )) {
			$this->storeAssociationData ( $pNomTable, $pStructure, $pContent );
		} else {
			$this->storeData ( $pNomTable, $pStructure, $pContent );
		}
		return 0;
	}
	
	/**
	 *
	 * @param unknown_type $pNomTable        	
	 * @param unknown_type $pStructure        	
	 * @param unknown_type $data        	
	 */
	private function createTable($pNomTable, $pStructure) {
		global $wpdb;
		$tableIndex = "";
		
		$table_name = $wpdb->prefix . $pNomTable;
		
		$dynDropTable = "DROP TABLE IF EXISTS `" . $table_name . "`;";
		$e = $wpdb->query ( $dynDropTable );
		
		$dynCreateTable = "CREATE TABLE " . $table_name . " (";
		
		if (gettype ( $pStructure ['colonne'] [0] ) == 'array') {
			foreach ( $pStructure ['colonne'] as $key => $value ) {
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
				if (array_key_exists ( 'key', $value )) {
					if ($tableIndex != "") {
						$tableIndex .= ",";
					}
					$tableIndex .= $value ['nom'];
				}
			}
		} else {
			$value = $pStructure ['colonne'];
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
		}
		
		$dynCreateTable .= ' PRIMARY KEY  (' . $tableIndex . '));';
		$e = $wpdb->query ( $dynCreateTable );
	}
	
	/**
	 *
	 *
	 * Fonction qui permet de stocker les informations contenu dans le fichier
	 * XML dans la base de données.
	 * Cette fonction doit être utilisée pour des tables normales et non des
	 * tables d'association.
	 *
	 * @param unknown_type $pNomTable        	
	 * @param unknown_type $pStructure        	
	 * @param unknown_type $pData        	
	 * @return number
	 */
	private function storeData($pNomTable, $pStructure, $pData) {
		global $wpdb;
		
		$table_name = $wpdb->prefix . $pNomTable;
		
		$ajouteVirgule = false;
		foreach ( $pStructure ['colonne'] as $key => $value ) {
			if ($ajouteVirgule) {
				$dynListColonne .= ',';
			}
			if ($value ['type'] != "indexAuto") {
				$dynListColonne .= '`' . $value ['nom'] . '`';
				$ajouteVirgule = true;
			}
		}
		
		foreach ( $pData as $key => $value ) {
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
	
	/**
	 *
	 *
	 * Fonction qui permet de stocker les informations contenu dans le fichier
	 * XML dans la base de données.
	 * Cette fonction doit être utilisée pour des tables d'association et non
	 * des tables normales.
	 *
	 * @param unknown_type $pNomTable        	
	 * @param unknown_type $pStructure        	
	 * @param unknown_type $pData        	
	 * @return number
	 */
	private function storeAssociationData($pNomTable, $pStructure, $pData) {
		global $wpdb;
		$table_name = $wpdb->prefix . $pNomTable;
		
		$ajouteVirgule = false;
		foreach ( $pStructure ['colonne'] as $key => $value ) {
			if ($ajouteVirgule) {
				$dynListColonne .= ',';
			}
			if ($value ['type'] != "indexAuto") {
				$dynListColonne .= '`' . $value ['nom'] . '`';
				$ajouteVirgule = true;
			}
			
			if (array_key_exists ( 'jointure', $value )) {
				$root = $value ['jointure'];
				$remplaceValeur [$root ['nomChampRecherche']] = array (
						'aChercher' => $root ['nomChampRecherche'],
						'aStocker' => $value ['nom'],
						'table' => $root ['nomTable'] 
				);
			}
		}
		
		foreach ( $pData as $key => $value ) {
			$dynInsertTable = "INSERT INTO " . $table_name . " (" . $dynListColonne . ") VALUES(";
			$ajouteVirgule = false;
			
			foreach ( $value as $k => $v ) {
				$jointure = false;
				
				if ( ! is_null( $remplaceValeur )) {
					
					if (array_key_exists ( $k, $remplaceValeur )) {
						$jointure = true;
						
						$valeurATrouver = $remplaceValeur [$k]['aChercher'];
						$valeurAStocker = $remplaceValeur [$k]['aStocker'];
						$tableAParcourir = $wpdb->prefix . $remplaceValeur [$k]['table'];
						
						$sqlRequest = "SELECT `" . $valeurAStocker . "` FROM `" . $tableAParcourir . "` WHERE `" . $valeurATrouver . "`='" . $v."'";

						$row = $wpdb->get_results ( $sqlRequest );
						
						$valeurAAjouter = $row[0]->$valeurAStocker;
					}
				} 
				
				if ( ! $jointure) {
					$valeurAAjouter = $v;
				}
				
				if ($ajouteVirgule) {
					$dynInsertTable .= ',';
				}
				$dynInsertTable .= '"' . $valeurAAjouter . '"';
				$ajouteVirgule = true;
			}
			$dynInsertTable .= ');';
			
			$e = $wpdb->query ( $dynInsertTable );
		}
	}
}

?>
