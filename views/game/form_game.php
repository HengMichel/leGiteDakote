<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>

<div class="container">
    <h1 class="m-5 link-warning">Ajouter une Game</h1>
    <form method="post">
        <div class="row">
            <div class="form-group mb-3">
                <label class="m-2 link-warning ">Titre du Game :<sup>*</sup></label>
                <input type="text" class="form-control text-uppercase border-warning border-3" name="title" id="title" value="<?= $game->getTitle() ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
    
            <div class="form-group col-6 mb-3">
                <label class="m-2 link-warning">Min player :<sup>*</sup></label>
                <input type="number" class="form-control text-uppercase border-warning border-3" name="min_players" id="min_players" value="<?= $game->getMin_players()?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
    
            <div class="form-group col-6 mb-3">
                <label class="m-2 link-warning">Max player :<sup>*</sup></label>
                <input type="number" class="form-control text-uppercase border-warning border-3" name="max_players" id="max_players" value="<?= $game->getMax_players() ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
        </div>
        <div class="d-flex justify-content-between">

            <button type="submit" id="bouton" class="btn btn-primary mt-5 align-self-sm-baseline fw-medium" name="submit"> 
                <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
            </button>
            <a href="<?= addLink("Game") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
        </div>
    </form>
</div>
