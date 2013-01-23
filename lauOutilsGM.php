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
	session_start ();
	$smartyLauogm = new SmartyLauogm ();
	
	$peuples = new DataReferencesDAO ();
	
	if (count ( $_POST ) == 0) {
		$listePeuples = $peuples->getPeupleList ();
		$smartyLauogm->assign ( 'listePeuples', $listePeuples );
		$smartyLauogm->assign ( 'name', 'ThrodoTest' );
		$smartyLauogm->assign ( 'sequential', 'first' );
		$display = $smartyLauogm->fetch ( 'choixRace.tpl' );
	} elseif (isset ( $_POST ['peupleValide'] )) {
		$pId = $_POST ['peuples'];
		$pNom = $peuples->getPeupleNom ( $pId );
		$_SESSION ['idPeuple'] = $pId;
		$_SESSION ['nomPeuple'] = $pNom;
		
		$vpp = new PeuplesParVocations();
		
		$smartyLauogm->assign ( 'name', 'ThrodoTest' );
		$smartyLauogm->assign ( 'listeVocations', array (
				0 => 'Erudit',
				1 => 'Chasseur de trésors' 
		) );
		$smartyLauogm->assign ( 'peuple', $pNom );
		$display = $smartyLauogm->fetch ( 'file:choixVocation.tpl' );
	}
	
	return $display;
}

add_shortcode ( 'lauoutilsgm', 'lauoutilsgm_func' );

$pluginAdminPage = new LauogmPluginAdminPage ();
?>