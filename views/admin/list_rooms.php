<div class="container">
    <table class="table border border-warning border-3">
        <thead>
            <tr>
                <th class="id_room bg-success link-light" >Id Room</th>
                <th class="image bg-success link-light">Photo</th>
                <th class="room_number bg-success link-light">Room Number</th>
                <th class="price bg-success link-light">Price</th>
                <th class="persons bg-success link-light">Persons</th>
                <th class="category bg-success link-light">Category</th>
                <th class="room_state bg-success link-light">Room State</th>
                <th class="action bg-success link-light ">Action</th>
            </tr>
        </thead>
        <tbody class="bordure border border-4 border-warning">
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom border-success-subtle border-3  bg-success-subtle fw-bolder align-middle fs-1"><?= $room->getId_room() ?>
                    </td>
                    <td>
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $room->getRoom_imgs(); ?>" class="card-img-top" alt="image" style="max-width: 20%; height: auto;">
                    </td>
                    <td class="roomNumber border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getRoom_number() ?></td>
                    <td class="pricee border-success-subtle border-3 mt-2 bg-success-subtle fw-bolder"><?= $room->getPrice() ?></td>
                    <td class="personss border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getPersons() ?></td>
                    <td class="categoryy border-success-subtle border-3 mt-2 bg-success-subtle  link-dark fw-bolder"><?= $room->getCategory() ?></td>
                    <td class="roomState border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $room->getRoom_state() ?></td>

                    <td><button type="button" class="btn btn-outline-danger ">
                    <a class="supp fw-bolder list-group-item" href="<?= addLink("admin/rooms/deleteRooms", $room->getId_room()) 
                    ?>">supprimer la chambre</a>
                   
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

