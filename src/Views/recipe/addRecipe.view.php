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
		<form method="POST" enctype="multipart/form-data" class="addRecipeForm">
			<label for="fileToUpload">Ajouter votre photo de la recette :</label>
			<input type="file" name="fileToUpload" id="fileToUpload">
			<?php
			if (isset($error)) {
			?>
				<div class="alert alert-danger errorContainer" role="alert">
					<p class='text-danger'><?= $error ?></p>
				</div>
			<?php
			}
			?>
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
				<option value="facile">Débutant</option>
				<option value="moyen">Moyen</option>
				<option value="expert">Expert</option>
			</select>
			<label for="ingredient">Ingrédients utilisé</label>
			<div id="ingredientContainer">
				<div class="imgIngredientContainer">
					<div class="imgRecipe">
						<img src="/public/img/oeuf.jpg" alt="oeuf" id="imgIngredient">
					</div>
					<div class="imgRecipe">
						<img src="/public/img/lait.jpg" alt="lait" id="imgIngredient">
					</div>
					<div class="imgRecipe">
						<img src="/public/img/sucre.jpg" alt="sucre" id="imgIngredient">
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