<?php


// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include "../connects/connect.php";

        // get values from form
        $prd_id = $_POST['prd_id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $detail = $_POST['detail'];

        // prepare sql and bind parameters
        $stmt = $conn->prepare("UPDATE product_tb SET name=:name, type=:type, detail=:detail WHERE prd_id=:prd_id");

        // bind parameters
        $stmt->bindParam(':prd_id', $prd_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':detail', $detail);

        // execute query
        $stmt->execute();

        echo "Record updated successfully";
        echo "<script>window.location.href='select_data.php';</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
} else {
    // display form
    try {
        include "../connects/connect.php";

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT * FROM product_tb WHERE prd_id=:prd_id");
        $stmt->bindParam(':prd_id', $_GET['id']);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $row = $stmt->fetch();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="prd_id" value="<?php echo $row['prd_id'];?>">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $row['name'];?>"><br><br>
    <label for="type">Type:</label>
    <input type="text" name="type" value="<?php echo $row['type'];?>"><br><br>
    <label for="detail">Detail:</label>
    <textarea name="detail"><?php echo $row['detail'];?></textarea><br><br>
    <input type="submit" value="Submit">
</form>

<?php } ?>
