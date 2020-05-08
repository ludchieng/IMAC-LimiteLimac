<?php
if (!isset($_COOKIE['pname'], $_COOKIE['token']))
    header('Location: index.php?action=login');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('views/includes_before_body.php'); ?>
    <link rel="stylesheet" href="css/manager.css">
    <title>Manager · Limite Limac</title>
</head>

<body>

    <header>
        <button id="btn-play" class="btn-icon">
            <span>Jouer</span>
            <svg id="i-forwards" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
                <path d="M16 2 L30 16 16 30 16 16 2 30 2 2 16 16 Z" />
            </svg>
        </button>
        <button id="btn-home" class="btn-icon">
            <svg id="i-home" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="18" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3">
                <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" /></svg>
        </button>
    </header>

    <div id="manager">

        <main>
            <div id="card-panel"></div>
            <div id="info" class="m-4 hidden">Aucun résultat de recherche 🤔</div>
        </main>
        <aside class="py-2 px-4 container">
            <div>
                <h5>Filtrer</h5>
                <label class="sr-only" for="search-card">Name</label>
                <input type="text" class="form-control" id="search-card" placeholder="Recherche...">
            </div>
            <div class="mt-3">
                <div class="form-group row">
                    <div class="col-6 custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="show-black" checked>
                        <label class="custom-control-label" for="show-black">Carte noire</label>
                    </div>
                    <div class="col-6 custom-control custom-checkbox">
                        <input type="checkbox" class="form-control custom-control-input" id="show-white" checked>
                        <label class="custom-control-label" for="show-white">Carte blanche</label>
                    </div>
                </div>
            </div>
            <div class="my-1">
                <h6>Packs</h6>
                <div id="select-packs" class="form-group row">
                </div>
            </div>
            <div id="card-create" class="my-2">
                <h5>Créer une carte</h5>
                <div class="row">
                    <div class="col-4 custom-control custom-radio">
                        <input type="radio" id="create-white" name="card-create" class="custom-control-input" value="W0">
                        <label class="custom-control-label" for="create-white">Blanche</label>
                    </div>
                    <div class="col-4 custom-control custom-radio">
                        <input type="radio" id="create-black-1" name="card-create" class="custom-control-input" value="B1">
                        <label class="custom-control-label" for="create-black-1">Noire 1</label>
                    </div>
                    <div class="col-4 custom-control custom-radio">
                        <input type="radio" id="create-black-2" name="card-create" class="custom-control-input" value="B2">
                        <label class="custom-control-label" for="create-black-2">Noire 2</label>
                    </div>
                </div>
                <div id="card-create-container" class="row mt-2 hidden" style="align-items: end">
                    <div class="card card-white m-0 col-6">
                        <img class="card-icon card-icon-dark hidden" src="img/imac-uni-darkblue.svg">
                        <img class="card-icon card-icon-light hidden" src="img/imac-uni-white.svg">
                        <p id="card-create-content" class="card-content card-content-editable" contenteditable>L'école de mes rêves alliant 🎨 et 🧪.</p>
                        <span class="card-author"></span>
                    </div>
                    <div class="col-6 mt-3">
                        <button id="btn-card-create" class="btn btn-primary">Créer</button>
                    </div>
                </div>
            </div>
            <div id="card-edit" class="my-3">
                <h5>Modifier ma carte</h5>
                <div id="card-edit-info">Sélectionne une de tes cartes 🙃</div>
                <div id="card-edit-container" class="row hidden" style="align-items: end">
                    <div class="card card-white m-0 col-6">
                        <img class="card-icon card-icon-dark hidden" src="img/imac-uni-darkblue.svg">
                        <img class="card-icon card-icon-light hidden" src="img/imac-uni-white.svg">
                        <p id="card-edit-content" class="card-content card-content-editable" contenteditable></p>
                        <span class="card-author"></span>
                    </div>
                    <div class="col-6 mt-3">
                        <button id="card-edit-submit" class="btn btn-primary mr-2">Éditer</button>
                        <button id="card-edit-delete" class="btn btn-danger">&times;</button>
                    </div>
                </div>
            </div>
        </aside>

    </div>

    <?php require_once('views/includes_after_body.php'); ?>

    <script src="js/CardsManager.js"></script>
    <script src="js/manager.js"></script>
</body>

</html>