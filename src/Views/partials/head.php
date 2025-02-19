<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Fructus
    </title>
    <script src="https://kit.fontawesome.com/f5a1d28d53.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/public/style/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg myNav" id="myNav">
        <div class="container-fluid">
            <div>
                <i class="fa-solid fa-bars burger" id="open-menu"></i>
                <a class="navbar-brand title" href="/"> Fructus</a>
            </div>
            <div class="searchContainer">
                <input type="text" class="searchInput">
                <i class="fa-solid fa-magnifying-glass searchIcon"></i>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex">
                        <a class="nav-link nav-link-white" href="/recipes">Recettes</a>
                        <?php
                        if (!isset($_SESSION['user'])) {
                        ?>

                            <a class="nav-link nav-link-white" href="/register">Inscription</a>
                            <a class="nav-link nav-link-white" href="/login">Connexion</a>
                    </li>
                <?php
                        } else {
                ?>

                    <a class="nav-link nav-link-white" href="/recipeLiked">Mes Favoris</a>
                    <a class="nav-link nav-link-white" href="/logout">Déconnexion</a>
                    <?php
                            if ($_SESSION['user']["id_role"] == 1) {
                    ?>
                        <a class="nav-link nav-link-white" href="/addRecipe">Ajoutez une recette</a>
                    <?php
                            }
                    ?>
                    </li>
                <?php
                        }
                ?>

                </ul>
            </div>
        </div>
    </nav>
    <div class="menu-container hidden" id="menu">
        <div class="menu">
            <div>
                <h3>Catégory</h3>
                <ul>
                    <li><a href="/recipeFilter?category=gateaux"">Gateaux</a></li>
                    <li><a href=" /recipeFilter?category=crepe"">Crêpes</a></li>
                    <li><a href="/recipeFilter?category=tarte"">tarte</a></li>
                </ul>
            </div>
            <div>
                <h3>Goût</h3>
                <ul>
                    <li><a href=" /recipeFilter?category=chocolat">Chocolat</a></li>
                    <li><a href="/recipeFilter?category=fraise">Fraise</a></li>
                    <li><a href="/recipeFilter?category=multifruit">Multifruit</a></li>
                </ul>
            </div>
            <i class="fa-solid fa-x close-menu" id="close-menu"></i>
        </div>
    </div>