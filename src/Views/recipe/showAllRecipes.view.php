<?php
require_once(__DIR__ . "/../partials/head.php");

use App\Models\Comment;
?>


<div class="img-container img-container-headerRecipe">
	<img src="/public/img/headerRecipes.jpg" alt="image strawberry">
</div>
<section class="allRecipesContainer">
	<div>
		<h3>Toutes nos recettes</h3>
		<div class="flexRecipeContainer">
			<?php
			foreach ($allRecipes as $recipe) {
				$id_recipe = $recipe->getId();
				$newComment = new Comment(null, null, null, null, null, null, $id_recipe);
				$comment = $newComment->getNumberComment();

				$numberComments = $comment["COUNT(content)"];
				$sumNote = $newComment->sumArticleNote();
				$sumNoteInt = intval(reset($sumNote));
			?>
				<a href="/recipe?id_recipe=<?= $recipe->getId() ?>">
					<div class="allRecipe">
						<div class="imgRecipeContainer">
							<img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>" class="recipeImg">
						</div>
						<h5 class="recipeTitle"><?= $recipe->getTitle() ?></h5>
						<?php
						if (in_array($id_recipe, $idLikedRecipes)) {
						?>
							<i class="fa-solid fa-heart likeIcon"></i>
						<?php
						} else {
						?>
							<i class="fa-regular fa-heart likeIcon"></i>
						<?php
						}
						?>
						<div class="ratingContainer">
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
				</a>
			<?php
			}
			?>
		</div>
	</div>
</section>


<?php
require_once(__DIR__ . "/../partials/footer.php");
?>