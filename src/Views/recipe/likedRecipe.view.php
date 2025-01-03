<?php

require_once(__DIR__ . "/../partials/headerOrange.php");

use App\Models\Comment;
?>
<section class="likedRecipes">

  <?php
  if ($favoriteRecipes) {
  ?>
    <h1>Vos recettes préférés</h1>
    <div class="likedRecipesContainer">
      <?php
      foreach ($favoriteRecipes as $recipe) {
        $id_recipe = $recipe->getId();
        $newComment = new Comment(null, null, null, null, null, null, $id_recipe, null, null);
        $comment = $newComment->getNumberComment();

        $numberComments = $comment["COUNT(content)"];
        $sumNote = $newComment->sumArticleNote();
        $sumNoteInt = intval(reset($sumNote));
      ?>
        <a href="/recipe?id_recipe=<?= $recipe->getId() ?>">
          <div class="likedRecipe">
            <div class="likedRecipeImg">
              <img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>">
            </div>
            <div class="likedRecipeInfo">
              <h2><?= $recipe->getTitle() ?></h2>
              <div class="ratingContainerFavorite">
                <?php
                if ($numberComments) {
                ?>
                  <i class="<?= $sumNoteInt == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
                  <i class="<?= $sumNoteInt < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
                  <i class="<?= $sumNoteInt < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
                  <i class="<?= $sumNoteInt < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
                  <i class="<?= $sumNoteInt < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
                  <a href="/recipe?id_recipe=<?= $recipe->getId() ?>#comments" class="myRecipeNumberComment"><?= $numberComments ?> Avis</a>
                <?php
                }
                ?>
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
