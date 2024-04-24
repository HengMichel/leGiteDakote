<?php 
if (isset($_SESSION['error'])) 
{
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    // Effacer le message d'erreur de la session après l'avoir affiché
    unset($_SESSION['error']); 
}
?>
<div class="container">
    <div class="card-body bg-dark text-center m-0 border w-75 m-auto">
        <div class="img_room border">
            <img src="<?= UPLOAD_CHAMBRES_IMG . $rooms->getRoom_imgs(); ?>" class="card-img-top" alt="image">
            <p class="descrip bg-success link-light text-center fw-medium m-0">Magnifique chambre très spacieuse disposant également de lit parapluie et chaise haute disponible sur demande .</p>
        </div>
        <p class="card-text fa-2x fw-medium link-light m-lg-3 mt-2"><?= $rooms->getPrice() ?>€ / nuit</p>
        <p class="card-text link-warning fa-xl fw-medium m-lg-3 mt-2"><?= $rooms->getCategory() ?></p>
        <p class="card-text fw-medium link-light m-lg-3"><?= $rooms->getPersons() ?> Personnes
        </p>        
        <div class="bou bg-dark p-3">
            <!-- Formulaire method="POST" redirection au controller 'detail' et methode 'newDetail' -->
            <form method="post" action="<?= addLink('cart','addToCart', $rooms->getId_room()); ?>">
                <input type="hidden" name="id_room" value="<?= $rooms->getId_room() ?>">
                <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>">
                <input type="hidden" name="redirect_url" value="<?= $_SERVER['REQUEST_URI'] ?>">
                <div class="calendar text-center">
                <!-- Par défaut, la date de début est définie sur la date actuelle  -->
                    <div class="formBooking form-group col-md-6 m-auto">
                        <label class="stD bg-black link-light">Début Date :</label>
                        <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="booking_start_date" value="<?= date('Y-m-d') ?>" >
                    </div>
                    <!-- et la date de fin est définie sur le jour suivant -->
                    <div class="formBooking form-group col-md-6 m-auto">
                        <label class="edD bg-black">Fin Date :</label>
                        <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="booking_end_date" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    </div>
                </div>
                <a href="<?= ROOT ?>" class="btn btn-outline-light fw-bolder m-lg-3 mt-1">
                <i class="fa fa-home"></i> Retour à l'accueil
                </a>
                <button class="btn btn-primary fw-bolder mt-1" type="submit" name="passerLaCommande">Passer la commande</button>
            </form>
        </div>
    </div>
</div>



