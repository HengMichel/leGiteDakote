<div class="container">
    <h1 class="m-5 link-warning">Liste de match</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="border-warning border-3 link-warning bg-black">Nom du Jeu</th>
                <th class="border-warning border-3 link-warning bg-black">Nbr de joueurs enregistrés :</th>
                <th class="border-warning border-3 link-warning bg-black">Date de démarrage:</th>
                <th class="border-warning border-3 link-warning bg-black">Pseudonyme du gagnant du match :</th>
                <th class="border-warning border-3 link-warning bg-black">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($contests as $contest): ?>
                <tr>
                    <td class="border-warning border-3 link-warning bg-black"><?= $contest['title']; ?></td>

                    <td class="border-warning border-3 link-warning bg-black"><?= $contest['nombre_de_joueurs']; ?></td>

                    <td class="border-warning border-3 link-warning bg-black"><?= $contest['start_date']; ?></td>


                    <td class="border-warning border-3 link-warning bg-black"><?= $contest['nickname']; ?></td>

                    <td class="border-warning border-3 link-warning bg-black">
                        <a class="border-warning border-3 link-danger bg-black text-decoration-none" 
                         href="<?= addLink("contest", "deleteContest", $contest['id_contest']) ?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>