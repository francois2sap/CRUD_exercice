<?php

require "C:/xampp/htdocs/it-akademy/public/config.php";
require "C:/xampp/htdocs/it-akademy/public/common.php";

if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $product =[
            "id"        => $_POST['id'],
            "name" => $_POST['name'],
            "description"  => $_POST['description'],
            "timestamp"     => $_POST['timestamp']
        ];

        $sql = "UPDATE products
            SET id = :id,
              name = :name,
              description = :description,
              timestamp = :timestamp
            WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->execute($product);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $product = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "C:/xampp/htdocs/it-akademy/templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['name']); ?> successfully updated.
<?php endif; ?>

    <h2>Edit a product!</h2>

    <form method="post">
        <?php foreach ($product as $key => $value) : ?>
            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php endforeach; ?>
        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

<?php require "C:/xampp/htdocs/it-akademy/templates/footer.php"; ?>