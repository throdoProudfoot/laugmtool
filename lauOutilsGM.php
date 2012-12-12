<?php

/*
  Plugin Name: L'Anneau Unique - Outils du Maitre du Jeu
  Plugin URI: http://lauOutils.throdo-fierpied.com/pluginWordpress/
  Description: Un plugin WordPress qui fournit des outils le Maitre du Jeu de l'Anneau Unique. Une série d'outils est disponible comme la création de personnage par exemple.
  Version: 0.1
  Author: Throdo Proudfoot
  Author URI: http://www.throdo-fierpied.com/
  License: GPL2
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

include_once 'Lauogm_ConfigPage.php';
include_once WPLAUOGM_PLUGIN_CLASS_DIR . '/LauogmPluginOptionPageClass.php';

// Hook
register_activation_hook(__FILE__, 'jal_install');
register_activation_hook(__FILE__, 'jal_install_data');

// Variable Globale
global $jal_db_version;
$jal_db_version = "1.0";

// Initialisation du plugin
function jal_install() {
    global $wpdb;
    global $jal_db_version;

    $table_name = $wpdb->prefix . "racesdisponible";

    global $wpdb;
    $sql = "CREATE TABLE $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      name tinytext NOT NULL,
      shortdescription tinytext NOT NULL,
      UNIQUE KEY id (id)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    add_option("jal_db_version", $jal_db_version);
}

function jal_install_data() {
    global $wpdb;

    $race_name = "Elfes sylvains";
    $race_shortdescription = "Habitants de la fôret de Vertbois depuis des millénaires !";

    $table_name = $wpdb->prefix . "racesdisponible";

    $rows_affected = $wpdb->insert($table_name, array('name' => $race_name, 'shortdescription' => $race_shortdescription));
}

// Lecture d'information dans un fichier.
function lireFichierMessage() {

    $fichierMessage = WPLAUOGM_PLUGIN_DIR . 'message.txt';
    $fileContentArray = file($fichierMessage);

    if ($fileContentArray == false) {
        $message = "Erreur de récupération du contenu du fichier " . $fichierMessage;
    } else {

        $message = $fileContentArray[0];
    }
    return $message;
}

// Parsing de fichier XML
function parsingXML() {
    $dataSource = file_get_contents(plugin_dir_path(__FILE__) . 'dataRefences.xml');
    $root = new SimpleXMLElement($dataSource);

    $peuples = $root->peuples;

    return $peuples;
}

//[lauoutilsgm]
function lauOutilsGM_func($atts) {

    //require_once SMARTY_DIR . '/Smarty.class.php';

//$messageDefaut = "Outils de création de personnage pour 'L'Anneau Unique' - Livre de Base (issue d'une fonction)";
    //$message = lireFichierMessage();
    $peuples = parsingXML();
    $message = "<b><u>Liste des peuples disponibles :</u></b><ul>";
    reset($peuples);
    //$message .= "<li>" . $peuples->peuple[0]->nom . "</li>";
    foreach ($peuples->peuple as $peuple) {
        $message .= "<li>" . $peuple->nom . "</li>";
    }
//    while (list($key, $val) = each($peuples)) {
//        $message = $message . "<li>" . $val->nom . "</li>";
//    }
    $message = $message . "</ul>";

    // NOTE: Smarty has a capital 'S'
    //require_once('../libs/Smarty.class.php');
//    $smarty = new Smarty();
//
//    $lauogmPluginDirectory = dirname(WPLAUOGM_PLUGIN_DIR) . "/" . dirname(WPLAUOGM_PLUGIN_BASENAME);
//    $smarty->template_dir = $lauogmPluginDirectory . "/templates";
//    $smarty->compile_dir = $lauogmPluginDirectory . "/templates_c";
//    $smarty->config_dir = $lauogmPluginDirectory . "/config";
//    $smarty->cache_dir = $lauogmPluginDirectory . "/cache";
//    $smarty->plugins_dir  = $lauogmPluginDirectory."/plugins";
//    $smarty->trusted_dir  = $lauogmPluginDirectory."/trusted";
//    $message .= "<br/>WPLAUOGM_PLUGIN_BASENAME = " . dirname(WPLAUOGM_PLUGIN_BASENAME);
//    $message .= "<br/>WPLAUOGM_PLUGIN_DIR = " . dirname(WPLAUOGM_PLUGIN_DIR);
//    $message .= "<br/>plugin_dir_path() = " . plugin_dir_path();
//    $message .= "<br/>SMARTY_DIR = " . SMARTY_DIR;
//    $message .= "<br/>SMARTY_SYSPLUGINS_DIR = " . SMARTY_SYSPLUGINS_DIR;
//    $includeReturned = set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_DIR);
//    $message .= "<br/>Old get_include_path() = " . $includeReturned;
//    $message .= "<br/>New get_include_path() = " . get_include_path();
//    $template_dir = $smarty->getTemplateDir();
//    print_r($template_dir);
//    $smarty->testInstall();
//    $smarty->assign('name', 'Throdo');
    //** un-comment the following line to show the debug console
//    $smarty->debugging = true;
//    $smarty->display('index.tpl');
    
    require_once WPLAUOGM_PLUGIN_CLASS_DIR . '/SmartyLauogmClass.php';
    
    $smartyLauogm = new SmartyLauogm();
    $smartyLauogm->debugging = true;

    $smartyLauogm->assign('name', 'ThrodoTest');
    $smartyLauogm->assign('sequential', 'second');
    $smartyLauogm->assign('randomValue', '1');
//    $smartyLauogm->display('index.tpl');

//    $message="";
//    $message=$smartyLauogm->fetch('index.tpl');
//    return $message;
    return $smartyLauogm->fetch('index.tpl');
}

add_shortcode('lauoutilsgm', 'lauoutilsgm_func');

new Lauogm_OptionPage();

?>