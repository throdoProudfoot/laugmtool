{* Smarty *}

<h1>{$app_name}</h1>

<h2>Bonjour {$name}, bienvenu dans l'outils pour Gardien des Légendes !</h2>

<em>This is my {$sequential} player character !</em>

<p>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</p>


    <p class="lauFormTitle"><b><u>Choisir son peuple parmi ceux disponibles :</u></b></p>
    <form method="post" action="#">
	    <fieldset>
	    	<label for="peuple">Peuple</label>
		    <select name="peuples">
		    {foreach from=$listePeuples key=k item=peuple}
		        <option value={$k}>{$peuple}</option>
		    {foreachelse}
		        <p class="lauError">Il y a sans doute une erreur, aucun résultat retourné par la recherche.</p>        
		    {/foreach}
		    </select>
		    <input type="submit" name="peupleValide" value="Valider" />
	    <fieldset>
	</form> 