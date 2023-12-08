<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th class="id_room bg-success link-light" >Id Room</th>
                <th class="room_number bg-success link-light">Room Number</th>
                <th class="price bg-success link-light">Price</th>
                <th class="persons bg-success link-light">Persons</th>
                <th class="category bg-success link-light">Category</th>
                <th class="room_state bg-success link-light">Room State</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getId_room() ?></td>
                    <td class="roomNumber border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getRoom_number() ?></td>
                    <td class="pricee border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getPrice() ?></td>
                    <td class="personss border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getPersons() ?></td>
                    <td class="categoryy border-success-subtle border-3 mt-2 bg-success-subtle fa-bitcoin-sign fa-bitcoin-sign link-dark fw-bold"><?= $room->getCategory() ?></td>
                    <td class="roomState border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getRoom_state() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

<?php include_once "../inc/footer.php"; ?>
