<?php /*%%SmartyHeaderCode:20788947550c8edb1f11e25-19823326%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '252e7ee4d47cd6f2baf4bea59877e05e44b8b282' => 
    array (
      0 => '/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/templates/pluginAdmin.tpl',
      1 => 1355345321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20788947550c8edb1f11e25-19823326',
  'has_nocache_code' => false,
  'cache_lifetime' => 0,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>

<h2>Hello, welcome to the Lauogm plugin administration !<h2>

        <p>Vous pouvez réinitialiser les différentes tables utilisées par le plugin <b>L'Anneau Unique Outils pour GM</b></p>

        <form method="post" action="">
            <fieldset>
                <legend>Cochez les tables que vous voulez réinitialiser :</legend> <!-- Titre du fieldset --> 
                <input type="checkbox" name="peuples" id="peuples" /> <label for="peuples">Peuples</label><br />
            </fieldset>
            <input type="submit" name="save" value="Valider" />
        </form>

        <p>Texte après le formulaire : empty.php</p>

        <em>It is run on <b>localhost</b> server.</em><?php } ?>