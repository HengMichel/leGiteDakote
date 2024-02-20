<?php 
require "views/errors_form.php";
?>
<div class="container5 link-warning fw-medium mt-5">
    <form  method="post">

<!-- Ajout d'une valeur cachée pour room_imgs dans le formulaire :
        Ajout d'un champ caché (input type="hidden") pour stocker la valeur de $room_imgs. Ainsi, cette valeur sera conservée lors de la soumission du formulaire. -->
            <input type="hidden" name="room_imgs" value="<?= $room_imgs ?>">

            <input type="hidden" name="room_id" value="<?= $bookings->getRoom_id() ?>">
    <?php 
// d_die($bookings)
    ?>

            <input type="hidden" name="price" value="<?= $bookings->getBooking_price() ?>">
    <?php 
// d_die($bookings)
    // ?>

            <input type="hidden" name="booking_state" value="<?= $bookings->getBooking_state() ?>">
    <?php 
// d_die($bookings)
    ?>     
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
        
                <button type="submit" name="book" class="btn btn-outline-warning fw-bolder border-dark-subtle border-3 mt-5">Je réserve   
                </button>
        </div>
    </form>
</div>

<!-- <td class="dashboard2 border-warning border-3 bg-success-subtle fw-medium link-dark">

            <a href="<?= addLink("users","dashUsers") ?>" class="btn btn-outline-warning  link-success fw-bolder">dashboard

          </td> -->
