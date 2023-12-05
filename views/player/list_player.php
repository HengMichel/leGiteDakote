<div class="container">
    <h1 class="m-5 link-warning">Liste des joueurs</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="border-warning border-3 link-warning bg-black">Id Joueur</th>
                <th class="border-warning border-3 link-warning bg-black">Email</th>
                <th class="border-warning border-3 link-warning bg-black">Nickname</th>
                <th class="border-warning border-3 link-warning bg-black">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($players as $player) : ?>
                <tr>
                    <td class="border-warning border-3 link-warning bg-black">
                        <?= $player->getId_player() ?>
                    </td>
                    <td class="border-warning border-3 link-warning bg-black">
                        <?= $player->getEmail() ?>
                    </td>
                    <td class="border-warning border-3 
                    link-warning bg-black">
                    <?= $player->getNickname() ?>
                    </td>
                  
                    <td class="border-warning border-3 link-warning bg-black">
                        <a class="border-warning border-3 link-danger bg-black text-decoration-none" href="<?= addLink("player/deletePlayer", $player->getId_player()) ?>">Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
