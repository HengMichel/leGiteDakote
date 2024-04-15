<div class="container5 container">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="state align-middle fs-5 text-center fw-semibold">Etat</th>
                <th class="price align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action m-3 align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // d_die($_SESSION);
            // Initialise comme un nombre flottant
            $totalPrice = 0.0; 
            if (!empty($findUserBookings)) 
            { 
                // d_die($findUserBookings);
                foreach($findUserBookings as $bookings)
                { 
                    // d_die($bookings);
            ?>
            <tr class="table-active">
                <td class="idbook mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $bookings->getRoom_id() ?>
                </td>           
                <?php
                // d_die($bookings->getRoom_id() );    
                ?>
                <td class="booking_start_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($bookings->getBooking_start_date())) ?>
                </td>
                <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($bookings->getBooking_end_date())) ?></td>
                <td class="booking_state mt-2 col-2 align-middle fs-5 text-center fw-semibold"><?= $bookings->getBooking_state() ?>
                </td>
                <td class="booking_price mt-2  col-2 align-middle fs-5 text-center fw-semibold"><?= $bookings->getBooking_price() ?>
                </td>
                <?php 
                // d_die($bookings);
                ?>
                <?php
                if ($bookings->getBooking_state() != 'cancel') 
                { ?>
                    <a class="canc align-middle fs-5 text-center fw-semibold" href="<?= addLink("bookings/cancelBooking", $bookings->getId_booking()) 
                    ?>">Annuler
                    </a>
                <?php                    
                } ?>
                <?php 
                if ($bookings->getBooking_state() != 'cancel') 
                {
                    // Convertir le prix en float avant l'addition
                    $totalPrice += floatval($bookings->getBooking_price());
                    // d_die($bookings);
                } ?>
                <td class=" m-0 mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                    <?php
                    if ($bookings->getBooking_state() != 'cancel') 
                    {
                    ?>
                        <a class="canc fw-medium" href="<?= addLink("bookings/cancelBooking", $bookings->getId_booking()) 
                        ?>">Annuler</a>
                    <?php
                    } else 
                    { ?>
                        <strong class="text-muted">Annulé</strong>
                    <?php
                    } ?>
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
                <td class="total_reservation mt-2  alert-link align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                    <?php
                    if ($bookings->getBooking_state() != 'cancel') 
                    {
                    ?>
                        <a class="payBooking fw-medium" href="<?= addLink("bookings/updateBooking", $bookings->getId_booking()) 
                        ?>">Payer
                        </a>
                    <?php
                    } else 
                    { ?>
                        <strong class="text-muted align-middle fs-5 text-center fw-semibold">A payer</strong>
                    <?php
                    }
                    ?>
                </td> 
            </tr>
        </tfoot>
    </table>
</div>

