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
if (! defined ( 'WPLAUOGM_PLUGIN_BASENAME' ))
	define ( 'WPLAUOGM_PLUGIN_BASENAME', basename ( __FILE__ ) );
	
	/*
 * Attention RUSE !!! dirname ( dirname(__FILE__) utilisé pour enlever le
 * dernier répertoire du chemin d'accès qui est /tests et donc obtenir le vrai
 * répertoire racine.
 */
if (! defined ( 'WPLAUOGM_PLUGIN_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_DIR', dirname ( dirname ( __FILE__ ) ) );

if (! defined ( 'WPLAUOGM_PLUGIN_CLASS_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_CLASS_DIR', WPLAUOGM_PLUGIN_DIR . '/lauogmClass' );

if (! defined ( 'WPLAUOGM_PLUGIN_DAO_CLASS_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_DAO_CLASS_DIR', WPLAUOGM_PLUGIN_CLASS_DIR . '/dao' );

if (! defined ( 'WPLAUOGM_PLUGIN_EXCEPTION_CLASS_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_EXCEPTION_CLASS_DIR', WPLAUOGM_PLUGIN_CLASS_DIR . '/exception' );

if (! defined ( 'WPLAUOGM_PLUGIN_DATA_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_DATA_DIR', WPLAUOGM_PLUGIN_DIR . '/dataReferences' );

if (! defined ( 'WPLAUOGM_PLUGIN_TESTDATA_DIR' ))
	define ( 'WPLAUOGM_PLUGIN_TESTDATA_DIR', WPLAUOGM_PLUGIN_DIR . '/tests/testDataReferences' );

if (! defined ( 'WPLAUOGM_DEBUG_MODE' ))
	define ( 'WPLAUOGM_DEBUG_MODE', true );
	
// Fonction anonyme à partir de PHP 5.3.0 qui permet l'auto-chargement des
	// Classes
spl_autoload_register ( function ($class) {
	$include = array (
			WPLAUOGM_PLUGIN_CLASS_DIR,
			WPLAUOGM_PLUGIN_DAO_CLASS_DIR,
			WPLAUOGM_PLUGIN_EXCEPTION_CLASS_DIR 
	);
	$find = false;
	foreach ( $include as $key => $value ) {
		$file = $value . '/' . $class . '.class.php';
		if (file_exists ( $file )) {
			include $file;
			$find = true;
		}
	}
	if (! $find) {
		throw new Exception ( "Error include de la classe " . $class, 2000 );
	}
} );

?>