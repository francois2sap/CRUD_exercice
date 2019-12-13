<?php

if (isset($_POST['submit'])) {
    require "C:/xampp/htdocs/it-akademy/public/config.php";
    require "C:/xampp/htdocs/it-akademy/public/common.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_product = array(
            "name" => $_POST['name'],
            "description"  => $_POST['description'],
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "products",
            implode(", ", array_keys($new_product)),
            ":" . implode(", :", array_keys($new_product))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_product);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
?>

<?php require "C:/xampp/htdocs/it-akademy/templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    > <?php echo $_POST['name']; ?> successfully added.
<?php } ?>
<h2>Add a product</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="description">Description</label>
        <input type="text" name="description" id="description">
        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">index</a>
<?php include "C:/xampp/htdocs/it-akademy/templates/footer.php"; ?>