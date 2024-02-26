<div class="listeBookingAdmin container5">
    <table class="table table-hover border mt-4">
        <thead>
            <tr>
                <th class="id_bookings bg-secondary link-light border align-middle text-center fs-4" >Bookings n°</th>
                <th class="debut_reservation bg-secondary link-light border align-middle text-center fs-4">Date début</th>
                <th class="fin_reservation bg-secondary link-light border align-middle text-center fs-4">Date fin</th>
                <th class="user_id bg-secondary link-light border align-middle text-center fs-4">Utilisateur n°</th>
                <th class="room_id bg-secondary link-light border align-middle text-center fs-4">Chambre n°</th>
                <th class="booking_price bg-secondary link-light border align-middle text-center fs-4">Prix de la réservation</th>
                <th class="booking_state bg-secondary link-light border align-middle text-center fs-4">état de la réservation</th>
            </tr>
        </thead>
        <tbody class="bordure border-secondary border-3">
            <?php foreach($bookings as $booking) :?>
                <tr>
                    <td class="idBook border-secondary-subtle border-3 bg-secondary-subtle align-middle fs-4 text-center"><?= $booking->getId_booking() ?></td>
                    <td class="booking_start_date border-secondary-subtle border-3 bg-secondary-subtle align-middle text-center  fs-4"><?= date("d-m-Y", strtotime($booking->getBooking_start_date())) ?></td>
                    <td class="booking_end_date border-secondary-subtle border-3 bg-secondary-subtle align-middle text-center  fs-4"><?= date("d-m-Y", strtotime($booking->getBooking_end_date())) ?></td>
                    <td class="user_id border-secondary-subtle border-3 bg-secondary-subtle align-middle fs-4 text-center"><?= $booking->getUser_id() ?></td>
                    <td class="room_id border-secondary-subtle border-3 bg-secondary-subtle align-middle fs-4 text-center"><?= $booking->getRoom_id() ?></td>
                    <td class="booking_price border-secondary-subtle border-3 bg-secondary-subtle align-middle fs-4 text-center"><?= $booking->getBooking_price() ?></td>
                    <td class="booking_state border-secondary-subtle border-3 bg-secondary-subtle align-middle fs-4 text-center"><?= $booking->getBooking_state() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

