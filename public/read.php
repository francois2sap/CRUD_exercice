<?php
if (isset($_POST['submit'])) {
    try {
        require "C:/xampp/htdocs/it-akademy/public/config.php";
        require "C:/xampp/htdocs/it-akademy/public/common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT *
        FROM `products`";

        $name = $_POST['name'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<?php include "C:/xampp/htdocs/it-akademy/templates/header.php"; ?>

<?php
    if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

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
<?php } else { ?>
    > No results found for <?php echo escape($_POST['name']); ?>.
<?php }
} ?>

    <h2>Find product based on name</h2>

    <form method="post">
        <label for="name">Location</label>
        <input type="text" id="name" name="name">
        <input type="submit" name="submit" value="View Results">
    </form>
    <a href="index.php">Index</a>

<?php include "C:/xampp/htdocs/it-akademy/templates/footer.php"; ?>