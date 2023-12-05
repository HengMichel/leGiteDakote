<?php 
session_start();
require_once "model/functions.php";
include_once "inc/header.php"; 
$userBookList = userBookList($_SESSION["id_user"]);
$price = 0;
?>
<div class="container5 container">

    <table class="table bg-success-subtle">
        
        <thead >
            <tr>
                <th class="id_hotel bg-success link-warning border-2 border-warning">Id Reservation</th>
                <th class="start_date bg-success link-warning border-2 border-warning">Start Date</th>
                <th class="end_date bg-success link-warning border-2 border-warning">End Date</th>
                <th class="state bg-success link-warning border-2 border-warning">State</th>
                <th class="price bg-success link-warning border-2 border-warning">Price</th>
                <th class="action bg-success link-warning m-3 border-2 border-warning">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($userBookList as $book){ 
                $price+=$book['booking_price'];?>
                <tr>
                    <td class="idbook border-success-subtle border-3 mt-2"><?= $book["id_booking"]; ?></td>
                    <td class="booking_start_date border-success-subtle border-3 mt-2"><?= $book["booking_start_date"]; ?></td>
                    <td class="booking_end_date border-success-subtle border-3 mt-2"><?= $book["booking_end_date"]; ?></td>
                    <td class="booking_state border-success-subtle border-3 mt-2"><?= $book["booking_state"]; ?></td>
                    <td class="booking_price border-success-subtle border-3 mt-2"><?= $book["booking_price"]; ?></td>
                    <td class="btn bg-success m-0 border-warning border-3 mt-2 m-auto">
                        <a class="canc link-warning fw-medium" href="http://localhost/projetGite/model/db_booking.php?id_book=
                        <?=$book['id_booking']; ?>">Cancel</a></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr class="table-active">
                <td class="total_reservation border-warning border-4 mt-2 border-top alert-link bg-success-subtle" colspan="4">Total de vos réservations:</td>
                <td class="price border-2 border-warning border-4 mt-2 border-top alert-link bg-success-subtle"><?= $price; ?></td>
            </tr>
        </tfoot>
    </table>
</div>    

<?php include_once "inc/footer.php"; ?>