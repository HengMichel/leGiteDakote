<div class="listRoomAdmin container">
    <table class="table table-hover border">
        <thead>
            <tr>
                <th class="id_room bg-secondary link-light border align-middle text-center fs-4" >Chambre n°</th>
                <th class="image bg-secondary link-light border col-2 align-middle text-center fs-4">Photo</th>
                <th class="room_number bg-secondary link-light border col-2 align-middle text-center fs-4">Chambre n°</th>
                <th class="price bg-secondary link-light border align-middle text-center fs-4">Prix</th>
                <th class="persons bg-secondary link-light border col-1 align-middle text-center fs-4">Capacité max</th>
                <th class="category bg-secondary link-light border align-middle text-center fs-4">Category</th>
                <th class="room_state bg-secondary link-light border align-middle text-center fs-4">Etat</th>
                <th class="action bg-secondary link-light border col-1 align-middle text-center fs-4">Action</th>
            </tr>
        </thead>
        <tbody class="bordure border">
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom border-secondary-subtle border-3 bg-secondary-subtle align-middle text-center"><?= $room->getId_room() ?>
                    </td>
                    <td class="photos border-secondary-subtle border-3 bg-secondary-subtle">
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $room->getRoom_imgs(); ?>" class="card-img-top" alt="image" style="max-width: 100%; height: auto;">
                    </td>
                    <td class="roomNumber border-secondary-subtle border-3 bg-secondary-subtle mt-2 align-middle fs-4 text-center"><?= $room->getRoom_number() ?></td>
                    <td class="pricee mt-2 border-secondary-subtle border-3 bg-secondary-subtle align-middle text-center"><?= $room->getPrice() ?></td>
                    <td class="personss mt-2 align-middle text-center border-secondary-subtle border-3 bg-secondary-subtle"><?= $room->getPersons() ?></td>
                    <td class="categoryy border mt-2 align-middle text-center border-secondary-subtle border-3 bg-secondary-subtle"><?= $room->getCategory() ?>
                    </td>
                    <td class="roomState border mt-2 align-middle text-center border-secondary-subtle border-3 bg-secondary-subtle"><?= $room->getRoom_state() ?>
                    </td>
                    <td class="suppr border-secondary-subtle border-3 bg-secondary-subtle align-middle">
                            <a class="btn btn-danger border border-danger border-2  list-group-item rounded link-light" href="<?= addLink("admin/rooms/deleteRooms", $room->getId_room()) 
                            ?>">supprimer la chambre
                            </a>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

