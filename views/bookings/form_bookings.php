<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<?php
// Récupérer les paramètres GET
$room_id = $_GET['room_id'] ?? null;
$price = $_GET['price'] ?? null;
$room_imgs = $_GET['room_imgs'] ?? null;
?>
<div class="container5 container">
    <form method="post">

        <div class="img_room border border-3 border-warning">
            <img src="/leGiteDakote/public/assets/imgs/chambres/<?= $room_imgs ?>" class="card-img-top img-fluid" alt="image">
            <p class="descrip bg-success link-light m-0 lead fw-medium">&nbsp;&nbsp; Magnifique chambre très spacieuse pouvant recevoir 4 personnes , lit parapluie et chaise haute disponible sur demande </p>
        </div>

        <div class="form-group link-warning fw-medium justify-content-md-center mt-5">
            <div class="row">
                <div class="form-group link-warning fw-medium col-3">
                    <label class="stD bg-black">Start Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-success border-4 fw-medium mt-3" name="booking_start_date" value="<?= $bookings->getBooking_start_date() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
                </div>
                <div class="form-group link-warning fw-medium col-3">
                    <label class="edD bg-black">End Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-4 border-success mt-3 fw-medium" name="booking_end_date" value="<?= $bookings->getBooking_end_date() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
                </div>
            </div>

            <?php  
            // if (isset($_POST['booking_start_date']) && isset($_POST['booking_end_date'])) {

            // echo "Start Date: " . $_POST['booking_start_date'] . "<br>";
            // echo "End Date: " . $_POST['booking_end_date'] . "<br>";

             // Définir le prix de la chambre directement ici
            //  $booking_price = $room->getPrice();
            //     }
            ?>

            <!-- Champ hidden pour le prix -->
            <input type="hidden" name="booking_price" value="<?= $booking_price ?? '' ?>">

            <!-- Champ pour booking_state avec la valeur par défaut "in progress" -->
            <!-- <input type="hidden" name="booking_state" value="in progress"> -->


            <div class="form-group link-warning fw-medium col-3 mt-3">
                <button type="submit"  class="btn bg-warning link-success border-warning border-2 fw-medium" name="book"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button><a href="<?= addLink("bookings","newBookings") ?>"></a>
            </div>
        </div>
    </form>
</div>
