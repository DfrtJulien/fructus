<?php
require_once(__DIR__ . "/../partials/head.php");

use App\Models\Comment;
?>

<div class="img-container img-container-headerRecipe" id="hero">
	<img src="/public/img/headerRecipes.jpg" alt="image strawberry">
</div>
<section class="mostCommentedRecipe">
	<div>
		<h3>A la une</h3>
	</div>
	<?php
	if (isset($mostComentedRecipe)) {
		$id_recipe = $mostComentedRecipe->getId();

	?>
		<a href="/recipe?id_recipe=<?= $mostComentedRecipe->getId() ?>">
			<div class="mostCommentedRecipeFlex">
				<div class="mostCommentedRecipeImgContainer">
					<img src="/public/img/<?= $mostComentedRecipe->getImg() ?>" alt="<?= $mostComentedRecipe->getTitle() ?>" class="mostComentedImg">
					<?php
					if (isset($_SESSION['user'])) {

						if (in_array($id_recipe, $idLikedMostCommentRecipes)) {
					?>
							<i class="fa-solid fa-heart likeIcon"></i>
						<?php
						} else {
						?>
							<i class="fa-regular fa-heart likeIcon"></i>
					<?php
						}
					}

					?>
				</div>
				<div class="mostComentedRecipeInfo">
					<h4><?= $mostComentedRecipe->getTitle() ?></h4>
					<p><?= $mostComentedRecipe->getDescription() ?></p>
					<?php

					$id_recipe = $mostComentedRecipe->getId();
					$newComment = new Comment(null, null, null, null, null, null, $id_recipe, null, null);

					$comment = $newComment->getNumberComment();
					$numberComments = $comment["COUNT(content)"];

					$sumNote = $newComment->sumArticleNote();
					$sumNoteInt = intval(reset($sumNote));

					if ($numberComments) {
						$recipeNote = $sumNoteInt / $numberComments;
					} else {
						$recipeNote = 0;
					}
					?>
					<div class="ratingContainer">
						<?php

						if ($recipeNote) {

						?>
							<i class="<?= $recipeNote == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $recipeNote < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $recipeNote < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $recipeNote < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $recipeNote < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<a href="/recipe?id_recipe=<?= $mostComentedRecipe->getId() ?>#comments" class="myRecipeNumberComment"><?= $numberComments ?> Avis</a>
						<?php

						}

						?>
					</div>
				</div>
			</div>
		</a>
	<?php
	}
	?>

</section>
<section class="recentRecipes">
	<div>
		<h3>Recettes du jours</h3>
		<div class="flexRecipeContainer">
			<?php


			foreach ($recentRecipes as $recipe) {
				$id_recipe = $recipe->getId();
				$newComment = new Comment(null, null, null, null, null, null, $id_recipe, null, null);

				$comment = $newComment->getNumberComment();
				$numberComments = $comment["COUNT(content)"];

				$sumNote = $newComment->sumArticleNote();
				$sumNoteInt = intval(reset($sumNote));

				if ($numberComments) {
					$recipeNote = $sumNoteInt / $numberComments;
				} else {
					$recipeNote = 0;
				}
			?>
				<a href="/recipe?id_recipe=<?= $recipe->getId() ?>">
					<div class="allRecipe recentRecipe">
						<img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>" class="recipeImg">
						<?php
						if (isset($_SESSION['user'])) {
							if (in_array($id_recipe, $idLikedRecentRecipes)) {
						?>
								<i class="fa-solid fa-heart likeIcon"></i>
							<?php
							} else {
							?>
								<i class="fa-regular fa-heart likeIcon"></i>
						<?php
							}
						}
						?>
						<div class="recentRecipeInfo">
							<h4><?= $recipe->getTitle() ?></h4>

							<div class="ratingContainer">
								<?php
								if ($recipeNote) {
								?>
									<i class="<?= $recipeNote == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
									<i class="<?= $recipeNote < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
									<i class="<?= $recipeNote < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
									<i class="<?= $recipeNote < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
									<i class="<?= $recipeNote < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
									<a href="/recipe?id_recipe=<?= $recipe->getId() ?>#comments" class="myRecipeNumberComment"><?= $numberComments ?> Avis</a>
								<?php
								}
								?>
							</div>
						</div>
					</div>
				</a>
			<?php
			}

			?>
		</div>
	</div>
</section>
<section class="allRecipesContainer">
	<div>
		<h3>Toutes nos recettes</h3>
		<div class="flexRecipeContainer">
			<?php
			foreach ($allRecipes as $recipe) {
				$id_recipe = $recipe->getId();
				$newComment = new Comment(null, null, null, null, null, null, $id_recipe, null, null);

				$comment = $newComment->getNumberComment();
				$numberComments = $comment["COUNT(content)"];

				$sumNote = $newComment->sumArticleNote();
				$sumNoteInt = intval(reset($sumNote));

				if ($numberComments) {
					$recipeNote = $sumNoteInt / $numberComments;
				} else {
					$recipeNote = 0;
				}

			?>
				<a href="/recipe?id_recipe=<?= $recipe->getId() ?>">
					<div class="allRecipe">
						<div class="imgRecipeContainer">
							<img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>" class="recipeImg">
						</div>
						<h5 class="recipeTitle"><?= $recipe->getTitle() ?></h5>
						<?php
						if (isset($_SESSION['user'])) {
							if (in_array($id_recipe, $idLikedRecipes)) {
						?>
								<i class="fa-solid fa-heart likeIcon"></i>
							<?php
							} else {
							?>
								<i class="fa-regular fa-heart likeIcon"></i>
							<?php
							}
						}

						if ($recipeNote) {
							?>
							<div class="ratingContainer">
								<i class="<?= $recipeNote == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
								<i class="<?= $recipeNote < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
								<i class="<?= $recipeNote < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
								<i class="<?= $recipeNote < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
								<i class="<?= $recipeNote < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
								<a href="/recipe?id_recipe=<?= $recipe->getId() ?>#comments" class="myRecipeNumberComment"><?= $numberComments ?> Avis</a>
							</div>
						<?php
						}
						?>

					</div>
				</a>
			<?php
			}
			?>
		</div>
	</div>
</section>
<a href="#hero"><i class="fa-solid fa-arrow-up arrowUp" id="arrowUp"></i></a>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>