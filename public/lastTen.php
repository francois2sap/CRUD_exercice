<?php

require "C:/xampp/htdocs/it-akademy/public/config.php";
require "C:/xampp/htdocs/it-akademy/public/common.php";
try {
$connection = new PDO($dsn, $username, $password, $options);

$sql = "SELECT * FROM products ORDER BY id DESC LIMIT 10";

$statement = $connection->prepare($sql);
$statement->execute();

$result = $statement->fetchAll();
} catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "C:/xampp/htdocs/it-akademy/templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
    > <?php echo $_POST['name']; ?> successfully added.
<?php } ?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>description</th>
            <th>timestamp</th>
            <th>photo</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["name"]); ?></td>
                <td><?php echo escape($row["description"]); ?></td>
                <td><?php echo escape($row["timestamp"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="index.php">index</a>
<?php include "C:/xampp/htdocs/it-akademy/templates/footer.php"; ?>