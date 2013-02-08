{* Smarty *}

<h1>{$app_name}</h1>

<h2>Bonjour {$name}, bienvenu dans l'outils pour Gardien des Légendes !</h2>

<em>This is my {$sequential} player character !</em>

<p>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</p>

<p class="lauFormTitle"><b><u>Choisir son peuple parmi ceux disponibles :</u></b></p>
	<form id="selectionnePeuple" method="post" action="#">
	<input type="hidden" id="peupleSelected" name="peuples">
    	
	<div id="ca-container" class="ca-container">
    <div class="ca-wrapper">
        {foreach from=$listePeuples key=k item=peuple}
    
        <div class="ca-item ca-item-{$peuple['IndexPeuple']}">
            <div class="ca-item-main">
				<div id="ca-item-key-{$peuple['IdPeuple']}" class="ca-item-clickable">
	                <div class="ca-icon"></div>
	                <h3 key="{$peuple['IdPeuple']}">{$peuple['NomPeuple']}</h3>
	                <h4>
	                    <span class="ca-quote">“</span>
	                    <span>{$peuple['DescriptionCourtePeuple']}</span>
	                </h4>
				</div>
                    <a href="#" class="ca-more">plus...</a>
            </div>
            <div class="ca-content-wrapper">
                <div class="ca-content">
                    <h6>Super Peuple qui roxxe</h6>
                    <a href="#" class="ca-close">close</a>
                    <div class="ca-content-text">
                        <p>{$peuple['DescriptionLonguePeuple']}</p>
                    </div>
                    <ul>
                        <li><a href="#">Encore plus</a></li>
                        <li><a href="#">Choisir</a></li>
                    </ul>
                </div>
            </div>
        </div>
    	{foreachelse}
			<p class="lauError">Il y a sans doute une erreur, aucun résultat retourné par la recherche.</p>        
		{/foreach}
    </div><!-- ca-wrapper -->
</div><!-- ca-container -->
<input type="submit" id="suivantBouton" value="Suivant >">
</form>
 