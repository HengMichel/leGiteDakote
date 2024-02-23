<div class="container">
    <table class="table table-hover border">
        <thead>
            <tr>
                <th class="id_room bg-dark link-light border align-middle text-center fw-medium fs-4" >Chambre n°</th>
                <th class="image bg-dark link-light border col-2 align-middle text-center fw-medium fs-4">Photo</th>
                <th class="room_number bg-dark link-light border col-2 align-middle text-center fw-medium fs-4">Chambre n°</th>
                <th class="price bg-dark link-light border align-middle text-center fw-medium fs-4">Prix</th>
                <th class="persons bg-dark link-light border col-1 align-middle text-center fw-medium fs-4">Capacité max</th>
                <th class="category bg-dark link-light border align-middle text-center fw-medium fs-4">Category</th>
                <th class="room_state bg-dark link-light border align-middle text-center fw-medium fs-4">Etat</th>
                <th class="action bg-dark link-light border col-1 align-middle text-center fw-medium fs-4">Action</th>
            </tr>
        </thead>
        <tbody class="bordure border">
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom border bg-secondary align-middle fs-1 text-center link-light"><?= $room->getId_room() ?>
                    </td>
                    <td class="photos bg-secondary">
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $room->getRoom_imgs(); ?>" class="card-img-top" alt="image" style="max-width: 100%; height: auto;">
                    </td>
                    <td class="roomNumber border mt-2 bg-secondary align-middle fs-1 text-center link-light"><?= $room->getRoom_number() ?></td>
                    <td class="pricee border mt-2 bg-secondary align-middle fs-1 text-center link-light"><?= $room->getPrice() ?></td>
                    <td class="personss border mt-2 bg-secondary align-middle fs-1 text-center link-light"><?= $room->getPersons() ?></td>
                    <td class="categoryy border mt-2 bg-secondary  align-middle text-center fs-4 link-light"><?= $room->getCategory() ?>
                    </td>
                    <td class="roomState border mt-2 bg-secondary align-middle text-center fs-4 link-light"><?= $room->getRoom_state() ?>
                    </td>

                    <td class="suppr bg-secondary align-middle">
                            <a class="btn btn-danger border border-danger border-2  list-group-item rounded link-light" href="<?= addLink("admin/rooms/deleteRooms", $room->getId_room()) 
                            ?>">supprimer la chambre
                            </a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    
