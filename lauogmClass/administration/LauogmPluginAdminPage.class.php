<?php
// echo WPLAUOGM_PLUGIN_DIR.'/SmartyLauogm.class.php';
// require WPLAUOGM_PLUGIN_DIR.'/SmartyLauogm.class.php';
/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/**
 * Description of Lauogm_OptionPage
 *
 * @author throdo
 */
class LauogmPluginAdminPage {
	private $smarty = null;
	private $descTable = array ();
	
	/**
	 */
	function __construct() {
		add_action ( 'admin_menu', array (
				&$this,
				'admin_menu' 
		) );
	}
	
	/**
	 *
	 * @return multitype:
	 */
	public function getDescTable() {
		return $this->descTable;
	}
	
	/**
	 *
	 * @param unknown_type $descTable        	
	 */
	public function setDescTable($descTable) {
		$this->descTable = $descTable;
	}
	
	/**
	 *
	 * @param unknown_type $key        	
	 * @param unknown_type $value        	
	 */
	private function ajouteEnregistrement($key, $value) {
		$this->descTable [$key] = $value;
	}
	
	/**
	 */
	function admin_menu() {
		add_options_page ( 'L\'Anneau Unique Outils de GM - Plugin Options', 'Lauogm Plugin', 'manage_options', 'my-unique-identifier', array (
				$this,
				'settings_page' 
		) );
	}
	
	/**
	 */
	function settings_page() {
		$arrayTablesReinitialisees = array ();
		$this->smarty = new SmartyLauogm ( true );
		
		try {
			$tdf = new TableDataReferences ();
		} catch ( Exception $e ) {
			$this->smarty->assign ( 'erreurDetected', true );
		}
		
		try {
			$tables = $tdf->getTableList ();
			$this->smarty->assign ( 'listeTables', $tables );
		} catch ( Exception $e ) {
			$this->smarty->assign ( 'erreurDetected', true );
			$this->assignErreur ( $e );
		}
		
		// Traitement à réaliser lorsque l'on est passé dans le formulaire et
		// que l'on a validé
		if (isset ( $_POST ['save'] )) {
			// Récupération de la description des Tables.
			try {
				$arrayTablesReinitialisees = $this->processFormResult ( $tables, $_POST, $tdf );
			} catch ( LauDataFileNotFoundException $e ) {
				$this->smarty->assign ( 'erreurDetected', true );
				$this->assignErreur ( $e );
			}
			
			$this->smarty->assign ( 'formValidated', true );
			$this->smarty->assign ( 'listeTablesReinitialisees', $arrayTablesReinitialisees );
		}
		
		$this->smarty->display ( 'pluginAdmin.tpl' );
	}
	
	/**
	 * Fonction qui permet d'assigner le contenu d'une exception dans un
	 * template d'erreur.
	 *
	 * @param unknown_type $exception        	
	 */
	private function assignErreur($exception) {
		$this->smarty->assign ( 'erreurCode', $exception->getCode () );
		$this->smarty->assign ( 'erreurMessage', $exception->getMessage () );
	}
	
	/**
	 *
	 * @param array $post        	
	 * @throws Exception
	 * @return array $retArray
	 */
	public function processFormResult($pTables, $pPost, $pTableRef) {
		$retArray = array ();
		foreach ( $pTables as $key => $value ) {
			if (isset ( $pPost [$key] )) {
				try {
					$dataRef = strtolower ( $value ['libelle'] );
					$dr = new DataReferences ( $dataRef );
				} catch ( Exception $e ) {
					$this->smarty->assign ( 'erreurDetected', true );
					$this->assignErreur ( $e );
				}
				try {
					$structure = $pTableRef->getStructure ( $key );
				} catch ( Exception $e ) {
					$this->smarty->assign ( 'erreurDetected', true );
					$this->assignErreur ( $e );
				}
				$dr->storeDataRef ( $key, $structure );
				array_push ( $retArray, $dataRef );
			}
		}
		return $retArray;
	}
}

?>
