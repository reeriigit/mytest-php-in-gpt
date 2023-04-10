<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Include database connection file
        include "../connects/connect.php";

        // Prepare SQL query
        $stmt = $conn->prepare("DELETE FROM product_tb WHERE prd_id=:prd_id");

        // Bind parameters
        $stmt->bindParam(':prd_id', $_POST['prd_id']);

        // Execute query
        $stmt->execute();

        echo "Record deleted successfully";
        echo "<script>window.location.href='select_data.php';</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
} else {
    // Display delete confirmation form
    try {
        // Include database connection file
        include "../connects/connect.php";

        // Prepare SQL query
        $stmt = $conn->prepare("SELECT * FROM product_tb WHERE prd_id=:prd_id");

        // Bind parameters
        $stmt->bindParam(':prd_id', $_GET['id']);

        // Execute query
        $stmt->execute();

        // Set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        // Fetch row
        $row = $stmt->fetch();
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
?>

<!-- Display delete confirmation form -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="hidden" name="prd_id" value="<?php echo $row['prd_id'];?>">
    <p>Are you sure you want to delete this record?</p>
    <p>Name: <?php echo $row['name'];?></p>
    <p>Type: <?php echo $row['type'];?></p>
    <p>Detail: <?php echo $row['detail'];?></p>
    <input type="submit" value="Delete">
</form>

<?php } ?>
