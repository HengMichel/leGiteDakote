<div class="listRoomAdmin container container5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="id_room align-middle text-center fs-5" >Utilisateurs</th>
                <th class="nom align-middle text-center fs-5">Nom</th>
                <th class="nom align-middle text-center fs-5">Prénom</th>
                <th class="email align-middle text-center fs-5">Email</th>
                <th class="email align-middle text-center fs-5">Date debut</th>
                <th class="email align-middle text-center fs-5">Date fin</th>
                <!-- Ajoutez d'autres colonnes si nécessaire -->
            </tr>
        </thead>
        <tbody class="bordure">
            <?php foreach($users as $user) :?>
                <tr>
                    <td class="idRoom align-middle text-center fw-medium bg-secondary-subtle"><?= $user['id_user'] ?>
                    </td>
                    <td class="nom align-middle text-center fw-medium bg-secondary-subtle"><?= $user['last_name'] ?></td>
                    <td class="nom align-middle text-center fw-medium bg-secondary-subtle"><?= $user['first_name'] ?></td>
                    <td class="email align-middle text-center fw-medium bg-secondary-subtle"><?= $user['email'] ?></td>
                    <td class="email align-middle text-center fw-medium bg-secondary-subtle"><?= date_format(date_create($user['booking_start_date']), 'd.m.Y'); ?></td>
                    <td class="email align-middle text-center fw-medium bg-secondary-subtle"><?= date_format(date_create($user['booking_end_date']), 'd.m.Y'); ?></td>
                    <!-- Ajoutez d'autres colonnes si nécessaire -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
