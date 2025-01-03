<?php

require_once(__DIR__ . "/../partials/headerOrange.php");
?>
<setction class="recipeContainer">
  <div class="myRecipeInfo">
    <h3 class="myRecipeTitle"><?= $myRecipe->getTitle() ?></h3>
    <p class="myRecipeDescription"><?= $myRecipe->getDescription() ?></p>
    <div class="d-flex">
      <p>note</p>
      <p class="myRecipeNumberComment">avis</p>
    </div>
    <div class="timeAndDificulty">
      <div class="myRecipeFlexContainer">
        <div class="myRecipeFlex">
          <i class="fa-regular fa-clock myRecipeIcon"></i>
          <p><?= $myRecipe->getTime() ?> min</p>
        </div>
        <div class="myRecipeFlex">
          <i class="fa-solid fa-users myRecipeIcon"></i>
          <p><?= $myRecipe->getDifficulty() ?></p>
        </div>
      </div>
    </div>
    <div class="myRecimeImgContainer">
      <img src="/public/img/<?= $myRecipe->getImg() ?>" alt="<?= $myRecipe->getTitle() ?>" class="myRecipeImg">
    </div>
  </div>
  <div class="addNoteAndRating">
    <h3>Ajoutez votre note et commentaire</h3>
    <form method="POST">
      <label for="note">Ajoutez une note</label>
      <select name="note" id="note">
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>
      <?php
      if (isset($this->arrayError['note'])) {
      ?>
        <div class="alert alert-danger" role="alert">
          <p class='text-danger'><?= $this->arrayError['note'] ?></p>
        </div>
      <?php
      } ?>
      <label for="comment">Veuillez entrer votre commentaire :</label>
      <textarea name="comment" id="comment"></textarea>
      <?php
      if (isset($this->arrayError['comment'])) {
      ?>
        <div class="alert alert-danger" role="alert">
          <p class='text-danger'><?= $this->arrayError['comment'] ?></p>
        </div>
      <?php
      } ?>
      <button type="submit" class="addComentBtn">Ajoutez un commentaire</button>
    </form>
  </div>

</setction>

<?php

require_once(__DIR__ . "/../partials/footer.php");
