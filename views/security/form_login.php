<?php
$mode = $mode ?? "insertion";
require "views/errors_form.php";
?>
<div class="container5 container">
    <form method="post">
        <div class="row mt-5">

            <div class="form-group link-light fw-medium">


                <div class="form-floating col-md-6">
                    <input type="email" class="form-control border-warning border-3 mt-3 bg-black fw-medium link-light" placeholder="name@example.com" id="email" name="email" value="<?= $users->getEmail() ?>">
                    <label for="email">Votre adresse email </label>
                </div>


                <div class="form-floating fw-medium col-md-6">
                    <input type="password" class="form-control border-warning border-3 mt-3 bg-black fw-medium link-light" id="password" name="password" placeholder="Votre mot de passe">
                    <label for="password">Votre mot de passe</label>
                </div>

                 <button type="submit" id="bouton" class="btn btn-outline-warning fw-bolder mt-5 mb-5 m-auto" name="submit">Valider
                 </button>


            </div>
        </div>

    </form>
</div>

