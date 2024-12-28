<?php
require_once(__DIR__ . "/../partials/headerOrange.php");
?>
<secction class="registerContainer">

  <div class="form">
    <h1>Se connecter</h1>
    <form method="POST">
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
        <button type="submit" class="registerBtn">Se connecter</button>
        <p>Ou</p>
        <a href="/register" class="loginLink">S'inscrire</a>
      </div>

    </form>
  </div>
</secction>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>