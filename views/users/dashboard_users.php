<div class="container5 container">
    <table class="table bg-success-subtle">
        <thead>
            <tr>
                <th class="id_reservation bg-success link-warning border-2 border-warning">Room Id </th>
                <th class="start_date bg-success link-warning border-2 border-warning">Start Date</th>
                <th class="end_date bg-success link-warning border-2 border-warning">End Date</th>
                <th class="state bg-success link-warning border-2 border-warning">State</th>
                <th class="price bg-success link-warning border-2 border-warning">Price</th>
                <th class="action bg-success link-warning m-3 border-2 border-warning">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $totalPrice = 0; 
        if (!empty($findUserBookings)) { 
            // d_die($findUserBookings);

            foreach($findUserBookings as $bookings){ 
                $totalPrice+=$bookings->getBooking_price();
                // d_die($bookings);
            ?>
                <tr>
                    <td class="idbook border-success-subtle border-3 mt-2 fw-medium"><?= $bookings->getRoom_id() ?></td>
                    <td class="booking_start_date border-success-subtle border-3 mt-2 fw-medium"><?= date("d-m-Y", strtotime($bookings->getBooking_start_date())) ?></td>
                    <td class="booking_end_date border-success-subtle border-3 mt-2 fw-medium"><?= date("d-m-Y", strtotime($bookings->getBooking_end_date())) ?></td>
                    <td class="booking_state border-success-subtle border-3 mt-2 fw-medium"><?= $bookings->getBooking_state() ?></td>
                    <td class="booking_price border-success-subtle border-3 mt-2 fw-medium"><?= $bookings->getBooking_price() ?></td>
                    <td class="btn bg-success m-0 border-warning border-3 mt-2 m-auto">
                        <a class="canc link-warning fw-medium" href="<?= addLink("bookings/cancelBooking". $bookings->getId_booking()
                        ) 
                        ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
                    </td> 
                </tr>
                <?php } ?>
          
            <?php 
        } 
        ?>
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-warning border-4 mt-2 border-top alert-link bg-success-subtle" colspan="4">Total de vos réservations:</td>
                <td class="price border-2 border-warning border-4 mt-2 border-top alert-link bg-success-subtle"><?= $totalPrice; ?></td>
            </tr>
        </tfoot>
    </table>
</div>
