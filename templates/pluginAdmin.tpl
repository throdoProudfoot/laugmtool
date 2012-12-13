{* Smarty *}

<h2>Hello, welcome to the Lauogm plugin administration !<h2>

        <p>Vous pouvez réinitialiser les différentes tables utilisées par le plugin <b>L'Anneau Unique Outils pour GM</b></p>

        <form method="post" action="">
            <fieldset>
                <legend>Cochez les tables que vous voulez réinitialiser :</legend> <!-- Titre du fieldset --> 
                <input type="checkbox" name="peuples" id="peuples" /> <label for="peuples">Peuples</label><br />
            </fieldset>
            <input type="submit" name="save" value="Valider" />
        </form>

        <p>Texte après le formulaire : {$resultFile}</p>

        <em>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</em>