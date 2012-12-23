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

    public function getDescTable() {
        return $this->descTable;
    }

    public function setDescTable($descTable) {
        $this->descTable = $descTable;
    }

    private function ajouteEnregistrement($key, $value) {
        $this->descTable[$key] = $value;
    }

    function admin_menu() {
        add_options_page('L\'Anneau Unique Outils de GM - Plugin Options', 'Lauogm Plugin', 'manage_options', 'my-unique-identifier', array($this, 'settings_page'));
    }

    function settings_page() {
        $arrayTablesReinitialisees = array();
        $smartyLauogmAdmin = new SmartyLauogm(false);

        // Récupération de la description des Tables.
        $tableReferences = new DataReferences('tables');
        $tables = $tableReferences->getDataReferenceInformation();

        $smartyLauogmAdmin->assign('listeTables', $tables);

        // Traitement à réaliser lorsque l'on est passé dans le formulaire et que l'on a validé
        if (isset($_POST['save'])) {
            $tables = $tableReferences->getArrayValue();
            foreach ($tables as $key => $value) {
                if (isset($_POST[(string) $value["nom"]])) {
                    echo "<br/> Données traitées : " . $value["libelle"] . "<br/>";
                    array_push($arrayTablesReinitialisees, $value["libelle"]);

                    $drHandle = new DataReferences(strtolower($value["libelle"]));
                    $drHandle->storeData($value);
                }
                //$this->ajouteEnregistrement((string) $currentTable->libelle, $currentTable);
            }

            $smartyLauogmAdmin->assign('formValidated', true);
            $smartyLauogmAdmin->assign('listeTablesReinitialisees', $arrayTablesReinitialisees);
        }

        $smartyLauogmAdmin->display('pluginAdmin.tpl');
    }

}

?>
