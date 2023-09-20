<?php session_start();
include './config/dbOperations.php';
include './utils/phpOperations.php';
$id = $_SESSION['id'];
$records = getTableDataByCondition('orders', 'orders.id as order_id, products.name as product_name, price', "INNER JOIN products ON products.id = orders.product_id WHERE user_id = '$id' ");

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteData('orders', "where id = '$id'");
    header("Location: ./orders.php");
}
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    header("Location: ./paymentForm.php?id=$id");
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
                                <th scope="col">Order Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $index => $record) { ?>

                                <tr>
                                    <th scope="row"><?php echo $index + 1; ?></th>
                                    <td scope="row"><?php echo $record['order_id'] ?></td>
                                    <td scope="row"><?php echo $record['product_name'] ?></td>
                                    <td scope="row"><?php echo $record['price'] ?></td>
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