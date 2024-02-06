<form method="POST" action="<?= addLink("home", "list") ?>" id="form">
    <label for="category"  class="cate link-warning fw-bolder bg-black">Choisir une catégorie
    </label>
    <div class="row">           
        <select class="form-select-sm col-3 mt-1 m-2 border-warning border-4" name="choix" id="category">
            <option>...</option>
            <option value="classic" class="classic fw-bolder">Classic
            </option>
            <option value="piscine" class="piscine fw-bolder">Piscine
            </option>
            <?php
            foreach ($json as $category) {
                echo "<option>{$category['category']}</option>";
            }
            ?>  
        </select>
    </div>
</form>

<hr>
<div id="resultat" class="result container d-flex flex-wrap justify-content-around"></div>

<div class="d-flex flex-wrap justify-content-around">
    <?php foreach($roomss as $rooms) : ?>
        <form method="POST" action="<?= addLink("bookings", "newBookings") ?>">
            <input type="hidden" name="room_id" value="<?= $rooms->getId_room() ?>">
            <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>">
            <input type="hidden" name="room_imgs" value="<?= $rooms->getRoom_imgs() ?>">

            <div class="card border-light border-3 mt-5" style="width: 22rem;">

                <div class="img_room">
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" 
                    class="card-img-top" alt="image">
                </div>
                <div class="card-body bg-dark">
                    <p class="card-text fa-2x fw-medium link-light"><?= $rooms->getPrice() ?>€/nuit</p>
                    <p class="card-text link-warning fa-xl fw-medium"><?= $rooms->getCategory() ?></p>
                    <p class="card-text fw-medium link-light"><?= $rooms->getPersons() ?> Persons</p>

                    <button type="submit" class="btn bg-warning fw-bolder border-black border-2">En savoir plus</button>
                </div>
            </div>
        </form>
    <?php endforeach; ?>
</div>
