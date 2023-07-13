<?php require_once ViewDir . "/template/header.php" ?>

<h1>Create New List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("list") ?>" class=" btn btn-outline-primary">All List</a>
</div>

<div class="border w-25 rounded p-5">
    <form action="<?= route("list-store") ?>" method="post">
        <div class="">
            <label for="" class=" form-label">Name</label>
            <input value="<?= old("name") ?>" type="text" name="name" class=" form-control <?= hasError("name") ? "is-invalid" : "" ?>">
            <?php if(hasError("name")): ?>
                <div  class="invalid-feedback">
                <?= showError("name") ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="">
            <label for="" class=" form-label">Money</label>
            <input value="<?= old("name") ?>" type="number" name="money" class=" form-control <?= hasError("money") ? "is-invalid" : "" ?>">
            <?php if(hasError("money")): ?>
                <div  class="invalid-feedback">
                <?= showError("money") ?>
            </div>
            <?php endif; ?>
        </div>
        <button class=" btn btn-primary mt-3">Create</button>
    </form>
</div>

<?php require_once ViewDir . "/template/footer.php" ?>