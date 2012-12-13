<?php /* Smarty version Smarty-3.0.7, created on 2012-12-13 21:33:08
         compiled from "/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/choixRace.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45122600350ca4994dcf192-95435526%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a788e559611faffa8b8701b17a258db50aaeff5d' => 
    array (
      0 => '/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/choixRace.tpl',
      1 => 1355434356,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45122600350ca4994dcf192-95435526',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<h2>Hello <?php echo $_smarty_tpl->getVariable('name')->value;?>
, welcome to Lauogm tool !</h2>

<em>This is my <?php echo $_smarty_tpl->getVariable('sequential')->value;?>
 player character !</em>

<p>It is run on <b><?php echo $_SERVER['SERVER_NAME'];?>
</b> server.</p>

    <b><u>Liste des peuples disponibles :</u></b>
    <ul>
    <?php  $_smarty_tpl->tpl_vars['peuple'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listePeuples')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['peuple']->key => $_smarty_tpl->tpl_vars['peuple']->value){
?>
        <li><?php echo $_smarty_tpl->getVariable('peuple')->value->nom;?>
</li>
    <?php }} else { ?>
        No items were found in the search        
    <?php } ?>    
    </ul>
    
