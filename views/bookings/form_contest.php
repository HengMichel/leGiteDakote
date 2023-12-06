<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>

<div class="container">
    <h1 class="m-5 link-warning">Ajouter un match</h1>
    <form method="post">
        <div class="row">
            <div class="form-group link-warning col-2 mb-3">
                <label class="m-2 link-warning">Game Id :<sup>*</label>
                <input type="text" class="form-control text-uppercase border-warning border-3 mt-2 link-black" name="game_id" value="<?= !empty($contest) ? $contest->getGame_id() : "" ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
    
            <div class="form-group col-2 mb-3">
                <label class="m-2 link-warning">Date de démarrage :<sup>*</sup></label><?php
                    $startDateValue = !empty($contest) ? $contest->getStart_date() : "";
                    $formattedStartDate = !empty($startDateValue) ? (new DateTime($startDateValue))->format('Y-m-d') : "";
                        ?>
                <input type="date" class="form-control text-uppercase border-warning border-3 mt-2 link-black" name="start_date" value="<?= $formattedStartDate ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>

    
            <div class="form-group col-2 mb-3">
                <label class="m-2 link-warning">Winner id :<sup>*</label>
                <input type="number" class="form-control text-uppercase border-warning border-3 mt-2 link-black" name="winner_id" value="<?= !empty($contest) ? $contest->getWinner_id() : "" ?>"
                <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
    
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" id="bouton" class="btn btn-primary mt-5 align-self-sm-baseline fw-medium" name="submit">            
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
            </button>
            <a href="<?= addLink("contest","newContest") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium mx-xl-auto">Annuler</a>
        </div>
    </form>
</div>
