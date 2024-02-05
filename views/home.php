
    <form method="POST" action="<?= addLink("home", "list") ?>" id="form">
        <label for="category">Choisir une catégorie</label>
        <select name="choix" id="category">
            <option>...</option>
            <option value="classic">Classic</option>
            <option value="piscine">Piscine</option>
            <?php
            foreach ($json as $category) {
                echo "<option>{$category['category']}</option>";
            }
            ?>
        </select>
    </form>
<hr>
<div id="resultat"></div>



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
