<div class="container">
    <table class="table table-hover border border-warning border-3">
        <thead>
            <tr>
                <th class="id_room bg-success link-light border-3 border-warning align-middle text-center fw-medium fs-4" >Chambre n°</th>
                <th class="image bg-success link-light border-3 col-2 align-middle text-center fw-medium fs-4">Photo</th>
                <th class="room_number bg-success link-light border-3 border-warning col-2 align-middle text-center fw-medium fs-4">Chambre n°</th>
                <th class="price bg-success link-light border-3 align-middle text-center fw-medium fs-4">Prix</th>
                <th class="persons bg-success link-light border-3 border-warning col-1 align-middle text-center fw-medium fs-4">Capacité max</th>
                <th class="category bg-success link-light border-3 align-middle text-center fw-medium fs-4">Category</th>
                <th class="room_state bg-success link-light border-3 border-warning align-middle text-center fw-medium fs-4">Etat</th>
                <th class="action bg-success link-light border-3 col-1 align-middle text-center fw-medium fs-4">Action</th>
            </tr>
        </thead>
        <tbody class="bordure border-3 border-success-subtle">
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom border-success-subtle border-3  bg-success-subtle align-middle fs-1 text-center"><?= $room->getId_room() ?>
                    </td>
                    <td class="photos bg-success-subtle">
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $room->getRoom_imgs(); ?>" class="card-img-top" alt="image" style="max-width: 100%; height: auto;">
                    </td>
                    <td class="roomNumber border-success-subtle border-3 mt-2 bg-success-subtle align-middle fs-1 text-center"><?= $room->getRoom_number() ?></td>
                    <td class="pricee border-success-subtle border-3 mt-2 bg-success-subtle align-middle fs-1 text-center"><?= $room->getPrice() ?></td>
                    <td class="personss border-success-subtle border-3 mt-2 bg-success-subtle align-middle fs-1 text-center"><?= $room->getPersons() ?></td>
                    <td class="categoryy border-success-subtle border-3 mt-2 bg-success-subtle  align-middle text-center fs-4"><?= $room->getCategory() ?>
                    </td>
                    <td class="roomState border-success-subtle border-3 mt-2 bg-success-subtle align-middle text-center fs-4"><?= $room->getRoom_state() ?>
                    </td>

                    <td class="suppr bg-success-subtle align-middle">
                        <!-- <button type="button" class="btn btn-outline-danger "> -->
                            <a class="btn btn-danger border border-danger border-3 fw-bolder list-group-item rounded" href="<?= addLink("admin/rooms/deleteRooms", $room->getId_room()) 
                            ?>">supprimer la chambre
                            </a>
                        <!-- </button> -->
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    
