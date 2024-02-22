<?php 
require "views/errors_form.php";
?>
<div class="container5 link-light fw-medium mt-5">
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
                <div class="form-group col-3 m-auto">
                    <label class="stD bg-black link-light">Début Date :</label>
                    <input type="date" class="form-control bg-light border fw-bolder mt-3 border border-3 border-black" name="booking_start_date" value="<?= $bookings->getBooking_start_date() ?>" >
                </div>
                <div class="form-group col-3 m-auto">
                    <label class="edD bg-black">Fin Date :</label>
                    <input type="date" class="form-control bg-light border mt-3 fw-bolder border-3 border-black" name="booking_end_date" value="<?= $bookings->getBooking_end_date() ?>">
                </div>
            </div>
            <div class="form-group mt-4 col-md-3 m-auto bg-dark">
                <button type="submit" name="book" class="btn btn-primary fw-bolder border-2 container">Je réserve   
                </button>
            </div>
        </div>
    </form>
</div>

<!-- <td class="dashboard2 border-warning border-3 bg-success-subtle fw-medium link-dark">

            <a href="<?= addLink("users","dashUsers") ?>" class="btn btn-outline-warning  link-success fw-bolder">dashboard

          </td> -->
