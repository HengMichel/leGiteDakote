<div class="container  d-flex flex-wrap justify-content-around">

    <?php foreach($roomss as $rooms) : ?>
        <!-- fa-beat-fade -->
        <div class="card border-warning border-2 mb-5 " style="width: 20rem;">
            <div class="img_room">
                <img src="/leGiteDakote/public/assets/imgs/chambres/<?= $rooms->getRoom_imgs() ?> " class="card-img-top img-fluid" alt="image">
            </div>
            <div class="card-body bg-success">
                <p class="card-text fa-2x fw-medium"><?= $rooms->getPrice() ?>€/nuit</p>
                <p class="card-text link-warning fa-xl"><?= $rooms->getCategory() ?></p>
                <p class="card-text fw-medium"><?= $rooms->getPersons() ?> Persons</p>
                <a class="btn bg-warning link-success fw-bolder m-0" 
                href="<?= addLink("bookings", "newBookings") ?>?room_id=<?= $rooms->getId_room() ?>&price=<?= $rooms->getPrice() ?>&room_imgs=<?= $rooms->getRoom_imgs() ?>"
                >Book this Room</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>