<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include "conn.php";
    ?>
    <?php
    $sql = "SELECT drinks.*, drink_categories.category_name FROM drinks JOIN drink_categories ON drinks.category_id = drink_categories.category_id";
    $result = $conn->query($sql);
    $products = $result->fetchAll();
    ?>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <tbody>
            <?php
            foreach ($products as $product) {
                echo "<tr>
            <td>{$product['id']}</td>
            <td>{$product['name']}</td>
            <td>{$product['price']}</td>
            <td>{$product['category_id']}</td>
            <td><img width='100px' src='img/{$product['image']}'></td>
            <td>
            <button><a href='edit.php?id={$product['category_id']}'>Edit</a></button> 
            <button><a href='delete.php?id={$product['category_id']}'>Delete</a></button>
            </td>
            </tr>";

            }
            ?>
        </tbody>
    </table>

</body>

</html>