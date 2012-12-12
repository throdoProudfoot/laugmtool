<?php /* Smarty version Smarty-3.0.7, created on 2012-12-04 19:04:50
         compiled from "/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53974347050be4952c20766-69191645%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '49c4ee3e87dcccb3dc425fdc394ab1fd2ced2a55' => 
    array (
      0 => '/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/index.tpl',
      1 => 1354647787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '53974347050be4952c20766-69191645',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<h2>Hello <?php echo $_smarty_tpl->getVariable('name')->value;?>
, welcome to Smarty!<h2>

<em>This is my <?php echo $_smarty_tpl->getVariable('sequential')->value;?>
 template !</em>

It is run on <b><?php echo $_SERVER['SERVER_NAME'];?>
</b> server.

New things in the template with new variable <?php echo $_smarty_tpl->getVariable('randomValue')->value;?>
