<?php
require_once(__DIR__ . "/../partials/head.php");

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