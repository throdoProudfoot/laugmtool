<?php

/*
 * Plugin Name: L'Anneau Unique - Outils du Maitre du Jeu Plugin URI:
 * http://lauOutils.throdo-fierpied.com/pluginWordpress/ Description: Un plugin
 * WordPress qui fournit des outils le Maitre du Jeu de l'Anneau Unique. Une
 * série d'outils est disponible comme la création de personnage par exemple.
 * Version: 0.1 Author: Throdo Proudfoot Author URI:
 * http://www.throdo-fierpied.com/ License: GPL2
 */

/*  Copyright 2012  Throdo_Prodoufoot  (email : throdo.proudfoot@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

require_once 'Lauogm_ConfigPage.php';

// Fonction anonyme à partir de PHP 5.3.0 qui permet l'auto-chargement des
// Classes
spl_autoload_register ( function ($class) {
	$include = array (
			WPLAUOGM_PLUGIN_CLASS_DIR,
			WPLAUOGM_PLUGIN_DAO_CLASS_DIR,
			WPLAUOGM_PLUGIN_EXCEPTION_CLASS_DIR,
			WPLAUOGM_PLUGIN_ADMINISTRATION_CLASS_DIR 
	);
	$find = false;
	foreach ( $include as $key => $value ) {
		$file = $value . '/' . $class . '.class.php';
		if (file_exists ( $file )) {
			include $file;
			$find = true;
		}
	}
} );

// Variable Globale
global $wpdb;

if (WPLAUOGM_DEBUG_MODE) {
	$wpdb->show_errors ();
} else {
	$wpdb->hide_errors ();
}

// [lauoutilsgm]
function lauOutilsGM_func($atts) {
	if (count ( $_POST ) == 0) {
		if (array_key_exists ( 'etape', $_SESSION )) {
			unset ( $_SESSION ['etape'] );
			unset ( $_SESSION ['idPeuple'] );
			unset ( $_SESSION ['nomPeuple'] );
		}
	}
	
	$smartyLauogm = new SmartyLauogm ();
	
	$peuples = new Peuples ();
	
	if (! isset ( $_SESSION ['etape'] )) {
		$listePeuples = $peuples->getPeupleList ();
		$smartyLauogm->assign ( 'listePeuples', $listePeuples );
		$smartyLauogm->assign ( 'name', 'ThrodoTest' );
		$smartyLauogm->assign ( 'sequential', 'first' );
		$display = $smartyLauogm->fetch ( 'choixRace.tpl' );
		$_SESSION ['etape'] = 'vocations';
	} elseif ($_SESSION ['etape'] == 'vocations') {
		$pIdPeuple = $_POST ['peuples'];
		$pNomPeuple = $peuples->getPeupleNom ( $pIdPeuple );
		$_SESSION ['idPeuple'] = $pIdPeuple;
		$_SESSION ['nomPeuple'] = $pNomPeuple;
		
		$vpp = new PeuplesParVocations ( $pIdPeuple );
		$listeVocations = $vpp->getPeuplesParVocationsList ();
		
		$smartyLauogm->assign ( 'name', 'ThrodoTest' );
		$smartyLauogm->assign ( 'listeVocations', $listeVocations );
		$smartyLauogm->assign ( 'peuple', $pNomPeuple );
		$display = $smartyLauogm->fetch ( 'file:choixVocation.tpl' );
		$_SESSION ['etape'] = 'choixListeArmes';
	} elseif ($_SESSION ['etape'] == 'choixListeArmes') {
		$pIdVocation = $_POST ['vocations'];
		$pNomPeuple = $_SESSION ['nomPeuple'];
		$vocations = new Vocations ();
		$pNomVocation = $vocations->getVocationNom ( $pIdVocation );
		$_SESSION ['idVocation'] = $pIdVocation;
		$_SESSION ['nomVocation'] = $pNomVocation;
		
		// $vpp = new PeuplesParVocations ( $pId );
		// $listeVocations = $vpp->getPeuplesParVocationsList ();
		
		$smartyLauogm->assign ( 'name', 'ThrodoTest' );
		$smartyLauogm->assign ( 'listesArmes', array (
				0 => 'Arc',
				1 => 'Lance' 
		) );
		$smartyLauogm->assign ( 'peuple', $pNomPeuple );
		$smartyLauogm->assign ( 'vocation', $pNomVocation );
		$display = $smartyLauogm->fetch ( 'file:choixListeArmes.tpl' );
		$_SESSION ['etape'] = 'choixSpecialites';
	}
	
	return $display;
}

add_shortcode ( 'lauoutilsgm', 'lauoutilsgm_func' );

add_action ( 'init', 'myStartSession', 1 );
function myStartSession() {
	if (! session_id ()) {
		session_start ();
	}
}

add_action ( 'wp_logout', 'myEndSession' );
add_action ( 'wp_login', 'myEndSession' );
function myEndSession() {
	session_destroy ();
}

$pluginAdminPage = new LauogmPluginAdminPage ();
?>