<div class="container5 ">
    <table class="table table-hover mt-5 bg-secondary-subtle">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="state bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Etat</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action bg-secondary link-light m-3 border align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
// Initialiser comme un nombre flottant
            $totalPrice = 0.0; 
            if (!empty($findUserBookings)) { 
                // d_die($findUserBookings);
                foreach($findUserBookings as $detail){ 
                // d_die($bookings);
            ?>

            <tr class="table-active">
                <td class="idbook border-secondary-subtle border mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $detail->getRoom_id() ?>
                </td>
                           
                <?php
                // d_die($bookings->getRoom_id() );            
                ?>
                <td class="booking_start_date border-secondary-subtle border mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($detail->getBooking_start_date())) ?>
                </td>
                <td class="booking_end_date border-secondary-subtle border mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($detail->getBooking_end_date())) ?></td>
                <td class="booking_state border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold"><?= $detail->getBooking_state() ?>
                </td>
                <td class="booking_price border-secondary-subtle border mt-2  col-2 align-middle fs-5 text-center fw-semibold"><?= $detail->getBooking_price() ?>
                </td>
                <?php 
                // d_die($bookings);
                ?>
                <?php
                if ($bookings->getBooking_state() != 'cancel') {
                ?>
                    <a class="canc link-secondary border border-secondary-subtle align-middle fs-5 text-center fw-semibold" href="<?= addLink("bookings/cancelBooking", $detail->getId_booking()) 
                    ?>">Annuler
                    </a>
                <?php                    
                }
                ?>
           
            <?php 
            if ($detail->getBooking_state() != 'cancel') {

// Convertir le prix en float avant l'addition
                $totalPrice += floatval($detail->getBooking_price());

                // d_die($bookings);
                }
                ?>

                <td class=" m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">

                    <?php
                    if ($detail->getBooking_state() != 'cancel') {
                    ?>
                    <a class="canc link-secondary fw-medium border border-secondary-subtle" href="<?= addLink("bookings/cancelBooking", $detail->getId_booking()) 
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
                <td class="total_reservation border-secondary border mt-2  alert-link bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link bg-secondary-subtle col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                <?php
// ########   methode a changer
                    if ($detail->getBooking_state() != 'cancel') {
                    ?>   
                    <a class="payBooking link-secondary fw-medium border-3 border-secondary-subtle" href="
                    <?= addLink("bookings/updateBooking", $deteail->getId_booking())
// ########   methode a changer     
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


<div>
    <a class="btn btn-primary" href="<?= addLink('booking', 'newBookings') ?>">
        Passer la commande
    </a>
</div>
<div class="d-flex justify-content-between mt-5">
    <a href="<?= addLink('home') ?>" class="btn btn-secondary">
        <i class="fa fa-home"></i> Retour à l'accueil
    </a>
</div>