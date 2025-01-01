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
			?>
		</div>
	</div>
	<div class="myRecipeInstruction">
		<p><?= $myRecipe->getInstruction() ?></p>
	</div>
</setction>

<?php

require_once(__DIR__ . "/../partials/footer.php");
