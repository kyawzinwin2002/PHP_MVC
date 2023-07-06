<?php require_once ViewDir."/template/header.php" ?>

<h1>My List</h1>

<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("list-create") ?>" class=" btn btn-outline-primary">Create New</a>
</div>


<table class=" table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>money</th>
            <th>created_at</th>
            <th>control</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lists as $list): ?>
            <tr>
                <td>
                    <?= $list["id"] ?>
                </td>
                <td>
                    <?= $list["name"] ?>
                </td>
                <td>
                    <?= $list["money"] ?>
                </td>
                <td>
                    <?= $list["created_at"] ?>
                </td>
                <td>
                <a href="<?=route("list-edit",["id" => $list['id']])?>" class=" btn btn-outline-info">
                    Edit
                </a>
                    <a href="<?=route("list-delete",["id" => $list['id']])?>" class=" btn btn-outline-danger">
                    Del
                </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once ViewDir."/template/footer.php" ?>



