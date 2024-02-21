<div class="container5 ">

    <table class="table table-hover mt-5 bg-success-subtle">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-success link-warning border-3 border-warning align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date bg-success link-warning border-3 border-warning align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-success link-warning border-3 border-warning align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="state bg-success link-warning border-3 border-warning align-middle fs-5 text-center fw-semibold">Etat</th>
                <th class="price bg-success link-warning border-3 border-warning align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action bg-success link-warning m-3 border-3 border-warning align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
// Initialiser comme un nombre flottant
            $totalPrice = 0.0; 
            if (!empty($findUserBookings)) { 
// d_die($findUserBookings);
                foreach($findUserBookings as $bookings){ 
// d_die($bookings);
            ?>

            <tr class="table-active">
                <td class="idbook border-success-subtle border-3 mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $bookings->getRoom_id() ?>
                </td>
                           
                <?php
// d_die($bookings->getRoom_id() );            
                ?>
                <td class="booking_start_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($bookings->getBooking_start_date())) ?>
                </td>
                <td class="booking_end_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($bookings->getBooking_end_date())) ?></td>
                <td class="booking_state border-success-subtle border-3 mt-2 col-2 align-middle fs-5 text-center fw-semibold"><?= $bookings->getBooking_state() ?>
                </td>
                <td class="booking_price border-success-subtle border-3 mt-2  col-2 align-middle fs-5 text-center fw-semibold"><?= $bookings->getBooking_price() ?>
                </td>
                <?php 
// d_die($bookings);
?>
                <?php
                if ($bookings->getBooking_state() != 'cancel') {
                ?>
                    <a class="canc link-success border-3 border-success-subtle align-middle fs-5 text-center fw-semibold" href="<?= addLink("bookings/cancelBooking", $bookings->getId_booking()) 
                    ?>">Annuler
                    </a>
                <?php                    
                }
                ?>
           
            <?php 
            if ($bookings->getBooking_state() != 'cancel') {

// Convertir le prix en float avant l'addition
                $totalPrice += floatval($bookings->getBooking_price());

// d_die($bookings);
                }
                ?>

                <td class=" m-0 border-success-subtle border-3 mt-2 col-2 align-middle fs-5 text-center fw-semibold">

                    <?php
                    if ($bookings->getBooking_state() != 'cancel') {
                    ?>
                    <a class="canc link-success fw-medium border-3 border-success-subtle" href="<?= addLink("bookings/cancelBooking", $bookings->getId_booking()) 
                    ?>">Annuler</a>
                    <?php
                    } else {
                        ?>
                        <strong class="text-muted">Annulé</strong>
                        <?php
                        }
                    ?>
                </td> 
            </tr>
<?php 
// echo $totalPrice;
                }  
            } 
?> 
        </tbody>
        <tfoot>
             <!-- Affichage du total des prix des réservations -->
            <tr class="table-active">
                <td class="total_reservation border-success border-3 mt-2  alert-link bg-success-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link bg-success-subtle col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-success-subtle border-3 mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                <?php
                    if ($bookings->getBooking_state() != 'cancel') {
                    ?>
                    <a class="payBooking link-success fw-medium border-3 border-success-subtle" href="<?= addLink("bookings/updateBooking", $bookings->getId_booking()) 
                    ?>">Payer</a>
                    <?php
                    } else {
                        ?>
                        <strong class="text-muted align-middle fs-5 text-center fw-semibold">A payer</strong>
                        <?php
                        }
                    ?>
                </td> 
            </tr>
        </tfoot>
    </table>
</div>
