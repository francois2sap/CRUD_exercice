<?php

/**
 * Delete a user
 */

require "C:/xampp/htdocs/it-akademy/public/config.php";
require "C:/xampp/htdocs/it-akademy/public/common.php";

if (isset($_GET["id"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $id = $_GET["id"];

        $sql = "DELETE FROM products WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "Product successfully deleted";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM products";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "C:/xampp/htdocs/it-akademy/templates/header.php"; ?>

<?php if ($success) echo $success; ?>

    <h2>Delete products</h2>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <!--        <th>Photo</th>-->
            <th>Timestamp</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["description"]); ?></td>
                <td><?php echo escape($row["photo"]); ?></td>
                <td><?php echo escape($row["timestamp"]); ?></td>
                <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php">Back to home</a>
<?php require "C:/xampp/htdocs/it-akademy/templates/footer.php"; ?>