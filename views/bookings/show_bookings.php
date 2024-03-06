<div class="container5 ">
    <table class="table table-hover mt-5 container">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th class="start_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Etat</th>
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

                    // Ajouter le prix au total
                    $totalPrice += floatval($item['price'] ?? 0); 

                    echo '<td class="bookRoomId text-center border-secondary">' . ($item['room_id'] ?? '') . '</td>';

                    // Convertir la date de début au format "jj-mm-aaaa"
                    $startDate = date('d-m-Y', strtotime($item['booking_start_date'] ?? ''));
                    echo '<td class="bookStartDate text-center border-secondary">' .$startDate . '</td>';

                    // Convertir la date de fin au format "jj-mm-aaaa"
                    $endDate = date('d-m-Y', strtotime($item['booking_end_date'] ?? ''));
                    echo '<td class="bookEndDate text-center border-secondary">' . $endDate . '</td>';
                    
                    // Afficher l'état de la réservation
                    echo '<td class="bookState text-center border-secondary">' . ($item['booking_state'] ?? '') . '</td>';

                    // Afficher le prix de la réservation
                    echo '<td class="bookPrice text-center border-secondary">' . ($item['price'] ?? '') . '</td>';

                 

                } elseif ($item instanceof Model\Entity\Bookings) {
                    // Traitement pour un objet Model\Entity\Bookings

                    // Ajouter le prix au total
                    $totalPrice += floatval($item->getBooking_price()); 

                    echo '<td class="bookRoomId text-center border-secondary">' . $item->getRoom_id() . '</td>';

                    echo '<td class="bookStartDate text-center border-secondary">' . $item->getBooking_start_date() . '</td>';

                    echo '<td class="bookEndDate text-center border-secondary">' . $item->getBooking_end_date() . '</td>';

                    // Afficher l'état de la réservation
                    echo '<td class="bookState text-center border-secondary">' . $item->getBooking_state() . '</td>';

                    // d_die($item->getBooking_state());

                    // Afficher le prix de la réservation
                    echo '<td class="bookPrice text-center border-secondary">' . $item->getBooking_price() . '</td>';

                    // Ajouter un bouton ou un lien pour annuler la réservation
                    echo '<td class="annulerPanier text-center border-secondary form-control bg-danger link-light">'.'<a class="lienAnnule text-decoration-none link-light" href="' . addLink('bookings','annulerReservation', $item->getId_booking()) . '">Annuler</a>'. '</td>';

                    d_die($item->getId_booking());
                    
                }
                echo '</tr>';
            }
            // Afficher le total des prix des réservations
            ?>
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-secondary border-2 mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link  col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                    <?php
                    // d_die($totalPrice);
                    // d_die($item->getBooking_state());

                    // Vérifier si au moins une réservation est présente dans le panier
                    $hasBooking = false;
                    foreach ($panier as  $booking) {
                        if ($booking instanceof Model\Entity\Bookings) {
                            $hasBooking = true;

                            // d_die($hasBooking);
                            break;

                        }
                    }
                    // Afficher le lien pour Payer uniquement si l'état de la réservation n'est pas "cancel"
                    if ($hasBooking && $booking->getBooking_state() != 'cancel') {
                    ?>
                        <a class="payBooking link-secondary fw-medium border-3" href="<?= addLink("bookings/updateBooking", $booking->getId_booking()) ?>">Payer</a>
                    <?php } else { ?>
                        <strong class="text-muted align-middle fs-5 text-center fw-semibold">A payer</strong>
                    <?php } ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
