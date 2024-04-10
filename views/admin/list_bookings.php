<div class="listeBookingAdmin container5">
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th class="id_bookings align-middle text-center fs-5">Bookings N°</th>
                <th class="user_id align-middle text-center fs-5">Utilisateur N°</th>
                <th class="booking_price align-middle text-center fs-5">Prix</th>
                <th class="booking_state align-middle text-center fs-5">Etat réservation</th>
            </tr>
        </thead>
        <tbody class="bordure">
            <?php foreach($bookings as $booking) :?>
                <tr>
                    <td class="idBook bg-secondary-subtle align-middle text-center"><?= $booking->getId_booking() ?></td>
                    <td class="user_id bg-secondary-subtle align-middle text-center"><?= $booking->getUser_id() ?></td>
                    <td class="booking_price bg-secondary-subtle align-middle text-center"><?= $booking->getBooking_price() ?></td>
                    <td class="booking_state bg-secondary-subtle align-middle text-center"><?= $booking->getBooking_state() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

