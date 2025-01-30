<?php
require_once(__DIR__ . "/../partials/header.php")
?>
<div class="body">
        <form action="" method="POST">
            <h4>INSCRIPTION</h4>
            <hr>
            <div class="name-field">
                <div>
                    <input name="lastname" id="lastname" type="text" placeholder="Nom">
                </div>
                <div>
                    <input name="firstname" id="firstname" type="text" placeholder="Prénom">
                </div>
            </div>
            <input name="mail" id="mail" type="email" placeholder="Adresse Mail" required>
            <input name="password" id="password" type="password" placeholder="Mot de passe">
            <button type="submit" value="s'inscrire">inscrire</button>
            <p>Vous avez déjà un compte ? <a href="#">Se connecter</a></p>
        </form>
    </div>
</div>
<?php
require_once(__DIR__ . "/../partials/footer.php");
?>