<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container ">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-3">
                <label class="rN bg-black link-warning mt-3 fw-semibold">Room Number :</label>
                <input type="text" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium"  name="room_number" value="<?= $rooms->getRoom_number() ?>">
            </div>
     
            <div class="form-group col-md-3">
                <label class="rP bg-black link-warning mt-3 fw-semibold">Room Price :</label>
                <input type="text" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium" name="room_price" value="<?= $rooms->getPrice() ?>">
            </div>
     
            <div class="form-group col-md-3">
                <label class="ps bg-black link-warning mt-3 fw-semibold">Persons :</label>
                <input type="number" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium" name="person"value="<?= $rooms->getPersons() ?>" >
            </div>
     
            <div class="form-group col-md-3">
                <label class="cate bg-black link-warning mt-3 fw-semibold">Category :</label>
                <select name="category" class="form-control mt-3 border-success fw-medium border-4 link-dark bg-bg-success-subtle
bg-success-subtle" value="<?= $rooms->getCategory() ?>">
                    <option value="">Choose category</option>
                    <option value="classic">Classic</option>
                    <option value="piscine">Piscine</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="pho bg-black link-warning mt-3 fw-semibold">Photo :</label>
                <input type="file" class="form-control mt-3 border-success border-4 fw-medium link-dark bg-bg-success-subtle
bg-success-subtle" name="image"value="<?= $rooms->getRoom_imgs() ?>">
            </div>
        </div>      
        <button type="submit" id="bouton" class="btn bg-warning mt-5 mb-5 link-success border-primary border-2 fw-bolder" name="add_room" value="submit"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
        <a href="<?= addLink("users") ?>" class="btn bg-success mt-5 mb-5 link-light border-warning border-2 fw-bolder">Annuler</a>
    </form>   
</div>
