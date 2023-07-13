<?php require_once ViewDir."/template/header.php" ?>

<h1>Create New Item</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("inventory") ?>" class=" btn btn-outline-primary">All Items</a>
</div>

<div class="border w-25 rounded p-5">
    <form action="<?= route("inventory-store") ?>" method="post">
        <div class="">
            <label for="" class=" form-label">Item Name</label>
            <input type="text" value="<?= old("name") ?>" name="name" class=" form-control <?php echo hasError("name") ? "is-invalid" : "" ?>">
            <?php if(hasError("name")): ?>
                <div class=" invalid-feedback">
                    <?= showError("name") ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="">
            <label for="" class=" form-label">Price</label>
            <input type="number" value="<?= old("price") ?>" name="price" class=" form-control <?php echo hasError("price") ? "is-invalid" : "" ?>">
            <?php if(hasError("price")): ?>
                <div class=" invalid-feedback">
                    <?= showError("price") ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="">
            <label for="" class=" form-label">Stock</label>
            <input type="number" value="<?= old("stock") ?>" name="stock" class=" form-control <?php echo hasError("stock") ? "is-invalid" : "" ?>">
            <?php if(hasError("stock")): ?>
                <div class=" invalid-feedback">
                    <?= showError("stock") ?>
                </div>
            <?php endif; ?>
        </div>
        <button class=" btn btn-primary mt-3">Add Item</button>
    </form>
</div>

<?php require_once ViewDir."/template/footer.php" ?>



