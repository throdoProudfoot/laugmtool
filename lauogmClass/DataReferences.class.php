<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DataReferences
 *
 * @author throdo
 */
class DataReferences {

    //Fichier initial, contenant les données
    private $file;
    private $arrayValue;
    private $rootElement;
    private $childElement;

    function __construct($dataFileType) {
        $this->rootElement = $dataFileType;
        $this->file = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $dataFileType . 'References.xml';
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($dataGameType) {
        $this->file = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $dataGameType . 'References.xml';
    }

    public function getArrayValue() {
        return $this->arrayValue;
    }

    public function setArrayValue($array) {
        $this->arrayValue = $array;
    }

    private function parseXml() {
        $dataSource = file_get_contents($this->file);
        $root = new SimpleXMLElement($dataSource);

        reset($root);

        foreach ($root as $table) {
            $this->arrayValue[(string) $table->nom] = (array) $table;
        }

        $this->childElement = (string) $root['childNode'];
    }

    public function getDataReferenceInformation() {
        $this->parseXml();
        return $this->getArrayValue();
    }

    public function storeData($name) {
        global $wpdb;

//        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $table_name = $wpdb->prefix . $name["nom"];

        $dynDropTable = "DROP TABLE IF EXISTS `" . $table_name . "`;";

        $e = $wpdb->query($dynDropTable);
        
        $dynCreateTable = "CREATE TABLE " . $table_name . " (";
        $dynCreateTable .= 'id MEDIUMINT NOT NULL AUTO_INCREMENT,';

        foreach ($name["structure"] as $key => $value) {
            $dynCreateTable .= ' ' . $key;
            foreach ($value->attributes() as $k => $v) {
                if ($k == 'type') {
                    $dynCreateTable .= ' ' . strtoupper($v);
                }
                if ($k == 'nullable') {
                    if ($v == 'Yes') {
                        $dynCreateTable .= ' NULL,';
                    } else {
                        $dynCreateTable .= ' NOT NULL,';
                    }
                }
            }
        }

        $dynCreateTable .= ' PRIMARY KEY  (id));';
        $e = $wpdb->query($dynCreateTable);
    }

}

?>
