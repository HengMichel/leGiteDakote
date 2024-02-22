<div id="resultat" class="result container d-flex flex-wrap justify-content-around">

    <form method="POST" action="<?= addLink("home", "list") ?>" id="form">
        <div class="row">           
            <select class="form-select-sm border border-dark border-5" name="choix" id="category">
                <option class="choisir fw-medium">Choisir une catégorie</option>
                <option value="classic" class="classic fw-medium ">Classic
                </option>
                <option value="piscine" class="piscine fw-medium ">Piscine
                </option>
                <?php
                foreach ($json as $category) {
                    echo "<option>{$category['category']}</option>";
                }
                ?>  
            </select>
        </div>
    </form>

    <div class="d-flex flex-wrap justify-content-around" id="roomsContainer">
        <?php foreach($roomss as $rooms) : ?>
            <form method="POST" action="<?= addLink("rooms", "show", $rooms->getId_room()) ?>">
                <input type="hidden" name="room_id" value="<?= $rooms->getId_room() ?>">
                <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>">
                <input type="hidden" name="room_imgs" value="<?= $rooms->getRoom_imgs() ?>">
<?php 
// d_die($rooms);
?>
                <div class="card border border-2 mt-5" style="width: 22rem;">

                    <div class="img_room">
                        <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" 
                        class="card-img-top" alt="image">
                    </div>
                    <div class="card-body bg-dark">
                        <p class="card-text fa-2x fw-medium link-light"><?= $rooms->getPrice() ?>€/nuit</p>
                        <p class="card-text link-warning fa-xl fw-medium"><?= $rooms->getCategory() ?></p>
                        <p class="card-text fw-medium link-light"><?= $rooms->getPersons() ?> Persons</p>

                        <button type="submit" class="btn btn-outline-light fw-bolder border">En savoir plus</button>
                    </div>
                </div>
            </form>
        <?php endforeach; ?>
    </div>
</div>
