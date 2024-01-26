<div class="container5 container">

    <div class="img_room border border-3 border-warning">
 
        <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" class="card-img-top" alt="image">
            <p class="descrip bg-success link-light m-0 lead fw-medium">&nbsp;&nbsp; Magnifique chambre très spacieuse pouvant recevoir 4 personnes , lit parapluie et chaise haute disponible sur demande </p>
    </div>
    <div class="card-body bg-dark">
        <p class="card-text fa-2x fw-medium link-light m-lg-3"><?= $rooms->getPrice() ?>€/nuit</p>
        <p class="card-text link-warning fa-xl fw-medium m-lg-3"><?= $rooms->getCategory() ?></p>
        <p class="card-text fw-medium link-light m-lg-3"><?= $rooms->getPersons() ?> Persons</p>        
    </div>
    <div class="bou bg-dark">
        <input name="qte" type="number" class="m-lg-3 form-control-lg" value="1" id="field<?= $rooms->getId_room() ?>">
        <button class="btn btn-warning bg-warning m-lg-3" id="form<?= $rooms->getId_room() ?>">
            <i class="fa fa-cart-arrow-down"></i>
        </button>

        
        <div class="d-flex bg-dark">
            <a href="<?= ROOT ?>" class="btn bg-warning fw-bolder m-lg-3">
            <i class="fa fa-home"></i> Retour à l'accueil
            </a>
            <a href="<?= addLink('cart','buy', $rooms->getId_room()); ?>" class="btn bg-success link-light fw-bolder m-3">
            <i class="fa fa-shopping-cart"></i> Passer la commande
            </a>
        </div>
    </div>
    
    <script>
    window.addEventListener("load", () => {
        var idRoom = "<?= $rooms->getId_room() ?>";

        console.log("idRoom in client-side script:", idRoom);

        addRoomsToCartAjax(idRoom)
    });
    </script>
</div>
