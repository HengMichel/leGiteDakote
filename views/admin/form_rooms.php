<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-dark link-light" placeholder="N° chambre" name="room_number" value="<?= $rooms->getRoom_number() ?>">
                    <label>N° chambre</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="text" class="form-control border bg-dark link-light" placeholder="Prix de la chambre" name="room_price" value="<?= $rooms->getPrice() ?>">
                    <label>Prix de la chambre</label>
                </div>
            </div>

            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="number" class="form-control  border bg-dark link-light" placeholder="Pour 4 persoones max" name="person"value="<?= $rooms->getPersons() ?>" >
                    <label>Pour 4 persoones max</label>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <select name="category" class="border border-3 link-light bg-dark" value="<?= $rooms->getCategory() ?>">
                        <option value="">Choisir la catégorie</option>
                        <option value="classic">Classic</option>
                        <option value="piscine">Piscine</option>
                    </select>
                </div>
            </div>
            <div class="form-group mt-4">
                <div class="form-floating col-md-6 m-auto">
                    <input type="file" class=" border border-primary-subtle border-3 link-light bg-primary" name="image"value="<?= $rooms->getRoom_imgs() ?>">
                </div>
            </div>
        </div>
        <div class="form-group mt-4 text-center">

            <button type="submit" id="bouton" class="btn bg-primary link-light border" name="add_room" value="submit">Ajouter
            </button>
        </div>
    </form>   
</div>
