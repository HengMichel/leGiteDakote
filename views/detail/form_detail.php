<?php 
require "views/errors_form.php";

// Initialisation du total des prix
$totalPrice = 0.0;
?>
<!-- Affichage du contenu du detail -->
<div class="container5 link-light fw-medium mt-5">
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">Chambre#</th>
                <th class="start_date align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action m-3 align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Vérifie si $detail est défini et s'il contient des éléments
            if (!empty($_SESSION['cart'])) {
                // d_die($_SESSION['cart']);
                // extract($_SESSION['cart']);
            foreach($_SESSION['cart'] as $reservation){
            //     echo $reservation["room"]->getId_room();
            ?>
                <tr class="table-active">
                
                    <td class="roomId mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= 
                    $reservation["room"]->getId_room(); 
                    ?>
                    <?php
                    // d_die($detail);
                    ?>               
                    </td>
<!--########################### date ne s'affiche pas #########################################################-->
                    <td class="booking_start_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", 
                    strtotime(
                        // $detail->getBooking_start_date()
                        $reservation["date_debut"]->getBooking_start_date()
                    )); 
                    // d_die($reservation["date_debut"]->getBooking_start_date());
                    ?>
                    </td>
                    <?php
                    // d_die($detail);
                    ?>              
                    <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime(
                        // $detail->getBooking_end_date()
                        $reservation["date_fin"]->getBooking_end_date()
                        )) ?>
                    </td>
                    <td class="price align-middle fs-5 text-center fw-bolder link-primary">
                    <?php 
                    // Vérifie si l'objet $price existe et n'est pas null
                    if ($price !== null) { 
                        echo number_format($price, 2);
                    } else {
                        echo "Prix non disponible";
                    }
                    ?>
                      <?php
                    // d_die($price);
                    ?>      
                    </td>
                    <td class="m-0 col-2 align-middle fs-5 text-center fw-semibold">
                        <a href="<?= addLink("bookings","newBookings") ?>" class="btn btn-primary fw-medium link-light">Payer</a>
                    </td>
                </tr> 
                <?php 
                }

            } 
                ?> 
        </tbody>
    </table>
</div>
