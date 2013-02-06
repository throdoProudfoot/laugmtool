{* Smarty *}


<h1>{$app_name}</h1>

<h2>{$name}, vous avez choisi comme peuple {$peuple}</h2>

    <p class="lauFormTitle"><b><u>Choisir sa vocation parmi celles disponibles :</u></b></p>

    <form id="selectionneVocation" method="post" action="#">
    <input type="hidden" id="vocationSelected" name="vocations">
    	
	<div id="ca-container" class="ca-container">
    <div class="ca-wrapper">
        {foreach from=$listeVocations key=k item=vocation}
    
        <div class="ca-item ca-item-{$vocation['IndexVocation']}">
            <div class="ca-item-main">
                <div class="ca-icon"></div>
                <h3 key="{$vocation['IdVocation']}">{$vocation['NomVocation']}</h3>
                <h4>
                    <span class="ca-quote">“</span>
                    <span>{$vocation['DescriptionCourteVocation']}</span>
                </h4>
                <a href="#" class="ca-more">plus...</a>
            </div>
         <div class="ca-content-wrapper">
                <div class="ca-content">
                    <h6>Super Peuple qui roxxe</h6>
                    <a href="#" class="ca-close">close</a>
                    <div class="ca-content-text">
                        <p>{$vocation['DescriptionLongueVocation']}</p>
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
		    </form>