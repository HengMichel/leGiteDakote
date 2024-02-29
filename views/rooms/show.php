<div class="container">
    <div class="card-body bg-dark text-center m-0 border">
        <div class="img_room border">
            <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" class="card-img-top" alt="image">
            <p class="descrip bg-success link-light text-center fw-medium m-0">Magnifique chambre très spacieuse pouvant recevoir 4 personnes , lit parapluie et chaise haute disponible sur demande </p>
        </div>
        <p class="card-text fa-2x fw-medium link-light m-lg-3 mt-4"><?= $rooms->getPrice() ?>€ / nuit</p>
        <p class="card-text link-warning fa-xl fw-medium m-lg-3 mt-2"><?= $rooms->getCategory() ?></p>
        <p class="card-text fw-medium link-light m-lg-3"><?= $rooms->getPersons() ?> Personnes
        </p>        
        <div class="bou bg-dark p-3">
            <!-- <form method="POST" action="<?= addLink('bookings', 'newBookings'); ?>"> -->
            <form method="POST" action="<?= addLink('cart','showForm'); ?>">
                <input type="hidden" name="room_id" value="<?= $rooms->getId_room() ?>">
                <!-- <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>"> -->
                <?php 
                // d_die($rooms)
                ?>
                <a href="<?= ROOT ?>" class="btn btn-outline-light fw-bolder m-lg-3">
                <i class="fa fa-home"></i> Retour à l'accueil
                </a>
                <!-- <a href="<?= addLink('cart','showForm'); ?>" class="btn btn-outline-light fw-bolder m-lg-3">
                <i class="fa fa-home"></i> Passer la commande
                </a> -->
                <!-- <button class="btn btn-primary fw-bolder" type="submit" name="submit">Passer la commande</button> -->
            </form>
        </div>
    </div>
</div>





<!-- panier avec ajax pour un site e-commerce -->
<?php
// Récupére la quantité actuelle dans le panier côté serveur
// $quantiteActuelle = $_SESSION["nombre"] ?? 0;

// Stocke cette quantité dans le sessionStorage
// echo "<script>sessionStorage.setItem('cartCount', $quantiteActuelle);</script>";
?>
<script>

    // window.addEventListener("load", () => {

        // Récupére l'ID de la chambre directement du PHP
        // var idRoom = "<?= $rooms->getId_room() ?>";

        // Appelez la fonction qui gère l'ajout au panier
        // addRoomToCartAjax(idRoom)
    // });
</script>