<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";

?>
<div class="container">
    <h1 class="m-5 link-warning">Dashboard Admin</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="border-warning border-3 link-warning bg-black">Ajouter une chambre</th>
                <th class="border-warning border-3 link-warning bg-black">la liste des chambres</th>
                <th class="border-warning border-3 link-warning bg-black">la liste des réservations</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-warning border-3 link-warning bg-black fw-medium">
                <button class="btn btn-warning bg-warning fw-bolder"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
                <a href="<?= addLink("rooms/newRooms") ?>" class="btn mt-5 mb-5 link-light fw-medium border border-warning">Annuler</a>
                </td>
                <td class="border-warning border-3 link-warning bg-black fw-medium">
                <button class="btn btn-warning bg-warning fw-bolder"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
                <a href="<?= addLink("rooms/list") ?>" class="btn mt-5 mb-5 link-light fw-medium border border-warning">Annuler</a>
                </td>
                <td class="border-warning border-3 link-warning bg-black fw-medium">
                <button class="btn btn-warning bg-warning fw-bolder"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
                <a href="<?= addLink("bookings/list") ?>" class="btn mt-5 mb-5 link-light fw-medium border border-warning">Annuler</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>