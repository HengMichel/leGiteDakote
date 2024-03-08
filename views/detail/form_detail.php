<?php 
require "views/errors_form.php";
// id type string
// d_die($detail->getRoom_id()); 
$totalPrice = 0.0; // Initialisation du total des prix
// foreach ($panier as $item) {
    // Vérifier si l'élément est une instance de Model\Entity\Detail
    // if ($item instanceof Model\Entity\Detail) { 

        // Récupérer l'identifiant de la chambre associée
        // $roomId = $item->getRoom_id();
       
        // Récupérer l'instance de Rooms correspondante en fonction de l'identifiant
        // (Supposons que $roomsRepository est votre gestionnaire de base de données ou votre classe de gestion des données)
        // $room = $roomsRepository->findById($roomId);

        // Vérifier si une chambre a été trouvée
        // if ($room instanceof Model\Entity\Rooms) {
            // Ajouter le prix au total
//             // $totalPrice += floatval($room->getPrice());
//         }
//     }
// }
?>
<!-- Affichage du contenu du panier -->
<div class="container5 link-light fw-medium mt-5">
    <table class="table table-hover mt-5 bg-success-subtle">
        <thead>
            <tr>
                <th scope="col" class="id_reservation bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Chambre n° </th>
                <th scope="col" class="id_reservation bg-secondary link-light border align-middle fs-5 text-center fw-semibold">N° réservation</th>
                <th class="start_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date début</th>
                <th class="end_date bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Date fin</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Etat</th>
                <th class="price bg-secondary link-light border align-middle fs-5 text-center fw-semibold">Prix</th>
                <th class="action bg-secondary link-light m-3 border align-middle fs-5 text-center fw-semibold">Action</th>
            </tr>
        </thead>
        <tbody>
             <tr class="table-active">
                <td class="idbook border-success-subtle border-3 mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $item->getId_detail() ?></td>
                <td class="idbook border-success-subtle border-3 mt-2 col-1 align-middle fs-5 text-center fw-semibold"><?= $item->getRoom_id() ?></td>
                <td class="booking_start_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($item->getBooking_start_date())) ?></td>
                <td class="booking_end_date border-success-subtle border-3 mt-2 fw-medium col-2 align-middle fs-5 text-center fw-semibold"><?= date("d-m-Y", strtotime($item->getBooking_end_date())) ?></td>

                <td class="booking_state border-success-subtle border-3 mt-2 col-2 align-middle fs-5 text-center fw-semibold"><?= $item->getBooking_state() ?></td>
                <td class="booking_price border-success-subtle border-3 mt-2  col-2 align-middle fs-5 text-center fw-semibold"><?= $item->getBooking_price() ?></td>
                <td class="m-0 border-success-subtle border-3 mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                    <?php if ($item->getBooking_state() != 'cancel') : ?>
                        <a class="canc link-success fw-medium border-3 border-success-subtle" href="<?= addLink("bookings/cancelBooking", $item->getId_booking()) ?>">Annuler</a>
                    <?php else : ?>
                        <strong class="text-muted">Annulé</strong>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-secondary border-2 mt-2 bg-secondary-subtle align-middle fs-5 text-center fw-semibold" colspan="4">Total de vos réservations:</td>
                <td class="price border-primary border-4 mt-2 alert-link  col-2 align-middle fs-5 text-center fw-semibold"><?= $totalPrice; ?></td>
                <td class="m-0 border-secondary-subtle border mt-2 col-2 align-middle fs-5 text-center fw-semibold">
                <?php
                // Vérifier si au moins une réservation est présente dans le panier
                $hasBooking = false;
                foreach ($panier as $booking) {
                    if ($booking instanceof Model\Entity\Bookings) {
                        $hasBooking = true;
                        break;
                    }
                }
                // Afficher le lien pour Payer uniquement si l'état de la réservation n'est pas "cancel"
                if ($hasBooking && $booking->getBooking_state() != 'cancel') :
                ?>
                    <a class="payBooking link-secondary fw-medium border-3" href="<?= addLink("bookings/updateBooking", $booking->getId_booking()) ?>">Payer</a>
                <?php else : ?>
                    <strong class="text-muted align-middle fs-5 text-center fw-semibold">A payer</strong>
                <?php endif; ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

    












<form  method="post">

<!-- Ajout d'une valeur cachée pour room_imgs dans le formulaire :
Ajout d'un champ caché (input type="hidden") pour stocker la valeur. Ainsi, cette valeur sera conservée lors de la soumission du formulaire. -->
        <!-- <input type="hidden" name="room_id" value="<?= $detail->getRoom_id() ?>">
      <?php 
    //   d_die($detail); 
      ?>
        <div class="formDetail form-group col-md-3 m-auto">
            <label class="stD bg-black link-light">Début Date :</label>
            <input type="date" class="form-control bg-light border fw-bolder border border-3 border-black" name="detail_start_date" value="<?= $detail->getBooking_start_date() ?>" >
        </div>
        <div class="formDetail form-group col-md-3 m-auto mt-2">
            <label class="edD bg-black">Fin Date :</label>
            <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="detail_end_date" value="<?= $detail->getBooking_end_date() ?>">
        </div>


<!  dois faire une handleForm pour traiter la soumission -->
        <!-- <div class="form-group mt-4 col-md-3 m-auto">
            <a href="<?= addLink('detail','newDetail') ?>" class="btn bg-primary link-light fw-bolder m-lg-3">
                <i class="fa fa-home"></i> Je réserve</a> -->

            <!-- <button type="submit" name="panier" class="btn bg-primary border link-light container">Je réserve   
            </button> -->
        </div>
<!-- ######################################################### -->
    </form>
</div>



       
           
       
