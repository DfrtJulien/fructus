<?php

require_once(__DIR__ . "/../partials/headerOrange.php");
?>
<section class="likedRecipes">

  <?php
  if ($favoriteRecipes) {
  ?>
    <h1>Vos recettes préférés</h1>
    <div class="likedRecipesContainer">
      <?php
      foreach ($favoriteRecipes as $recipe) {
      ?>
        <a href="/recipe?id_recipe=<?= $recipe->getId() ?>">
          <div class="likedRecipe">
            <div class="likedRecipeImg">
              <img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>">
            </div>
            <div class="likedRecipeInfo">
              <h2><?= $recipe->getTitle() ?></h2>
              <div class="likedRecipeNote">
                <p>note</p>
                <p>avis</p>
              </div>
            </div>
            <i class="fa-solid fa-heart likeIcon"></i>
          </div>
        </a>
      <?php
      }
      ?>
    </div>
  <?php
  } else {
  ?>
    <h2>Vous n'avez pas encore de recettes préférés</h2>
    <img src="/public/img/noFavorite.jpg" alt="Cooking" class="noFavortieImg">
    <a href="/recipes" class="noFavoriteLink">Retourner au recettes</a>
  <?php
  }
  ?>

</section>

<?php

require_once(__DIR__ . "/../partials/footer.php");
