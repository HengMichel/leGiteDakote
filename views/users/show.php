<div class="container5 container">
    <?php if ($users) : ?>
        <table class="table d-block">
            <thead>
                <tr>
                    <th class="id_room bg-success link-light border-2 border-warning" >Id user</th>
                    <th class="room_number bg-success link-light border-2 border-warning">Lastname</th>
                    <th class="price bg-success link-light border-2 border-warning">Firstname</th>
                    <th class="persons bg-success link-light border-2 border-warning">Email</th>
                    <th class="category bg-success link-light border-2 border-warning">Password</th>
                    <th class="users_role bg-success link-light border-2 border-warning">Role</th>
                    <th class="users_birthday bg-success link-light border-2 border-warning">Birthday</th>
                    <th class="users_address bg-success link-light border-2 border-warning">Address</th>
                    <th class="users_phone_number bg-success link-light border-2 border-warning">Phone number</th>
                    <th class="users_role bg-success link-light border-2 border-warning">Gender</th>
                    <th class="users_role bg-success link-light border-2 border-warning">Dashboard</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="idUser border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getId_user() ?></td>
                    <td class="last_name border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getLast_name() ?></td>
                    <td class="pricee border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getFirst_name() ?></td>
                    <td class="emailss border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getEmail() ?></td>
                    <td class="mdpp border-success-subtle border-3 mt-2 bg-success-subtle fa-bitcoin-sign fa-bitcoin-sign link-dark fw-bold"><?= $users->getPassword() ?></td>
                    <td class="rolee border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getRole() ?></td>
                    <td class="anniv border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getBirthday() ?></td>
                    <td class="adressee border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getAddress() ?></td>
                    <td class="numm border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getPhone_number() ?></td>
                    <td class="genree border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $users->getGender() ?></td>
                    <td class="actionn border-success-subtle border-3 mt-2 bg-success-subtle fw-medium">
                        <a href="<?= addLink("users","dashUsers") ?>" class="btn btn-success bg-warning border-0 mb-5 link-success fw-bolder">dashboard</a></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>