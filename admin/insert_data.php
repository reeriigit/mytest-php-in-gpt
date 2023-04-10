<?php


if (isset($_POST['submit'])) {
  try {
    include "../connects/connect.php";
  
    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO product_tb ( name, type, detail) VALUES (:name, :type, :detail)");
   
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':detail', $detail);
    
    // insert a row
  
    $name = $_POST['name'];
    $type = $_POST['type'];
    $detail = $_POST['detail'];
    $stmt->execute();

    echo "New record created successfully";
    echo "<script>window.location.href='select_data.php';</script>";
  } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<body>

<form method="post">
  name: <input type="text" name="name"><br>
  type: <input type="text" name="type"><br>
  detail: <input type="text" name="detail"><br>
  <input type="submit" name="submit">
</form>

</body>
</html>
