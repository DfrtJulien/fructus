<?php
require_once(__DIR__ . "/../partials/headerOrange.php");
?>
<secction class="registerContainer">

    <div class="form">
        <h1>S'inscrire</h1>
        <form method="POST">
            <label for="name" id="name">Votre nom</label>
            <input type="text" name="name">
            <?php
            if (isset($this->arrayError['name'])) {
            ?>
                <div class="alert alert-danger errorContainer" role="alert">
                    <p class='text-danger'><?= $this->arrayError['name'] ?></p>
                </div>
            <?php
            }
            ?>
            <label for="mail" id="mail">Votre email</label>
            <input type="email" name="mail">
            <?php
            if (isset($this->arrayError['mail'])) {
            ?>
                <div class="alert alert-danger errorContainer" role="alert">
                    <p class='text-danger'><?= $this->arrayError['mail'] ?></p>
                </div>
            <?php
            }
            ?>
            <label for="password" id="password">Votre mot de passe</label>
            <input type="password" name="password">
            <?php
            if (isset($this->arrayError['password'])) {
            ?>
                <div class="alert alert-danger errorContainer" role="alert">
                    <p class='text-danger'><?= $this->arrayError['password'] ?></p>
                </div>
            <?php
            }
            ?>
            <div class="registerLoginContainer">
                <button type="submit" class="registerBtn">S'inscrire</button>
                <p>Ou</p>
                <a href="/login" class="loginLink">Se connecter</a>
            </div>

        </form>
    </div>
</secction>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>