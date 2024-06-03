<!-- Ajoutez les autres détails ici -->

<div class="container5 container link-light fw-medium mt-5">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">details#</th>
                <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">Reservation#</th>
                <th scope="col" class="id_chambre align-middle fs-5 text-center fw-semibold">Chambre#</th>
                <th class="start_date align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price align-middle fs-5 text-center fw-semibold">Prix</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table-active">
                <td class="id_detail mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                    <?= $details->getId_detail(); 
                    // debug($details);
                    ?>
                </td>
                <td class="booking_id mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                    <?= $details->getBooking_id(); 
                    // debug($details);
                    ?>
                </td>
                <td class="roomId mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                    <?= $details->getRoom_id();                     
                    // debug($details);
                    ?>
                </td>    
                <td class="booking_start_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                <?= date_format(date_create($details->getBooking_start_date()), 'd.m.Y');
                // d_die($details);
                ?>
                </td>
                <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                <?= date_format(date_create($details->getBooking_end_date()), 'd.m.Y'); 
                // debug($details);
                ?>
                </td>
                <td class="price border-primary border-4 mt-2 fw-bolder link-primary  col-2 align-middle fs-5 text-center fw-semibold">
                    <?= isset($_SESSION["totalPrice"]) ? number_format($_SESSION["totalPrice"], 2) : '0.00';
                    // d_die($details);
                    // debug($_SESSION);
                    ?>                 
                </td>
            </tr> 
        </tbody>
    </table>
</div>
<?php
// Supprimer les variables de session spécifiques à la facture
$sessionKeysToUnset = ['totalPrice','cart','room_id'];

foreach ($sessionKeysToUnset as $key) 
{
    unset($_SESSION[$key]);
}
?>
