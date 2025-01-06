<?php
require_once(__DIR__ . "/../partials/headerOrange.php");

use App\Models\Comment;
?>
<setction class="recipeContainer">
	<div class="myRecipeInfo">
		<div>
			<h3 class="myRecipeTitle"><?= $myRecipe->getTitle() ?></h3>
			<p class="myRecipeDescription"><?= $myRecipe->getDescription() ?></p>
			<div class="ratingContainer">
				<?php
				if ($recipeNote) {
				?>
					<i class="<?= $recipeNote == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
					<i class="<?= $recipeNote < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
					<i class="<?= $recipeNote < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
					<i class="<?= $recipeNote < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
					<i class="<?= $recipeNote < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
					<p class="myRecipeNumberComment"><?= $numberComments ?> Avis</p>
				<?php
				}
				?>

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
			<form method="POST" class="addFavoriteForm">
				<input type="hidden" name="id_recipe" id="id_recipe" value="<?= $myRecipe->getId() ?>">
				<?php
				if (!$isLiked) {
				?>
					<button type="submit" class="addFavorite">Ajoutez au favoris</button>
				<?php
				} else {
				?>
					<button type="submit" class="addFavorite">Retirer des favoris</button>
				<?php
				}
				?>
				<a href="/addComment?id_recipe=<?= $myRecipe->getId() ?>" class="addCommentLink">Ajoutez un commentaire</a>

			</form>
		</div>

		<div class="myRecimeImgContainer">
			<img src="/public/img/<?= $myRecipe->getImg() ?>" alt="<?= $myRecipe->getTitle() ?>" class="myRecipeImg">
		</div>
	</div>
	<div class="myRecipeIngredient">
		<h3>Ingrédients</h3>
		<div class="myRecipeNumberIngredientContainer">
			<i class="fa-solid fa-minus" id="minus"></i>
			<div class="d-flex pContainer">
				<p class="numberToEat" id="numberToEat">1</p>
				<p>personne</p>
			</div>
			<i class="fa-solid fa-plus" id="plus"></i>
		</div>
		<div class="ingredientContainer">
			<?php
			if ($myIngredient) {


				foreach ($myIngredient as $ingredient) {
					$sumNote = $newComment->sumArticleNote();
					$sumNoteInt = intval(reset($sumNote));

			?>
					<div class="ingredient">
						<div class="ingredientImg">
							<img src="/public/img/<?= $ingredient->getIngredient_name() ?>.jpg" alt="<?= $ingredient->getIngredient_name() ?>">
						</div>
						<p class="test"><?= $ingredient->getIngredient_quantity() ?></p>
						<p><?= $ingredient->getIngredient_name() ?></p>
					</div>
			<?php
				}
			}
			$allInstruction = $myRecipe->getInstruction();

			// Utiliser une expression régulière pour couper à chaque chiffre suivi d'un point
			$steps = preg_split('/(?=\d+\.)/', $allInstruction);

			// Supprimer le premier élément vide si présent
			if (empty($steps[0])) {
				array_shift($steps);
			}

			?>
		</div>
	</div>
	<div class="myRecipeInstruction">
		<?php
		foreach ($steps as $instructions) {
		?>
			<p class="instruction"><?= $instructions ?></p>
		<?php
		}
		?>

	</div>

</setction>
<?php
if ($comments) {
?>
	<section id="comments">
		<h2>Donner votre avis</h2>
		<div class="commentsContainer">
			<?php
			foreach ($comments as $comment) {
				$id__comment_user = $comment->getId_user();
				$id_comment = $comment->getId();
				$fetchNote = new Comment(null, null, null, null, null, $id__comment_user, $id_recipe, null, null);
				$notes = $fetchNote->getNoteByUserId();
				$userNote = $notes->getRating();
				$username =  $comment->getUsername();
				$firstletter = mb_substr($username, 0, 1);
			?>
				<div class="comment">
					<div class="commentFlex">
						<p class="UserFirstLetter"><?= $firstletter ?></p>
						<div class="userInfo">
							<p><?= $comment->getUsername() ?></p>
							<i class="<?= $userNote == 0 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $userNote < 2 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $userNote < 3 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $userNote < 4 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
							<i class="<?= $userNote < 5 ? 'fa-regular' : 'fa-solid' ?> fa-star ratingIcon"></i>
						</div>
					</div>
					<p class="userComment"><?= $comment->getContent() ?></p>
					<?php
					if ($_SESSION['user']['id_user'] == $id__comment_user) {
					?>
						<a href="/editComment?id_comment=<?= $comment->getId() ?>" class="editComment">Modifier le commentaire</a>
					<?php
					}

					if ($_SESSION['user']['id_user'] == $id__comment_user || $_SESSION['user']['id_role'] == 1) {
					?>
						<a href="/deleteComment?id_comment=<?= $comment->getId() ?>" class="deleteComment">Supprimer le commentaire</a>
					<?php
					}
					?>
				</div>
			<?php
			}
			?>
		</div>
		<a href="/addComment?id_recipe=<?= $myRecipe->getId() ?>" class="addCommentLink">Ajoutez un commentaire</a>
	</section>
<?php
}
?>

<?php

require_once(__DIR__ . "/../partials/footer.php");
