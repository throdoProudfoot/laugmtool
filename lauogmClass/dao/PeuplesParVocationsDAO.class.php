<?php

/*
 * To change this template, choose Tools | Templates and open the template in
 * the editor.
 */

/*
 * TODO Trouver comment sortir la variable globale $wpdb pour pouvoir réaliser des Tests.
 */

/**
 * Description of PeupleParVocationsDAO
 *
 * @author throdo
 */
class PeuplesParVocationsDAO {
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
	function __construct($pIdPeuple) {
		global $wpdb;
		
		$this->tableName = $wpdb->prefix . WPLAUOGM_PEUPLESPARVOCATIONS_TABLE;
		
		$this->data = $this->readInfoFromDB ($pIdPeuple);
	}
	
	/**
	 *
	 * @return unknown
	 */
	private function readInfoFromDB($pIdPeuple) {
		global $wpdb;
		
		$returnArray = array ();
		$sqlRequest = "SELECT  VPP.`idPeuple`, VPP.`idVocation`, P.`nomPeuple`, V.`nomVocation`, VPP.`priorite` FROM `wpcm_lauVocationsParPeuples` AS VPP, `wpcm_lauVocations` AS V, `wpcm_lauPeuples` AS P WHERE VPP.idPeuple = P.idPeuple AND VPP.idVocation = V.idVocation AND P.idPeuple=".$pIdPeuple;
		$returnArray = $wpdb->get_results ( $sqlRequest );
		
		return $returnArray;
	}
}

?>
