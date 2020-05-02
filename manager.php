<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('views/includes_before_body.php'); ?>
    <link rel="stylesheet" href="css/manager.css">
    <title>Manager · Limite Limac</title>
</head>

<body id="manager">
    <main>
        <div id="card-panel"></div>
        <div id="info" class="m-4 hidden">Aucun résultat de recherche :(</div>
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
        <div class="my-4">
            <h5>Créer une carte</h5>
            <div class="row">
                <div class="col-6 custom-control custom-radio">
                    <input type="radio" id="create-white" name="create" class="custom-control-input">
                    <label class="custom-control-label" for="create-white">Blanche</label>
                </div>
                <div class="col-6 custom-control custom-radio">
                    <input type="radio" id="create-black" name="create" class="custom-control-input">
                    <label class="custom-control-label" for="create-black">Noire</label>
                </div>
            </div>
            <div class="row mt-2" style="align-items: end">
                <div class="card card-white m-0 col-6">
                    <img class="card-icon" src="img/imac-uni-darkblue.svg">
                    <p class="card-content card-content-editable" contenteditable>L'école de mes rêves alliant 🎨 et 🧪.</p>
                    <span class="card-author"></span>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary">Créer</button>
                </div>
            </div>
        </div>
        <di  class="my-4">
            <h5>Modifier ma carte</h5>
            <div class="row" style="align-items: end">
                <div class="card card-white m-0">
                    <img class="card-icon" src="img/imac-uni-darkblue.svg">
                    <p class="card-content card-content-editable" contenteditable></p>
                    <span class="card-author"></span>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary mr-2">Éditer</button>
                    <button class="btn btn-danger">&times;</button>
                </div>
            </div>
        </div>
        <!--<div>
            <h5 class="mt-4">Créer un bundle</h5>

            <select id="select-packs" multiple>
                <option value="1">IMAC Vie</option>
                <option value="2">Pouloulou</option>
                <option value="3">Le Sel Pack</option>
                <option value="4">Damn boi</option>
                <option value="5">Trashtalk</option>
            </select>
        </div>-->
    </aside>
    <?php require_once('views/includes_after_body.php'); ?>

    <script src="js/CardsManager.js"></script>
    <script src="js/manager.js"></script>
</body>

</html>