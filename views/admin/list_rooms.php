<div class="listRoomAdmin container container5">
    <table class="tableListAdmin table table-hover">
        <thead>
            <tr>
                <th class="id_room align-middle text-center fs-5" >Id</th>
                <th class="image col-2 align-middle text-center fs-5">Photo</th>
                <th class="room_number col-2 align-middle text-center fs-5">Chambre n°</th>
                <th class="price align-middle text-center fs-5">Prix</th>
                <th class="persons col-1 align-middle text-center fs-5">Capacité</th>
                <th class="category align-middle text-center fs-5">Category</th>
                <th class="room_state align-middle text-center fs-5">Etat</th>
                <th class="action col-1 align-middle text-center fs-5">Action</th>
            </tr>
        </thead>
        <tbody class="bordure">
            <?php foreach($rooms as $room) :?>
                <tr>
                    <td class="idRoom align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getId_room() ?>
                    </td>
                    <td class="photos">
                    <img src="<?= UPLOAD_CHAMBRES_IMG . $room->getRoom_imgs(); ?>" class="card-img-top" alt="image" style="max-width: 100%; height: auto;">
                    </td>
                    <td class="roomNumber mt-2 align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getRoom_number() ?></td>
                    <td class="pricee mt-2 align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getPrice() ?></td>
                    <td class="personss mt-2 align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getPersons() ?></td>
                    <td class="categoryy mt-2 align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getCategory() ?>
                    </td>
                    <td class="roomState mt-2 align-middle text-center fw-medium bg-secondary-subtle"><?= $room->getRoom_state() ?>
                    </td>
                    <td class="suppr bg-dark text-center">
                        <div class="button-container">
                            <a class="btn btn-danger mt-1" href="<?= addLink("admin/rooms/editRoom", $room->getId_room()) 
                            ?>">Modifier
                            </a>
                            <a class="btn btn-danger mt-1" href="<?= addLink("admin/rooms/deleteRooms", $room->getId_room()) 
                            ?>">Supprimer
                            </a>
                            <a class="btn btn-danger mt-1" href="<?= addLink("admin/rooms/historique", $room->getId_room()) 
                            ?>">historique
                            </a>
                        </div>
                    </td> 
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

