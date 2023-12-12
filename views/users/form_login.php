<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";

?>
<div class="container5 container">
    <form method="post" action="coUsers">
        <div class="row">
            <div class="form-group link-warning fw-medium col-6">
                <label class="email bg-dark" for="email">Email :<sup>*</sup></label>
                <input type="email" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="email" name="email" value="<?= $users->getEmail() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
            <div class="form-group link-warning fw-medium col-6">
                <label class="password bg-dark" for="password">Password :<sup>*</sup></label>
                <input type="password" class="form-control border-success border-4 mt-3 bg-success-subtle fw-medium" id="password" name="password"value="<?= $users->getPassword() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>>
            </div>
        </div>
        <button type="submit" id="bouton" class="btn mt-5 mb-5 fw-bold bg-warning link-success m-auto" name="submit"><?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?></button>
        <a href="<?= addLink("users/coUsers") ?>" class="btn bg-light mt-5 mb-5 link-success fw-bolder">Annuler</a>
    </form>
</div>
