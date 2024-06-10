<div class="container">
    <table class="table table-hover mt-3 border border-warning border-3">
        <thead>
            <tr>
                <th class="id_room bg-success link-light" >Id Users</th>
                <th class="room_number bg-success link-light">Nom</th>
                <th class="price bg-success link-light">Prénom</th>
                <th class="persons bg-success link-light">Email</th>
                <th class="category bg-success link-light">Mot de passe</th>
                <th class="room_state bg-success link-light">Date de naissance</th>
                <th class="room_state bg-success link-light">Adresse</th>
                <th class="room_state bg-success link-light">Numéro de téléphone</th>
                <th class="room_state bg-success link-light">Civilité</th>
                <th class="room_state bg-success link-light">Status</th>
            </tr>
        </thead>
        <tbody class="bordure border border-4 border-warning">
            <?php foreach($users as $user) :?>
                <tr>
                    <td class="idUser border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getId_user() ?></td>
                    <td class="last_name border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getLast_name() ?></td>
                    <td class="first_name border-success-subtle border-3 mt-2 bg-success-subtle fw-bolder"><?= $user->getFirst_name() ?></td>
                    <td class="email border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getEmail() ?></td>
                    <td class="mdp border-success-subtle border-3 mt-2 bg-success-subtle  link-dark fw-bolder"><?= $user->getPassword() ?></td>
                    <td class="birthday border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= date("d-m-Y", strtotime($user->getBirthday())) ?></td>
                    <td class="adresse border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getAddress() ?></td>
                    <td class="tel border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getPhone_number() ?></td>
                    <td class="civilite border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getGender() ?></td>
                    <td class="role border-success-subtle border-3 mt-2 bg-success-subtle fw-medium"><?= $user->getRole() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>    

