<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container ">
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
<!-- ############## a finir a partie d'ici faire comme en haut ########################################################## -->
                <div class="form-group col-md-3">
                    <label class="ps bg-black link-light mt-3 fw-semibold">Persons :</label>
                    <input type="number" class="form-control mt-3 border bg-dark fw-medium" name="person"value="<?= $rooms->getPersons() ?>" >
                </div>

                <div class="form-group col-md-3">
                    <label class="cate bg-black link-light mt-3 fw-semibold">Category :</label>
                    <select name="category" class="form-control mt-3 border fw-medium link-liht bg-dark" value="<?= $rooms->getCategory() ?>">
                        <option value="">Choose category</option>
                        <option value="classic">Classic</option>
                        <option value="piscine">Piscine</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label class="pho bg-black link-light mt-3 fw-semibold">Photo :</label>
                    <input type="file" class="form-control mt-3 border fw-medium link-dark bg-dark" name="image"value="<?= $rooms->getRoom_imgs() ?>">
                </div>
            </div>
        </div>      
        <button type="submit" id="bouton" class="btn bg-light mt-5 mb-5 link-success border-primary border-2 fw-bolder" name="add_room" value="submit"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
        <a href="<?= addLink("admin","rooms/newRooms") ?>" class="btn bg-success mt-5 mb-5 link-light border-light border-2 fw-bolder">Annuler</a>
    </form>   
</div>
