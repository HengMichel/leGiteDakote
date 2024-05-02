<div id="resultat" class="result container flex-wrap mt-4">
    <form method="POST" action="<?= addLink("home", "list") ?>" id="form">
        <div class="row">           
            <select class="form-select-sm m-auto col-auto border-2 border-primary" name="choix" id="category">
                <option class="choisir fw-medium">Choisir une catégorie</option>
                <option value="classic" class="classic fw-medium ">Classic
                </option>
                <option value="piscine" class="piscine fw-medium ">Piscine
                </option>
                <?php
                foreach ($json as $category) 
                {
                    echo "<option>{$category['category']}</option>";
                }
                ?>  
            </select>
        </div>
    </form>
    <div class="d-flex flex-wrap justify-content-around mt-2" id="roomsContainer">
        <?php foreach($roomss as $rooms) : ?>
        <div class="card mt-5" style="width: 22rem;">
            <div class="img_room">
                <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" 
                class="card-img-top" alt="image">
            </div>
            <div class="card-body bg-dark">
                <p class="card-text fa-2x fw-medium link-light"><?= $rooms->getPrice() ?>€/nuit</p>
                <p class="card-text link-warning fa-xl fw-medium"><?= $rooms->getCategory() ?></p>
                <p class="card-text fw-medium link-light"><?= $rooms->getPersons() ?> Personnes</p>
                <a href="<?= addLink("rooms", "show", $rooms->getId_room()) ?>" class="btn btn-outline-light fw-bolder">En savoir plus</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
