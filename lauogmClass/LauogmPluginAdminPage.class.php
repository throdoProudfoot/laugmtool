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

    private $descTable = array();

    function __construct() {
        add_action('admin_menu', array(&$this, 'admin_menu'));
    }

    function admin_menu() {
        add_options_page('L\'Anneau Unique Outils de GM - Plugin Options', 'Lauogm Plugin', 'manage_options', 'my-unique-identifier', array($this, 'settings_page'));
    }

    function settings_page() {

        $smartyLauogmAdmin = new SmartyLauogm(false);

        $tableReferences = new DataReferences('tables');
        $tables = $tableReferences->parseXml('tables');
        reset($tables->table);
        $smartyLauogmAdmin->assign('listeTables', $tables->table);

        // Traitement à réaliser lorsque l'on est passé dans le formulaire et que l'on a validé
        if (isset($_POST['save'])) {
            foreach ($tables->table as $currentTable) {
                //$this->descTable["$currentTable->libelle"]["nom"] = $currentTable->nom;
                $this->descTable["$currentTable->libelle"] = $currentTable;
            }

            $smartyLauogmAdmin->assign('formValidated', true);
            $arrayTablesReinitialisees = array();

            if (isset($_POST['Peuples'])) {
                array_push($arrayTablesReinitialisees, 'Peuples');

                $drHandle = new DataReferences('peuples');
                $data = $drHandle->parseXml('peuples');
                reset($data->peuple);
                $drHandle->stockMySQL($data, $this->descTable['Peuples']);
            }

            if (isset($_POST['Vocations'])) {
                array_push($arrayTablesReinitialisees, 'Vocations');
            }

            if (isset($_POST['Avantages'])) {
                array_push($arrayTablesReinitialisees, 'Avantages');
            }

            $smartyLauogmAdmin->assign('listeTablesReinitialisees', $arrayTablesReinitialisees);
        }

        $smartyLauogmAdmin->display('pluginAdmin.tpl');
    }

}

?>
