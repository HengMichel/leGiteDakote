<div class="container5 ">
    <table class="table table-hover mt-5 bg-secondary-subtle">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-secondary link-light align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="state bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Etat</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action bg-secondary link-light m-3 border align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Initialisation du total de prix
            $totalPrice = 0.0;

            // Parcourir le panier
            foreach ($panier as $item) {
                echo '<tr class="table-active">';
                // Vérifier le type de l'élément du panier
                if (is_array($item)) {
                    // Traitement pour un tableau associatif
                    echo '<td class="bookRoomId text-center border-secondary">' . ($item['booking_start_date'] ?? '') . '</td>';
                    echo '<td class="bookStartDate text-center border-secondary">' . ($item['booking_start_date'] ?? '') . '</td>';
                    echo '<td class="bookEndDate text-center border-secondary">' . ($item['booking_end_date'] ?? '') . '</td>';
                    echo '<td class="bookState text-center border-secondary">' . ($item['booking_state'] ?? '') . '</td>';
                    echo '<td class="bookPrice text-center border-secondary">' . ($item['price'] ?? '') . '</td>';
                } elseif ($item instanceof Model\Entity\Bookings) {
                    // Traitement pour un objet Model\Entity\Bookings
                    echo '<td class="bookRoomId text-center border-secondary">' . $item->getRoom_id() . '</td>';
                    echo '<td class="bookStartDate text-center border-secondary">' . $item->getBooking_start_date() . '</td>';
                    echo '<td class="bookEndDate text-center border-secondary">' . $item->getBooking_end_date() . '</td>';
                    echo '<td class="bookState text-center border-secondary">' . $item->getBooking_state() . '</td>';
                    echo '<td class="bookPrice text-center border-secondary">' . $item->getBooking_price() . '</td>';
                }
                echo '</tr>';
            }
            
            ?>
        </tbody>
        <tfoot>
            <!-- Affichage du total des prix des réservations -->
            <tr class="table-active">
                <td class="total_reservation border-secondary border-2 mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link  col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                    <?php
                    // Afficher le lien pour Payer uniquement si l'état de la réservation n'est pas "cancel"
                    if (!empty($panier) && $panier[0] instanceof Model\Entity\Bookings && $panier[0]->getBooking_state() != 'cancel') {
                    ?>
                        <a class="payBooking link-secondary fw-medium border-3" href="<?= addLink("bookings/updateBooking", $panier[0]->getId_booking()) ?>">Payer</a>
                    <?php } else { ?>
                        <strong class="text-muted align-middle fs-5 text-center fw-semibold">A payer</strong>
                    <?php } ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
