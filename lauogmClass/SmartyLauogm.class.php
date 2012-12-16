<?php

//set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_SYSPLUGINS_DIR);
//set_include_path(get_include_path() . PATH_SEPARATOR . SMARTY_DIR);
//require 'Smarty.class.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartyLauogm
 *
 * @author throdo
 */
class SmartyLauogm extends Smarty {

    function __construct($debug=false) {

        // Class Constructor.
        // These automatically get set with each new instance.

        parent::__construct();

        $this->template_dir = WPLAUOGM_PLUGIN_DIR . "/templates";
        $this->compile_dir = WPLAUOGM_PLUGIN_DIR . "/templates_c";
        $this->config_dir = WPLAUOGM_PLUGIN_DIR . "/config";
        $this->cache_dir = WPLAUOGM_PLUGIN_DIR . "/cache";

        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->cache_lifetime = 0;
        $this->debugging = $debug;

        $this->assign('app_name', 'The One Ring - GM Tool Set');

        //$this->testInstall();
    }

}

?>
