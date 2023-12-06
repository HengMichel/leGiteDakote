<?php 
session_start();
include_once "inc/header.php"; 
?>
<div class="container5 container">
    <form action="./model/db_booking.php" method="post">
        <div class="row">
            <div class="form-group link-warning fw-medium d-flex justify-content-md-center mt-5">
                <input type="text" name="id_room" value="<?= $_GET["room"]; ?>" hidden>
                <input type="text" name="price" value="<?= $_GET["price"]; ?>" hidden>
                <div class="form-group link-warning fw-medium col-3">
                    <label class="stD bg-black">Start Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-success border-4 fw-medium mt-3" name="start_date" >
                </div>
                <div class="form-group link-warning fw-medium col-3">
                    <label class="edD bg-black">End Date :</label>
                    <input type="date" class="form-control bg-success-subtle border-4 border-success mt-3 fw-medium" name="end_date" >
                </div>
            </div>
        </div>
        <button type="submit"  class="btn mt-5 mb-5 bg-success link-warning border-warning border-4 fw-medium m-auto" name="book" value="submit">Submit</button>
    </form>
</div>
<?php include_once "inc/footer.php"; ?>