<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include 'conn.php';
    ?>
    <?php
    $errors = [];
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category_id = $_POST['category'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $folder = 'img/';
            $image = $_FILES['image']['name'];
            $dir = $folder . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $dir);
        } else {
            $errors['image'] = 'Image is required';
        }

        if (empty($name)) {
            $errors['name'] = 'Name is required';
        }

        if (empty($price)) {
            $errors['price'] = 'Price is required';
        } elseif (!is_numeric($price)) {
            $errors['price'] = 'Price must be numeric';
        } elseif ($price < 0) {
            $errors['price'] = 'Price must be positive';
        }
        if (empty($errors)) {
            $sql = "INSERT INTO drinks (name, price, category_id, image) VALUES ( '$name', '$price', '$category_id', '$image')";
            $conn->exec($sql);
        }
    }

    ?>
     <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-control">
            <label for="name"> Name: </label>
            <input type="text" name="name">
            <?php if (isset($errors['name'])) echo "<span style='color:red'>{$errors['name']}</span>" ?>
        </div>
        <div class="form-control">
            <label for="price"> Price: </label>
            <input type="text" name="price">
            <?php if (isset($errors['price'])) echo "<span style='color:red'>{$errors['price']}</span>" ?>
        </div>
        <div class="form-control">
            <label for="category"> Category: </label>
            <select name="category" id="category">
                <?php
                $sql = "SELECT * FROM drink_categories";
                $result = $conn->query($sql);
                $categories = $result->fetchAll();

                foreach ($categories as $category) {
                    echo "<option value={$category['category_id']}>{$category['category_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-control">
            <label for="image"> Image: </label>
            <input type="file" name="image" accept="image/*">
            <?php if (isset($errors['image'])) echo "<span style='color:red'>{$errors['image']}</span>" ?>
        </div>

        <button type="submit" name="submit">Submit</button>

    </form>
</body>
</html>