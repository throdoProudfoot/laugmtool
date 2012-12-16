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

    public function stockMySQL($data, $structure) {
        global $wpdb;

        $table_name = $wpdb->prefix . $structure->nom;
        $dynInsert = "CREATE TABLE " . $table_name . "(";

        echo ('<hr><pre>STRUCTURE');
        var_dump($structure);
        echo ('</pre>');
//
//        echo ('<hr><pre>DATA');
//        var_dump($data);
//        echo ('</pre>');
//
//        echo '<hr>Nom de la table = ' . $table_name . '<br/>';

        foreach ($structure as $key => $value) {
            $dynInsert .= $key . ' tinytext NOT NULL,';
            echo '<hr>Key = ' . $key . ' - Value = ' . $value . '<br/>';
        }

        $dynInsert .= 'UNIQUE KEY id (id));';

        echo '<hr>requête SQL = <br/>' . $dynInsert . '<br/>';

        $sql = "CREATE TABLE $table_name (
          id mediumint(9) NOT NULL AUTO_INCREMENT,
          name tinytext NOT NULL,
          shortdescription tinytext NOT NULL,
          UNIQUE KEY id (id)
        );";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        //dbDelta($sql);
    }

}

?>
