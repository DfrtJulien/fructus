<?php
require_once(__DIR__ . "/../partials/headerOrange.php");
?>

<secction class="registerContainer">

	<div class="form">
		<h1>Ajoutez une recette</h1>
		<?php
		if (isset($succesMsg)) {
		?>
			<div class="alert alert-success errorContainer" role="alert">
				<p class='text-success'><?= $succesMsg['register'] ?></p>
			</div>
		<?php
		}
		?>
		<form method="POST">
			<label for="title" id="title">Titre de la recette</label>
			<input type="text" name="title">
			<?php
			if (isset($this->arrayError['name'])) {
			?>
				<div class="alert alert-danger errorContainer" role="alert">
					<p class='text-danger'><?= $this->arrayError['name'] ?></p>
				</div>
			<?php
			}
			?>
			<label for="description" id="description">Description rapide</label>
			<input type="text" name="description">
			<?php
			if (isset($this->arrayError['mail'])) {
			?>
				<div class="alert alert-danger errorContainer" role="alert">
					<p class='text-danger'><?= $this->arrayError['mail'] ?></p>
				</div>
			<?php
			}
			?>
			<label for="recipe" id="recipe">Ajoutez les instructions de la recette</label>
			<textarea name="recipe"></textarea>
			<?php
			if (isset($this->arrayError['password'])) {
			?>
				<div class="alert alert-danger errorContainer" role="alert">
					<p class='text-danger'><?= $this->arrayError['password'] ?></p>
				</div>
			<?php
			}
			?>
			<label for="time" id="time">Durée de préparation de la recette</label>
			<input type="number" name="time">
			<label for="dificulty">Niveau de difficulté de la recette</label>
			<select name="dificulty" id="dificulty">
				<option value="easy">Débutant</option>
				<option value="medium">Moyen</option>
				<option value="hard">Expert</option>
			</select>
			<label for="ingredient">Ingrédients utilisé</label>
			<div id="ingredientContainer">
				<div class="imgIngredientContainer">
					<div class="imgRecipe">
						<img src="/public/img/eggs.jpg" alt="eggs" id="imgIngredient">
					</div>
					<div class="imgRecipe">
						<img src="/public/img/milk.jpg" alt="milk" id="imgIngredient">
					</div>
					<div class="imgRecipe">
						<img src="/public/img/sugar.jpg" alt="sugar" id="imgIngredient">
					</div>
					<div class="imgRecipe">
						<img src="/public/img/beurre.jpg" alt="beurre" id="imgIngredient">
					</div>
				</div>
			</div>
			<div class="registerLoginContainer">
				<button type="submit" class="registerBtn">Ajoutez la recette</button>
			</div>

		</form>
	</div>
</secction>

<?php
require_once(__DIR__ . "/../partials/footer.php");
?>