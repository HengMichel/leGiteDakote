<?php 
require "views/errors_form.php";
// var_dump($room_imgs)
?>
<form  method="post">

    <div class="img_room border border-3 border-warning">
        <img src="<?= UPLOAD_CHAMBRES_IMG . $room_imgs; ?>" class="card-img-top img-fluid" alt="image">
        <p class="descrip bg-success link-light m-0 lead fw-medium">&nbsp;&nbsp; Magnifique chambre très spacieuse pouvant recevoir 4 personnes , lit parapluie et chaise haute disponible sur demande </p>
    </div>
   
    <div class="form-group link-warning fw-medium justify-content-md-center mt-5">

    <!-- Ajout d'une valeur cachée pour room_imgs dans le formulaire :
    Ajout d'un champ caché (input type="hidden") pour stocker la valeur de $room_imgs. Ainsi, cette valeur sera conservée lors de la soumission du formulaire. -->
        <input type="hidden" name="room_imgs" value="<?= $room_imgs ?>">
        <input type="hidden" name="room_id" value="<?= $bookings->getRoom_id() ?>">
        <input type="hidden" name="price" value="<?= $bookings->getBooking_price() ?>">
        <input type="hidden" name="booking_state" value="<?= $bookings->getBooking_state() ?>">
     
        <div class="row">
            <div class="form-group link-warning fw-medium col-3">
                <label class="stD bg-black">Début Date :</label>
                <input type="date" class="form-control bg-success-subtle border-success border-4 fw-medium mt-3" name="booking_start_date" value="<?= $bookings->getBooking_start_date() ?>" >
            </div>
            <div class="form-group link-warning fw-medium col-3">
                <label class="edD bg-black">Fin Date :</label>
                <input type="date" class="form-control bg-success-subtle border-4 border-success mt-3 fw-medium" name="booking_end_date" value="<?= $bookings->getBooking_end_date() ?>">
            </div>
        </div>
        <div class="form-group link-warning fw-medium col-3 mt-3">
            <button type="submit" name="book" class="btn bg-warning fw-bolder border-black border-2">Je réserve</button>
        </div>
    </div>
</form>
