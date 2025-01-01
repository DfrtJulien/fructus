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

			?>
				<div class="allRecipe">
					<div class="imgRecipeContainer">
						<img src="/public/img/<?= $recipe->getImg() ?>" alt="<?= $recipe->getTitle() ?>" class="recipeImg">
					</div>
					<h5 class="recipeTitle"><?= $recipe->getTitle() ?></h5>
					<i class="fa-solid fa-heart likeIcon"></i>
					<i class="fa-regular fa-heart likeIcon"></i>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</section>


<?php
require_once(__DIR__ . "/../partials/footer.php");
?>