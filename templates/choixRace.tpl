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
		    <input type="submit" class="button" name="peupleValide" value="Valider" />
	    <fieldset>
	</form> 
	
	<div id="ca-container" class="ca-container">
    <div class="ca-wrapper">
        {foreach from=$listePeuples key=k item=peuple}
    
        <div class="ca-item ca-item-{$k}">
            <div class="ca-item-main">
                <div class="ca-icon"></div>
                <h3>{$peuple}</h3>
                <h4>
                    <span class="ca-quote">“</span>
                    <span>Some text...</span>
                </h4>
                    <a href="#" class="ca-more">more...</a>
            </div>
            <div class="ca-content-wrapper">
                <div class="ca-content">
                    <h6>Super Peuple qui roxxe</h6>
                    <a href="#" class="ca-close">close</a>
                    <div class="ca-content-text">
                        <p>Some more text...</p>
                    </div>
                    <ul>
                        <li><a href="#">Read more</a></li>
                        <li><a href="#">Share this</a></li>
                        <li><a href="#">Become a member</a></li>
                        <li><a href="#">Donate</a></li>
                    </ul>
                </div>
            </div>
        </div>
    	{foreachelse}
			<p class="lauError">Il y a sans doute une erreur, aucun résultat retourné par la recherche.</p>        
		{/foreach}
    </div><!-- ca-wrapper -->
</div><!-- ca-container -->