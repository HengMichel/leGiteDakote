<?php 
require "views/errors_form.php";
// Initialisation du total des prix
$totalPrice = 0.0;
?>
<!-- Affichage du contenu du detail -->
<div class="container5 link-light fw-medium mt-5">
    <table class="table table-hover mt-5 container ">
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
                        <td class="price align-middle fs-5 text-center fw-bolder link-primary col-2">
                            <?php 
                                // Vérifie si l'objet $price existe et n'est pas null
                                if ($reservation["room"]->getPrice() !== null) { 
                                    echo number_format($reservation["room"]->getPrice(), 2);
                                } else {
                                    echo "Prix non disponible";
                                }
                            ?>
                        </td>
                        <td class="modifMedia m-0 col-2 align-middle fs-5 text-center fw-semibold">
                            <form action="<?= addLink("bookings","newBookings") ?>" method="post">
                            <!-- <a href="<?= addLink("bookings","newBookings") ?>" class="btn btn-outline-primary fw-medium">Valider</a> -->
                                <div class="form-group m-auto">
                                    <button type="submit" name="book" class="btn bg-primary border link-light ">Valider   
                                    </button>
                                </div>
                            </form>
                                <a href="<?= ROOT ?>" class="btn btn-outline-danger fw-medium mt-1">retour accueil</a>
                            </td>
                        </tr> 
                        <?php 
                        }
                    } 
                    ?> 
            </tbody>
        </table>
</div>
