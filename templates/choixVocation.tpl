{* Smarty *}


<h1>{$app_name}</h1>

<h2>{$name}, vous avez choisi comme peuple {$peuple}</h2>

    <p class="lauFormTitle"><b><u>Choisir sa vocation parmi celles disponibles :</u></b></p>
    <form method="post" action="#">
	    <fieldset>
	    	<label for="vocation">Vocation</label>
		    <select name="vocations">
		    {foreach from=$listeVocations key=k item=vocation}
		        <option value={$k}>{$vocation}</option>
		    {foreachelse}
		        <p class="lauError">Il y a sans doute une erreur, aucun résultat retourné par la recherche.</p>        
		    {/foreach}
		    </select>
		    <input type="submit" name="vocationValide" value="Valider" />
	    <fieldset>
	    <p><em>(*) Attention, les vocations suivi de ce symbole sont des vocations secondaires. A ne prendre qu'avec l'accor du Gardien des Secrets.</em></p>
	</form> 