{* Smarty *}

<h2>Hello, welcome to the Lauogm plugin administration!<h2>

        <p>Texte avant le formulaire</p>

        <form method="post" action="">
            <fieldset>
                <legend>Cochez les tables que vous voulez réinitialiser :</legend> <!-- Titre du fieldset --> 
                <input type="checkbox" name="races" id="races" /> <label for="races">Races</label><br />
            </fieldset>
            <input type="submit" name="save" value="Valider" />
        </form>

        <p>Texte après le formulaire : {$resultFile}</p>

        <em>It is run on <b>{$smarty.server.SERVER_NAME}</b> server.</em>