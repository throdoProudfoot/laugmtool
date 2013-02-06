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
	global $wp_styles;
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
// 		echo "<pre>";
// 		print_r ($vpp);
// 		echo "</pre>";
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

/*
 * Gestion de la Session
 */
add_action ( 'init', 'myStartSession', 1 );
function myStartSession() {
	//echo WPLAUOGM_PLUGIN_DIR + '/extensions/CircularContentCarousel/demo.css';
	if (! session_id ()) {
		session_start ();
	}
}

add_action ( 'wp_logout', 'myEndSession' );
add_action ( 'wp_login', 'myEndSession' );
function myEndSession() {
	session_destroy ();
}

/*
 * Ajout des JS et CSS
 */
add_action ( 'wp_head', "lauAddCSS" );
function lauAddCSS() {
	//echo WPLAUOGM_PLUGIN_DIR + '/extensions/CircularContentCarousel/demo.css';
	wp_enqueue_style ( 'demo-carousel-style',   plugins_url( 'extensions/CircularContentCarousel/css/demo.css', __FILE__ ));
	wp_enqueue_style ( 'style-carousel-style', plugins_url( 'extensions/CircularContentCarousel/css/style.css', __FILE__ ));
	wp_enqueue_style ( 'jscrollpane-carousel-style', plugins_url( 'extensions/CircularContentCarousel/css/jquery.jscrollpane.css', __FILE__ ));

}

add_action ( 'wp_enqueue_scripts', "lauAddJS" );
function lauAddJS() {

	wp_deregister_script( 'jquery' );
	
	wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js', array(), '1.8', true );
	
	wp_deregister_script( 'jquery-ui-core' );
	wp_deregister_script( 'jquery-ui-tab' );
	wp_deregister_script( 'jquery-ui-autocomplete' );
	wp_deregister_script( 'jquery-ui-accordion' );
	wp_deregister_script( 'jquery-ui-autocomplete' );
	wp_deregister_script( 'jquery-ui-button' );
	wp_deregister_script( 'jquery-ui-datepicker');
	wp_deregister_script( 'jquery-ui-dialog' );
	wp_deregister_script( 'jquery-ui-draggable' );
	wp_deregister_script( 'jquery-ui-droppable' );
	wp_deregister_script( 'jquery-ui-mouse' );
	wp_deregister_script( 'jquery-ui-position' );
	wp_deregister_script( 'jquery-ui-progressbar');
	wp_deregister_script( 'jquery-ui-resizable' );
	wp_deregister_script( 'jquery-ui-selectable');
	wp_deregister_script( 'jquery-ui-slider' );
	wp_deregister_script( 'jquery-ui-sortable' );
	wp_deregister_script( 'jquery-ui-tabs' );
	wp_deregister_script( 'jquery-ui-widget' );
	
	wp_enqueue_script( 'jquery-ui-core', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js', array( 'jquery' ), '1.9', true);
	
	wp_enqueue_script( 'test-jquery', plugins_url( 'extensions/CircularContentCarousel/js/laugmtoolJquery.js', __FILE__ ), array( 'jquery','jquery-ui-core' ), '0.1', true);

	wp_enqueue_script( 'jquery-easing', plugins_url( 'extensions/CircularContentCarousel/js/jquery.easing.1.3.js', __FILE__ ), array( 'jquery','jquery-ui-core' ), '1.3', true);
	wp_enqueue_script( 'jquery-mousewheel', plugins_url( 'extensions/CircularContentCarousel/js/jquery.mousewheel.js', __FILE__ ), array( 'jquery','jquery-ui-core' ), '0.1', true);
	wp_enqueue_script( 'jquery-carousel', plugins_url( 'extensions/CircularContentCarousel/js/jquery.contentcarousel.js', __FILE__ ), array( 'jquery','jquery-ui-core' ), '0.1', true);
	
}

$pluginAdminPage = new LauogmPluginAdminPage ();
?>