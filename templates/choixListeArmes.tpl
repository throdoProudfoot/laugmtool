{* Smarty *}


<h1>{$app_name}</h1>

<h2>{$name}, vous avez choisi comme peuple {$peuple} et comme vocation {$vocation}</h2>

    <p class="lauFormTitle"><b><u>Choisir sa liste d'armes parmi celles disponibles :</u></b></p>
    <form method="post" action="#">
	    <fieldset>
	    	<label for="listesArme">Listes des Armes</label>
		    <select name="listesArmes">
		    {foreach from=$listesArmes key=k item=listeArmes}
		        <option value={$k}>{$listeArmes}</option>
		    {foreachelse}
		        <p class="lauError">Il y a sans doute une erreur, aucun résultat retourné par la recherche.</p>        
		    {/foreach}
		    </select>
		    <input type="submit" name="listeArmeValide" value="Valider" />
	    <fieldset>
	</form> 