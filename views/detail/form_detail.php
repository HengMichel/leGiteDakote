<?php 
require "views/errors_form.php";
// id type string
// d_die($detail->getRoom_id()); 

?>
<div class="container5 link-light fw-medium mt-5">
    <form  method="post">

<!-- Ajout d'une valeur cachée pour room_imgs dans le formulaire :
Ajout d'un champ caché (input type="hidden") pour stocker la valeur. Ainsi, cette valeur sera conservée lors de la soumission du formulaire. -->
        <!-- <input type="hidden" name="room_id" value="<?= $detail->getRoom_id() ?>">
      <?php 
    //   d_die($detail); 
      ?>
        <div class="formDetail form-group col-md-3 m-auto">
            <label class="stD bg-black link-light">Début Date :</label>
            <input type="date" class="form-control bg-light border fw-bolder border border-3 border-black" name="detail_start_date" value="<?= $detail->getBooking_start_date() ?>" >
        </div>
        <div class="formDetail form-group col-md-3 m-auto mt-2">
            <label class="edD bg-black">Fin Date :</label>
            <input type="date" class="form-control bg-light border fw-bolder border-3 border-black" name="detail_end_date" value="<?= $detail->getBooking_end_date() ?>">
        </div>


<!  dois faire une handleForm pour traiter la soumission -->
        <!-- <div class="form-group mt-4 col-md-3 m-auto">
            <a href="<?= addLink('detail','newDetail') ?>" class="btn bg-primary link-light fw-bolder m-lg-3">
                <i class="fa fa-home"></i> Je réserve</a> -->

            <!-- <button type="submit" name="panier" class="btn bg-primary border link-light container">Je réserve   
            </button> -->
        </div>
<!-- ######################################################### -->
    </form>
</div>
