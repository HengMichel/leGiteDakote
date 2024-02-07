<div class="container">
    <table class="table border border-warning border-3 mt-4">
        <thead>
            <tr>
                <th class="id_bookings bg-success link-light" >Id Bookings</th>
                <th class="debut_reservation bg-success link-light">Début date de réservation</th>
                <th class="fin_reservation bg-success link-light">Fin date de réservation</th>
                <th class="user_id bg-success link-light">Utilisateur id</th>
                <th class="room_id bg-success link-light">Chambre id</th>
                <th class="booking_price bg-success link-light">Prix de la réservation</th>
                <th class="booking_state bg-success link-light">état de la réservation</th>
            </tr>
        </thead>
        <tbody class="bordure border border-4 border-warning">
            <?php foreach($bookings as $booking) :?>
                <tr>
                    <td class="idBook border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $booking->getId_booking() ?></td>
                    <td class="booking_start_date border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= date("d-m-Y", strtotime($booking->getBooking_start_date())) ?></td>
                    <td class="booking_end_date border-success-subtle border-3 mt-2 bg-success-subtle fw-bolder"><?= date("d-m-Y", strtotime($booking->getBooking_end_date())) ?></td>
                    <td class="user_id border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $booking->getUser_id() ?></td>
                    <td class="room_id border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $booking->getRoom_id() ?></td>
                    <td class="booking_price border-success-subtle border-3 mt-2 bg-success-subtle  link-dark fw-bolder"><?= $booking->getBooking_price() ?></td>
                    <td class="booking_state border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $booking->getBooking_state() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

