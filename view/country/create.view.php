<?php require_once ViewDir."/template/header.php" ?>

<h1>Create Country List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("country") ?>" class=" btn btn-outline-primary">All country</a>
</div>

<div class="border w-25 rounded p-5">
    <form action="<?= route("country-store") ?>" method="post">
        <div class="">
            <label for="" class=" form-label">Name</label>
            <input type="text" name="name" class=" form-control">
        </div>
        <div class="">
            <label for="" class=" form-label">Area</label>
            <input type="number" name="area" class=" form-control">
        </div>
        <button class=" btn btn-primary mt-3">Create</button>
    </form>
</div>

<?php require_once ViewDir."/template/footer.php" ?>



