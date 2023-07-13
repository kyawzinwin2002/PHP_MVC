<?php require_once ViewDir."/template/header.php" ?>

<h1>Edit Country List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("country") ?>" class=" btn btn-outline-primary">All Country List</a>
</div>


<div class="border w-25 rounded p-5">
    <form action="<?= route("country-update") ?>" method="post">    
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="<?= $lists["id"] ?>">
        <div class="">
            <label for="" class=" form-label">Name</label>
            <input type="text" name="name" value="<?= $lists["name"] ?>" class=" form-control">
        </div>
        <div class="">
            <label for="" class=" form-label">Area</label>
            <input type="number" name="area" value="<?= $lists["area"] ?>" class=" form-control">
        </div>
        <button class=" btn btn-primary mt-3">Edit</button>
    </form>
</div>

<?php require_once ViewDir."/template/footer.php" ?>



