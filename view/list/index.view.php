<?php require_once ViewDir."/template/header.php" ?>

<h1>My List</h1>



<div class=" mb-3 d-flex justify-content-between">
    <a href="<?= route("list-create") ?>" class=" btn btn-outline-primary">Create New</a>
    <form action="<?= route("list") ?>" >
        <div class=" input-group">
            <input type="text" name="q" value="<?php if(isset($_GET["q"])):  ?><?= $_GET['q'] ?><?php endif; ?>" class=" form-control">
           <?php if(!empty($_GET["q"])): ?>
            <a href="<?= route("list") ?>" class=" btn btn-outline-warning">X</a>
            <?php endif; ?>
            <button class=" btn btn-primary">Search</button>
        </div>
    </form>
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
        <?php foreach($lists["data"] as $list): ?>
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
                <form class=" d-inline-block" action="<?= route("list-delete") ?>" method="post">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="id" value="<?= $list['id'] ?>">
                    <button class="btn btn-outline-danger">Del</button>
                </form>
                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= paginator($lists) ?>



<?php require_once ViewDir."/template/footer.php" ?>



