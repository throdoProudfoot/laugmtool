{* Smarty *}

<h2>Hello, welcome to the Lauogm plugin administration !</h2>

<p>Vous pouvez réinitialiser les différentes tables utilisées par le plugin <b>L'Anneau Unique Outils pour GM</b></p>

<form method="post" action="">
    <fieldset>
        <legend>Cochez les tables que vous voulez réinitialiser :</legend>
        {foreach from=$listeTables item=table}
            <p>
                <input type="checkbox" name="{$table->libelle}" id="{$table->libelle}" />
                <label for="{$table->libelle}">{$table->libelle}</label>
            </p>
        {foreachelse}
            No items were found in the search        
        {/foreach}    
    </fieldset>
    <input type="submit" name="save" value="Valider" />
</form>

{* Le bloc suivant n'apparait que lorsque l'on a déja validé le formulaire *}
{if isset($formValidated)}<p>Les tables suivantes ont été réinitialisées : </p>
    <ul>
        {foreach from=$listeTablesReinitialisees item=tr}
            <li>{$tr}</li>
        {foreachelse}
            No items were found in the search        
        {/foreach}            
    </ul>
{/if}

<em>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</em>