{* Smarty *}

<h2>Hello {$name}, welcome to Lauogm tool !</h2>

<em>This is my {$sequential} player character !</em>

<p>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</p>

    <b><u>Liste des peuples disponibles :</u></b>
    <ul>
    {foreach from=$listePeuples key=k item=peuple}
        <li>{$peuple}</li>
    {foreachelse}
        No items were found in the search        
    {/foreach}    
    </ul>
    
