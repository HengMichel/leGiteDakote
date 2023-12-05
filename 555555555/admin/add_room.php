<?php 
include_once "../inc/header.php"; 
include_once "../model/functions.php";
?>

<div class="container ">
    <form action="../model/db_room.php" method="post" enctype="multipart/form-data">
        <div class="row">

            <div class="form-group col-md-3">
                <label class="rN bg-black link-warning mt-3 fw-semibold">Room Number :</label>
                <input type="text" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium"  name="room_number" >
            </div>
     
            <div class="form-group col-md-3">
                <label class="rP bg-black link-warning mt-3 fw-semibold">Room Price :</label>
                <input type="text" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium" name="room_price" >
            </div>
     
            <div class="form-group col-md-3">
                <label class="ps bg-black link-warning mt-3 fw-semibold">Persons :</label>
                <input type="number" class="form-control mt-3 border-success border-4 bg-bg-success-subtle
bg-success-subtle fw-medium" name="person" >
            </div>
     
            <div class="form-group col-md-3">
                <label class="cate bg-black link-warning mt-3 fw-semibold">Category :</label>
                <select name="category" class="form-control mt-3 border-success fw-medium border-4 link-dark bg-bg-success-subtle
bg-success-subtle">
                    <option value="">Choose category</option>
                    <option value="classic">Classic</option>
                    <option value="piscine">Piscine</option>
                </select>
            </div>
            <div class="form-group col-md-5">
                <label class="pho bg-black link-warning mt-3 fw-semibold">Photo :</label>
                <input type="file" class="form-control mt-3 border-success border-4 fw-medium link-dark bg-bg-success-subtle
bg-success-subtle" name="image" >
            </div>
        </div>      
        <button type="submit" id="bouton" class="btn bg-success mt-5 mb-5 link-warning border-warning border-4 fw-medium" name="add_room" value="submit">Submit</button>
    </form>   
</div>

<?php  
include_once "../inc/footer.php";
?>