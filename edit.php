<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'conn.php'
    ?>
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM drink_categories WHERE id = $id";
    $result = $conn -> query($sql);
    $products = $result -> fetchAll();
    ?>
         <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-control">
            <label for="name"> Name: </label>
            <input type="text" name="name">
            <?php if (isset($errors['name'])) echo "<span style='color:red'>{$errors['name']}</span>" ?>
        </div>
        <div class="form-control">
            <label for="price"> Price: </label>
            <input type="file" name="price">
            <?php if (isset($errors['price'])) echo "<span style='color:red'>{$errors['price']}</span>" ?>
        </div>
        <div class="form-control">
            <label for="category">Category</label>
            <select name="category" id="category">
                <?php
                $sql = "SELECT * FROM drinks";
                $result = $conn->query($sql);
                $categories = $result->fetchAll();

                foreach ($categories as $category) {
                    $selected = ($products[0]['category_id']== $category['category_id']) ?  'selected' :  '';
                    echo "<option value={$category['category']} $selected>
                    {$category['category_name']}</option>";
                }
                ?>
        <div class="form-control">
            <label for="image"> Image: </label>
            <input type="file" name="image" accept="image/*">
            <?php if (isset($errors['image'])) echo "<span style='color:red'>{$errors['image']}</span>" ?>
        </div>

            </select>
        </div>

        <button type="submit" name="submit">Submit</button>

</body>
</html>