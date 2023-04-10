<?php
//connect to database
include "../connects/connect.php";

//select all products
$sql = "SELECT * FROM product_tb";
$result = $conn->query($sql);

if ($result->rowCount() > 0) {
    // output data of each row
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<div>";
        echo "<p>" . $row["name"] . "</p>";
        echo "<p>" . $row["type"] . "</p>";
        echo "<p>" . $row["detail"] . "</p>";
        //add update button
        echo "<a href='update_data.php?id=" . $row["prd_id"] . "'>Update</a>";
        //add delete button
        echo "<form method='post' action='delete_data.php'>";
        echo "<input type='hidden' name='prd_id' value='" . $row["prd_id"] . "' />";
        echo "<input type='submit' value='Delete' />";
        echo "</form>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn = null;
?>
