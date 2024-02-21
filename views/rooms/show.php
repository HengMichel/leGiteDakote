<div class="container5 container">
    <div class="img_room border">
 
        <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" class="card-img-top" alt="image">
            <p class="descrip bg-success link-light m-0 fw-medium">&nbsp;&nbsp; Magnifique chambre très spacieuse pouvant recevoir 4 personnes , lit parapluie et chaise haute disponible sur demande </p>
    </div>
    <div class="card-body bg-dark">
        <p class="card-text fa-2x fw-medium link-light m-lg-3"><?= $rooms->getPrice() ?>€ / nuit</p>
        <p class="card-text link-warning fa-xl fw-medium m-lg-3"><?= $rooms->getCategory() ?></p>
        <p class="card-text fw-medium link-light m-lg-3"><?= $rooms->getPersons() ?> Persons</p>        
    </div>
    <div class="bou bg-dark">
        <form method="POST" action="<?= addLink('bookings', 'newBookings'); ?>">
            <input type="hidden" name="room_id" value="<?= $rooms->getId_room() ?>">
            <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>">
<?php 
// d_die($rooms)
?>

            <a href="<?= ROOT ?>" class="btn btn-outline-light fw-bolder m-lg-3">
            <i class="fa fa-home"></i> Retour à l'accueil
            </a>
            
            <button class="btn btn-outline-warning fw-bolder" type="submit" name="submit">Passer la commande</button>

        </form>
        <div class="d-flex bg-dark">
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