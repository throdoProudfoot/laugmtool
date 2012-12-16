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

require_once 'Lauogm_ConfigPage.php';

// Fonction anonyme à partir de PHP 5.3.0 qui permet l'auto-chargement des Classes
spl_autoload_register(function ($class) {
            include WPLAUOGM_PLUGIN_CLASS_DIR . '/' . $class . '.class.php';
        });

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

//[lauoutilsgm]
function lauOutilsGM_func($atts) {

    $dataReferences = new DataReferences('peuples');
    $peuples = $dataReferences->parseXml('peuples');
    reset($peuples->peuple);

    $smartyLauogm = new SmartyLauogm(false);

    $smartyLauogm->assign('listePeuples',$peuples->peuple);
    $smartyLauogm->assign('name', 'ThrodoTest');
    $smartyLauogm->assign('sequential', 'first');
    
    return $smartyLauogm->fetch('choixRace.tpl');
}

add_shortcode('lauoutilsgm', 'lauoutilsgm_func');

$pluginAdminPage = new LauogmPluginAdminPage();

?>