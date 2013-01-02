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
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>

<h2>Hello, welcome to the Lauogm plugin administration !</h2>

<p>Vous pouvez réinitialiser les différentes tables utilisées par le plugin <b>L'Anneau Unique Outils pour GM</b></p>

<form method="post" action="">
    <fieldset>
        <legend>Cochez les tables que vous voulez réinitialiser :</legend>
                    <p title="Description des peuples !">
                <input type="checkbox" name="lauPeuples" id="lauPeuples" />
                <label for="Peuples">Peuples</label>
            </p>
                    <p title="Description des vocations !">
                <input type="checkbox" name="lauVocations" id="lauVocations" />
                <label for="Vocations">Vocations</label>
            </p>
                    <p title="Description des avantages !">
                <input type="checkbox" name="lauAvantages" id="lauAvantages" />
                <label for="Avantages">Avantages</label>
            </p>
            
    </fieldset>
    <input type="submit" name="save" value="Valider" />
</form>


<em>It is run on <b>localhost</b> server.</em><?php } ?>