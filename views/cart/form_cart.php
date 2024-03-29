<?php 
require "views/errors_form.php";
// Initialisation du total des prix
$totalPrice = 0.0;
?>
<!-- Affichage du contenu du detail -->
<div class="container5 link-light fw-medium mt-3">
    <form action="<?= addLink("bookings","newBookings") ?>" method="post">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="booking_state" value="<?= $booking_state ?>">

        <table class="table table-hover mt-5 container ">
            <thead>     
                <tr>
                    <th scope="col" class="id_reservation align-middle fs-5 text-center fw-semibold">Chambre#</th>
                    <th class="start_date align-middle fs-5 text-center fw-semibold">Date début</th>
                    <th class="end_date align-middle fs-5 text-center fw-semibold">Date fin</th>
                    <th class="price align-middle fs-5 text-center fw-semibold">Prix</th>
                    <th class="price align-middle fs-5 text-center fw-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Vérifie si $detail est défini et s'il contient des éléments
                if (!empty($_SESSION['cart'])) {
                    // d_die($_SESSION['cart']);
                    foreach($_SESSION['cart'] as $reservation){
                        // d_die($reservation);
                ?>
                    <tr class="table-active">
                        <td class="roomId mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                            <?= $reservation["room"]->getId_room(); ?>
                        </td>
                        <td class="booking_start_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                            <?php
                            $date_debut = DateTime::createFromFormat('Y-m-d', $reservation["date_debut"]);
                            // Affiche la date au format "dd-mm-yyyy"
                            echo $date_debut->format('d-m-Y'); 
                            ?>
                        </td>         
                        <td class="booking_end_date mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold">
                            <?php
                                $date_fin = DateTime::createFromFormat('Y-m-d', $reservation["date_fin"]);
                                // Affiche la date au format "dd-mm-yyyy"
                                echo $date_fin->format('d-m-Y'); 
                            ?>
                        </td>
                        <td class="price align-middle fs-5 text-center col-2">
                            <?php 
                                // Vérifie si l'objet $price existe et n'est pas null
                                if ($reservation["room"]->getPrice() !== null) { 
                                    echo number_format($reservation["room"]->getPrice(), 2);
                                    // Ajoute le prix de cette réservation au total
                                    $totalPrice += $reservation["totalPrice"];
                                    // $totalPrice += $reservation["room"]->getPrice();
                                    
                                } else {
                                    echo "Prix non disponible";
                                }
                            ?>
                        </td>
                        <td class="roomId mt-2 col-1 align-middle fs-5 text-center fw-semibold">
                        <a href="<?= addLink("cart","delectToCart", $reservation["room"]->getId_room()) ?>" class="btn bg-danger link-light ">annuler</a>
                        </td>
                    </tr> 
                <?php 
                    }
                } 
                ?> 
            </tbody>
            <tfoot>
                <tr class="table-active">
                    <td class="total_reservation mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="3">Total de vos réservations:
                    </td>
                    <td class="price border-primary border-4 mt-2 fw-bolder link-primary  col-2 align-middle fs-5 text-center fw-semibold"><?= 
                    // $totalPrice;
                    isset($_SESSION["totalPrice"]) ? number_format($_SESSION["totalPrice"], 2) : '0.00'; 
                    // d_die($_SESSION["totalPrice"]);
                    ?></td>
                    <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                        <button type="submit" name="book" class="btn bg-primary  link-light ">Payer   
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <div class="comeback container">
            <a href="<?= ROOT ?>" class="btn bg-primary link-light">retour liste</a>
        </div>
    </form>
</div>
