<?php
require_once(__DIR__ . "/../partials/header.php")
?>
<section>
<h1>Connexion</h1>
<form method='POST'>
    <div class="input-box">
            <input name="mail" id="mail"type="text" placeholder="Adresse mail">
            <i class="fa-solid fa-user"></i>
        <?php if (isset($this->arrayError['mail'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['mail'] ?></p>
        <?php
        } ?>
    </div>
    <div class="input-box">
            <input name="password" id="password" type="text" placeholder="Mot de passe">
            <i class="fa-solid fa-lock"></i>
        <?php if (isset($this->arrayError['password'])) {
        ?>
            <p class='text-danger'><?= $this->arrayError['password'] ?></p>
        <?php
        } ?>
    </div>
    <button type="submit"class="login-btn">Se connecter</button>
    <div>
        <p class="href">Pas de compte ?<a href="#">Inscription</a></p> 
    </div>
</form>
</section>
<?php
if (isset($error)) {
    echo "<p class='text-danger'>" . $error . "<p>";
}
require_once(__DIR__ . "/../partials/footer.php");
?>
