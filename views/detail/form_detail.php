<?php 
require "views/errors_form.php";

// Initialisation du total des prix
$totalPrice = 0.0;

?>
<!-- Affichage du contenu du detail -->
<div class="container5 link-light fw-medium mt-5">
    <table class="table table-hover mt-5 bg-success-subtle">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action bg-secondary link-light m-3 border align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Vérifier si $detail est défini et s'il contient des éléments
            if (!empty($detail)) {
            // d_die($detail);
            ?>
                <tr class="table-active">
                    <input type="hidden" name="id_detail" value="<?= $detail->getId_detail() ?>">
                    <input type="hidden" name="booking_id" value="<?= $detail->getBooking_id() ?>">
                
                    <td class="roomId border bg-secondary-subtle mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= 
                    $detail->getRoom_id() 
                    ?>
                    <?php
                    // d_die($detail);
                    ?>               
                    </td>
                    <td class="booking_start_date bg-secondary-subtle border mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($detail->getBooking_start_date())) ?>
                    </td>
                    <?php
                    // d_die($detail);
                    ?>              
                    <td class="booking_end_date bg-secondary-subtle border mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($detail->getBooking_end_date())) ?>
                    </td>
                    <td class="price bg-secondary-subtle border align-middle fs-5 text-center fw-semibold">
                    <?php 
                    // Vérifie si l'objet $room existe et n'est pas null
                    if ($price !== null) { 
                        echo number_format($price, 2);
                    } else {
                        echo "Prix non disponible";
                    }
                    ?>
                    </td>
                </tr> 
                <?php
            } else { ?>
                <tr>
                    <td colspan='5'>Aucune réservation trouvée.</td>
                </tr>
                <?php 
            } 
                ?> 
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-secondary border-2 border-light mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="3">Total de vos réservations:
                </td>
                <td class="price border-primary border-4 mt-2 alert-link  col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?>
                </td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                <a href="<?= addLink("bookings/newBooking") ?>" class="btn btn-primary">Payer</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
