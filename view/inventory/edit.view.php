<?php require_once ViewDir."/template/header.php" ?>

<h1>Edit Item List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("inventory") ?>" class=" btn btn-outline-primary">Item List</a>
</div>


<div class="border w-25 rounded p-5">
    <form action="<?= route("inventory-update") ?>" method="post">    
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="<?= $lists["id"] ?>">
        <div class="">
            <label for="" class=" form-label">Name</label>
            <input type="text" name="name" value="<?= $lists["name"] ?>" class=" form-control">
        </div>
        <div class="">
            <label for="" class=" form-label">Price</label>
            <input type="number" name="price" value="<?= $lists["price"] ?>" class=" form-control">
        </div>
        <div class="">
            <label for="" class=" form-label">stock</label>
            <input type="number" name="stock" value="<?= $lists["stock"] ?>" class=" form-control">
        </div>
        <button class=" btn btn-primary mt-3">Update Item</button>
    </form>
</div>

<?php require_once ViewDir."/template/footer.php" ?>



