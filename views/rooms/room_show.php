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
            
<!-- Formulaire -->
<!-- method="POST" redirection au controller 'detail' et methode 'newDetail' -->
            <form method="POST" action="<?= addLink('detail','newDetail'); ?>">
                <input type="hidden" name="id_room" value="<?= $rooms->getId_room() ?>">
                <input type="hidden" name="price" value="<?= $rooms->getPrice() ?>">
                <!-- <input type="hidden" name="booking_start_date" value="<?= date('Y-m-d') ?>"> -->
                <!-- <input type="hidden" name="booking_end_date" value="<?= date('Y-m-d', strtotime('+1 day')) ?>"> -->
                <?php 
                // d_die($rooms)
                ?>

<!-- Par défaut, la date de début est définie sur la date actuelle  -->
                <div class="formBooking form-group col-md-3 m-auto">
                    <label class="stD bg-black link-light">Début Date :</label>
                    <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="booking_start_date" value="<?= date('Y-m-d') ?>" >
                </div>
<!-- et la date de fin est définie sur le jour suivant -->
                <div class="formBooking form-group col-md-3 m-auto mt-2">
                    <label class="edD bg-black">Fin Date :</label>
                    <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="booking_end_date" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                </div>

                <a href="<?= ROOT ?>" class="btn btn-outline-light fw-bolder m-lg-3 mt-3">
                <i class="fa fa-home"></i> Retour à l'accueil
                </a>
               
                <button class="btn btn-primary fw-bolder mt-3" type="submit" name="passerLaCommande">Passer la commande</button>
            </form>
        </div>
    </div>
</div>



