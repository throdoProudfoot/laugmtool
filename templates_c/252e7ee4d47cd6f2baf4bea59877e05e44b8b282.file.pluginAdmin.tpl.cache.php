<?php /* Smarty version Smarty-3.0.7, created on 2013-01-01 21:19:13
         compiled from "/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/pluginAdmin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127364580250e352d1eb9b54-11368720%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '252e7ee4d47cd6f2baf4bea59877e05e44b8b282' => 
    array (
      0 => '/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/pluginAdmin.tpl',
      1 => 1357075136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127364580250e352d1eb9b54-11368720',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<h2>Hello, welcome to the Lauogm plugin administration !</h2>

<p>Vous pouvez réinitialiser les différentes tables utilisées par le plugin <b>L'Anneau Unique Outils pour GM</b></p>

<form method="post" action="">
    <fieldset>
        <legend>Cochez les tables que vous voulez réinitialiser :</legend>
        <?php  $_smarty_tpl->tpl_vars['table'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listeTables')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['table']->key => $_smarty_tpl->tpl_vars['table']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['table']->key;
?>
            <p title="<?php echo $_smarty_tpl->tpl_vars['table']->value["toolTip"];?>
 !">
                <input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" id="<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
" />
                <label for="<?php echo $_smarty_tpl->tpl_vars['table']->value["libelle"];?>
"><?php echo $_smarty_tpl->tpl_vars['table']->value["libelle"];?>
</label>
            </p>
        <?php }} else { ?>
            No items were found in the search        
        <?php } ?>    
    </fieldset>
    <input type="submit" name="save" value="Valider" />
</form>

<?php if (isset($_smarty_tpl->getVariable('erreurDetected',null,true,false)->value)){?>
	<?php $_template = new Smarty_Internal_Template('erreurInclude.tpl', $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php }?>
<?php if (isset($_smarty_tpl->getVariable('formValidated',null,true,false)->value)){?><p>Les tables suivantes ont été réinitialisées : </p>
    <ul>
        <?php  $_smarty_tpl->tpl_vars['tr'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('listeTablesReinitialisees')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tr']->key => $_smarty_tpl->tpl_vars['tr']->value){
?>
            <li><?php echo $_smarty_tpl->tpl_vars['tr']->value;?>
</li>
        <?php }} else { ?>
            No items were found in the search        
        <?php } ?>            
    </ul>
<?php }?>

<em>It is run on <b><?php echo $_SERVER['SERVER_NAME'];?>
</b> server.</em>