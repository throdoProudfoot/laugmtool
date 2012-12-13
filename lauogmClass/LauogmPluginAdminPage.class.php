<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Lauogm_OptionPage
 *
 * @author throdo
 */
class LauogmPluginAdminPage {

    function __construct() {
        add_action('admin_menu', array(&$this, 'admin_menu'));
    }

    function admin_menu() {
        add_options_page('L\'Anneau Unique Outils de GM - Plugin Options', 'Lauogm Plugin', 'manage_options', 'my-unique-identifier', array($this, 'settings_page'));
    }

    function settings_page() {

        require_once WPLAUOGM_PLUGIN_CLASS_DIR . '/SmartyLauogmClass.php';

        $smartyLauogmAdmin = new SmartyLauogm();
        $smartyLauogmAdmin->debugging = false;

        // Traitement à réaliser lorsque l'on est passé dans le formulaire et que l'on a validé
        if (isset($_POST['save'])) {
            $smartyLauogmAdmin->assign('resultFile', WPLAUOGM_PLUGIN_DIR . '/result.php');            
        } else {
            $smartyLauogmAdmin->assign('resultFile', 'empty.php');            
        }
        $smartyLauogmAdmin->display('pluginAdmin.tpl');
    }

}
?>
