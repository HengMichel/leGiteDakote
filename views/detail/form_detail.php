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
             foreach ($detail as $item) {
              ?>
                   
             <tr class="table-active">
                <input type="hidden" name="id_detail" value="<?= $item->getId_detail() ?>">
<?php 
// d_die($item);
// echo "<pre>";
// var_dump($item->getId_detail());
// echo "</pre>";
?>
                <input type="hidden" name="booking_id" value="<?= $item->getBooking_id() ?>">
<?php 
// d_die($item->getBooking_id());
?>
              
                <td class="idbook border-success-subtle border-3 mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $item->getRoom_id() ?>
                </td>
                <td class="booking_start_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($item->getBooking_start_date())) ?>
                </td>
                <td class="booking_end_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($item->getBooking_end_date())) ?>
                </td>

<!-- prendre la valeur de Rooms $rooms->getPrice -->
                <td class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold"><?= number_format($item->getPrice() ,2) ?>
                </td>

<?php 
// d_die($item->getPrice());
?>

                </td>
            </tr>
            <?php 
 // Ajouter le prix de chaque réservation au total
 $totalPrice += $item->getPrice();
             }
} else {
    echo "<tr><td colspan='5'>Aucune réservation trouvée.</td></tr>";
}
        ?> 

        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-secondary border-2 mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link  col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">

                <?php
                 // Afficher le lien pour Payer uniquement si une réservation est présente et que l'état de la réservation n'est pas "cancel"
                 if (!empty($detail)) {
                $hasBooking = false;
                foreach ($detail as $bookingItem) {
                    if ($bookingItem instanceof Model\Entity\Bookings) {
                        $hasBooking = true;
                        break;
                    }
                }
                if ($hasBooking) {
                    echo "<a class='payBooking link-secondary fw-medium border-3' href='" . addLink("bookings/updateBooking", $bookingItem->getId_booking()) . "'>Payer</a>";
                } else {
                    echo "<strong class='text-muted align-middle fs-5 text-center fw-semibold'>Aucune réservation à payer</strong>";
                }
            } else {
                echo "<strong class='text-muted align-middle fs-5 text-center fw-semibold'>Aucune réservation trouvée</strong>";
            }
            ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

    










