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

    private $file;

    function __construct($dataGameType) {
        $this->file = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $dataGameType . 'References.xml';
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($dataGameType) {
        $this->file = WPLAUOGM_PLUGIN_DATA_DIR . '/' . $dataGameType . 'References.xml';
    }

    public function parseXml($dataRoot) {
        $dataSource = file_get_contents($this->file);
        $root = new SimpleXMLElement($dataSource);

        $arrayResult = $root->$dataRoot;

        return $arrayResult;
    }

}

?>
