<div class="container">
    <h1 class="m-5 link-warning">Dashboard Admin</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="border-warning border-3 link-warning bg-black">Ajouter une chambre</th>
                <th class="border-warning border-3 link-warning bg-black">la liste des chambres</th>
                <th class="border-warning border-3 link-warning bg-black">la liste des réservations</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td class="border-warning border-3 link-warning bg-black">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
            <a href="<?= addLink("rooms/newRooms") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
            </td>
            <td class="border-warning border-3 link-warning bg-black">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
            <a href="<?= addLink("rooms/list") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
            </td>
            <td class="border-warning border-3 link-warning bg-black">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
            <a href="<?= addLink("bookings/list") ?>" class="btn btn-success mt-5 mb-5 link-light fw-medium">Annuler</a>
            </td>
          </tr>
          </tbody>
    </table>
</div>