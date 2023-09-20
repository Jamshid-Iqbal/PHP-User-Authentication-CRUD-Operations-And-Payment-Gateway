<?php session_start();
include './config/dbOperations.php';
include './utils/phpOperations.php';
$records = getTableDataByCondition('products', '*');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteData('products', "where id = '$id'");
    header("Location: ./products.php");
}
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    header("Location: ./editProducts.php?id=$id");
}
if (isset($_POST['buy'])) {
    $id = $_POST['id'];
    header("Location: ./paymentForm.php?id=$id");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './partials/assets.php'; ?>
    <title>products</title>
</head>

<body class="m-0 p-0">
    <div class="container-fluid m-0 p-0">
        <?php include './partials/dashboard-header.php'; ?>

        <div class="pt-110">
            <div class="container-fluid">
                <div class="col-12 bg-white shadow-lg p-5 rounded">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $index => $record) { ?>

                                <tr>
                                    <th scope="row"><?php echo $index + 1; ?></th>
                                    <th scope="row"><?php echo $record['name'] ?></th>
                                    <th scope="row"><?php echo $record['description'] ?></th>
                                    <th scope="row"><?php echo $record['price'] ?></th>
                                    <td>
                                        <form action="" method="post" class="d-flex flex-wrap gap-2">
                                            <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                                            <button type="submit" name="edit" class="btn btn-success"><i class="fas font-size fa-edit"></i></button>
                                            <button type="submit" name="delete" class="btn btn-danger"><i class="far font-size fa-trash-alt"></i></button>
                                            <button type="submit" name="buy" class="btn btn-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>