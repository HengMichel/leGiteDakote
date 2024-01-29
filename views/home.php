<div class="d-flex flex-wrap justify-content-around">
    <?php foreach($roomss as $rooms) : ?>
    <!-- ancienne version -->
    <!-- <div class="card border-warning border-2 mb-5 fa-beat-fade" style="width: 20rem;"> -->
    <div class="card border-light border-2 mt-5" style="width: 22rem;">
    
        <div class="img_room">
            <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" 
            class="card-img-top" alt="image">
        </div>
        <div class="card-body bg-dark">
            <p class="card-text fa-2x fw-medium link-light"><?= $rooms->getPrice() ?>€/nuit</p>
            <p class="card-text link-warning fa-xl fw-medium"><?= $rooms->getCategory() ?></p>
            <p class="card-text fw-medium link-light"><?= $rooms->getPersons() ?> Persons</p>
           
            <div class="">
                <a href="<?= addLink("rooms", "show", $rooms->getId_room()); ?>" class="btn bg-warning fw-bolder border-black border-2">En savoir
                    plus
                </a>
                <div id="<?= $rooms->getId_room(); ?>" class="add_cart btn bg-success fw-medium link-light border-black border-2">Ajouter au Panier
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
</div>

<script>
$(document).ready(function() {
    addToCartAjax();
});

</script>
