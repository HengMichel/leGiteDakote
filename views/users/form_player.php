<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>

<div class="container">
    <h1 class="m-5 link-warning">Ajouter un joueur</h1>
    <form method="post">
        <div class="row">
            <div class="form-group  mb-3 link-warning col-6">
                <label for="email" class="m-2">Email :<sup>*</sup></label>
                <input type="email" class="form-control border-warning border-3 mt-2 link-black"  name="email" id="email" value="<?= $player->getEmail() ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            
            <div class="form-group col-6 mb-3">
                <label for="nickname" class="m-2 link-warning">Nickname :<sup>*</sup></label>
                <input type="text" class="form-control text-uppercase  border-warning border-3 mt-2 link-black"  name="nickname" id="nickname"  value="<?= $player->getNickname() ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary mt-5 align-self-sm-baseline fw-medium" name="submit">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
            </button>
            <a href="<?= addLink("player") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
        </div>
    </form>
</div>
