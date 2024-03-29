<!-- Affichage du contenu du detail -->
<div class="container5 container link-light fw-medium mt-5">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">Reservation#</th>
                <th scope="col" class="id_chambre align-middle fs-5 text-center fw-semibold">Chambre#</th>
                <th class="start_date align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price align-middle fs-5 text-center fw-semibold">Prix</th>
            </tr>
        </thead>
        <tbody>   
            <tr class="table-active">
                <td class="booking_id mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                    <?= $detail->getBooking_id(); ?>
                </td>
                <td class="roomId mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                    <?= $detail->getRoom_id(); ?>
                </td>
     
                <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                <?= $detail->getBooking_start_date(); ?>
                </td>
                <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                <?= $detail->getBooking_end_date(); ?>
                </td>
            </tr> 
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:
                </td>
                <td class="price border-primary border-4 mt-2 fw-bolder link-primary  col-2 align-middle fs-5 text-center fw-semibold"><?= 
                // $totalPrice;
                isset($_SESSION["totalPrice"]) ? number_format($_SESSION["totalPrice"], 2) : '0.00'; 
                // d_die($totalPrice);
                // d_die($_SESSION);
                ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
