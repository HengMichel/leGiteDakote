<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5">
    <form method="POST" enctype="multipart/form-data" action="<?= addLink("admin", "rooms", "updateRoom", $room->getId_room()) ?>">
        <input type="hidden" name="id" value="<?= $room->getId_room() ?>">
        <div class="row">
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" id="roomNumberInput" class="form-control bg-dark link-light" name="room_number" value="<?= $room->getRoom_number() ?>">
                    <label for="roomNumberInput">Chambre n°</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" id="priceInput" class="form-control bg-dark link-light" name="price" value="<?= $room->getPrice() ?>">
                    <label for="priceInput">Prix</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="number" id="personsInput" class="form-control bg-dark link-light" name="persons" value="<?= $room->getPersons() ?>">
                    <label for="personsInput">Capacité</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <select id="categorySelect" name="category">
                        <option value="classic" <?= $room->getCategory() == 'classic' ? 'selected' : '' ?>>Classic</option>
                        <option value="piscine" <?= $room->getCategory() == 'piscine' ? 'selected' : '' ?>>Piscine</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="file" id="roomImgsInput" class="bg-dark" name="room_imgs">
                </div>
            </div>
            <div class="form-group mt-4 text-center">
                <button type="submit" class="btn bg-primary link-light border">Modifier la chambre</button>
            </div>
        </div>
    </form>
</div>
