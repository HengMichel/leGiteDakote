<?php 
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">
        <div class="row">
            <div class="form-group link-warning fw-medium d-flex justify-content-md-center mt-5">
                <div class="form-group link-warning fw-medium col-3">
                    <label class="stD bg-black">Start Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-success border-4 fw-medium mt-3" name="booking_start_date" value="<?= $bookings->getBooking_start_date() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
                </div>
                <div class="form-group link-warning fw-medium col-3">
                    <label class="edD bg-black">End Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-4 border-success mt-3 fw-medium" name="end_date" value="<?= $bookings->getBooking_end_date() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
                </div>
                <button type="submit"  class="btn bg-success link-warning border-warning border-4 fw-medium mt-sm-auto" name="book"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button><a href="<?= addLink("bookings","newBookings") ?>"></a>
            </div>
        </div>
    </form>
</div>
