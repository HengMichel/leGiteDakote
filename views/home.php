<div class="row">
    <?php foreach ($roomss as $rooms) : ?>
    <div class="col-4 mt-3">
        <div class="card  position-relative pb-3">
            <div>
                <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" class="card-img-top"
                    alt="<?= substr($rooms->getTitle(), 0, 10); ?>" style=" box-shadow: 0 0 10px 5px rgba(255,
                    255, 255, 0.04), 0 0 10px 5px rgba(255, 255, 255, 0.04); text-align: center;" />
            </div>

            <div class="card-body">
                <h6 class="card-title"><?= substr($rooms->getTitle(), 0, 50) . " ..."; ?></h6>
                <p class="card-text"><?= $rooms->getPrice(); ?></p>

            </div>
            <div class="">
                <a href="<?= addLink('rooms', 'show', $rooms->getId_room()); ?>" class="btn btn-secondary">En savoir
                    plus
                </a>
                <div id="<?= $rooms->getId_room(); ?>" class="add_cart btn btn-primary">Ajouter
                    au
                    Panier</div>
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