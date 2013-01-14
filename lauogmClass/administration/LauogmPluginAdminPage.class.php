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
				$arrayTablesReinitialisees = $df->processFormResult ( $_POST );
			} catch ( LauDataFileNotFoundException $e ) {
				$this->smarty->assign ( 'erreurDetected', true );
				$this->assignErreur ( $e );
			}
			
			$this->smarty->assign ( 'formValidated', true );
			$this->smarty->assign ( 'listeTablesReinitialisees', $arrayTablesReinitialisees );
		}
		
		$this->smarty->display ( 'pluginAdmin.tpl' );
	}
	private function assignErreur($exception) {
		$this->smarty->assign ( 'erreurCode', $exception->getCode () );
		$this->smarty->assign ( 'erreurMessage', $exception->getMessage () );
	}
}

?>
