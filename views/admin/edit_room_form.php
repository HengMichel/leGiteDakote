<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5">
    <form method="POST" enctype="multipart/form-data" action="<?= addLink("admin/rooms/updateRoom", $rooms->getId_room()) ?>">
        <input type="hidden" name="id" value="<?= $rooms->getId_room() ?>">
        <div class="row">
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="number" id="roomNumberInput" class="form-control bg-dark link-light" placeholder="N° chambre" name="room_number" value="<?= $rooms->getRoom_number() ?>">
                    <label for="roomNumberInput">N° Chambre</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="number" id="priceInput" class="form-control bg-dark link-light" placeholder="Prix de la chambre" name="price" value="<?= $rooms->getPrice() ?>">
                    <label for="priceInput">Prix de la chambre</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="number" id="personsInput" class="form-control bg-dark link-light" placeholder="Nombre de personnes max" name="persons" value="<?= $rooms->getPersons() ?>">
                    <label for="personsInput">Nombre de personnes max</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <select name="category" value="<?= $rooms->getCategory() ?>">
                        <option value="">Choisir la catégorie</option>
                        <option value="classic">Classic</option>
                        <option value="piscine">Piscine</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="file" class="room_imgs bg-dark" name="room_imgs">
                </div>
            </div>
            <div class="form-group mt-4 text-center">
                <button type="submit" id="bouton" class="btn bg-primary link-light border" name="add_room" value="submit">Valider
                </button>
            </div>
        </div>
    </form>
</div>
