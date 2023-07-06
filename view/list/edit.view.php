<?php require_once ViewDir."/template/header.php" ?>

<h1>Edit List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("list") ?>" class=" btn btn-outline-primary">All List</a>
</div>



<div class="border w-25 rounded p-5">
    <form action="<?= route("list-update") ?>" method="post">    
    <input type="hidden" name="id" value="<?= $lists["id"] ?>">
        <div class="">
            <label for="" class=" form-label">Name</label>
            <input type="text" name="name" value="<?= $lists["name"] ?>" class=" form-control">
        </div>
        <div class="">
            <label for="" class=" form-label">Money</label>
            <input type="number" name="money" value="<?= $lists["money"] ?>" class=" form-control">
        </div>
        <button class=" btn btn-primary mt-3">Edit</button>
    </form>
</div>

<?php require_once ViewDir."/template/footer.php" ?>



