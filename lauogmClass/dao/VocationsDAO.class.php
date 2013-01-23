<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/*
 * TODO Trouver comment sortir la variable globale $wpdb pour pouvoir réaliser des Tests.
 */

/**
 * Description of VocationsDAO
 *
 * @author throdo
 */
class VocationsDAO {
	private $tableName;
	private $data = array ();
	
	/**
	 *
	 * @return the $tableName
	 */
	public function getTableName() {
		return $this->tableName;
	}
	
	/**
	 *
	 * @return the $data
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 *
	 * @param string $tableName        	
	 */
	public function setTableName($tableName) {
		$this->tableName = $tableName;
	}
	
	/**
	 *
	 * @param multitype: $data        	
	 */
	public function setData($data) {
		$this->data = $data;
	}
	
	/**
	 */
	function __construct() {
		global $wpdb;
		
		$this->tableName = $wpdb->prefix . WPLAUOGM_VOCATIONS_TABLE;
		
		$this->data = $this->readInfoFromDB ();
	}
	
	/**
	 *
	 * @return unknown
	 */
	private function readInfoFromDB() {
		global $wpdb;
		
		$returnArray = array ();
		$sqlRequest = "SELECT  `idVocation`, `nomVocation`, `descriptionVocation` FROM `" . $this->getTableName () . "`";
		
		$returnArray = $wpdb->get_results ( $sqlRequest );
		
		return $returnArray;
	}
}

?>
