<?php

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
		$smartyLauogmAdmin = new SmartyLauogm ( false );
		
		try {
			$df = new DataReferences ();
		} catch ( Exception $e ) {
			$smartyLauogmAdmin->assign ( 'erreurDetected', true );
			$smartyLauogmAdmin->assign ( 'erreur', $e );
		}
		
		try {
			$tables = $df->getTableList ();
			$smartyLauogmAdmin->assign ( 'listeTables', $tables );
		} catch ( Exception $e ) {
			$smartyLauogmAdmin->assign ( 'erreurDetected', true );
			$smartyLauogmAdmin->assign ( 'erreur', $e );
		}
		
		// Traitement à réaliser lorsque l'on est passé dans le formulaire et
		// que l'on a validé
		if (isset ( $_POST ['save'] )) {
			
			// Récupération de la description des Tables.
			try {
				$arrayTablesReinitialisees = $df->processFormResult ( $_POST );
			} catch ( LauDataFileNotFoundException $e ) {
				$smartyLauogmAdmin->assign ( 'erreurDetected', true );
				$smartyLauogmAdmin->assign ( 'erreur', $e );
			}
			
			$smartyLauogmAdmin->assign ( 'formValidated', true );
			$smartyLauogmAdmin->assign ( 'listeTablesReinitialisees', $arrayTablesReinitialisees );
		}
		
		$smartyLauogmAdmin->display ( 'pluginAdmin.tpl' );
	}
}

?>
