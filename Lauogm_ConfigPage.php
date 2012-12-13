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

define('WPLAUOGM_VERSION', '0.1');

define('WPLAUOGM_REQUIRED_WP_VERSION', '3.3');

if (!defined('WPLAUOGM_PLUGIN_BASENAME'))
    define('WPLAUOGM_PLUGIN_BASENAME', plugin_basename(__FILE__));

if (!defined('WPLAUOGM_PLUGIN_DIR'))
    define('WPLAUOGM_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));

if (!defined('WPLAUOGM_PLUGIN_CLASS_DIR'))
    define('WPLAUOGM_PLUGIN_CLASS_DIR', WPLAUOGM_PLUGIN_DIR . '/lauogmClass');

if (!defined('WPLAUOGM_PLUGIN_DATA_DIR'))
    define('WPLAUOGM_PLUGIN_DATA_DIR', WPLAUOGM_PLUGIN_DIR . '/dataReferences');

?>