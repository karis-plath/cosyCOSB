<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>run</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include ("menu.php")?>
<?php
    if (isset($_POST["document_id"])) {
    $document_id = $_POST["document_id"];

    $servername = "localhost";
    $useraccount = "admin";
    $password = "admin";
    $dbname = "cs410_final";
        
    $conn = new mysqli($servername, $useraccount, $password, $dbname);
        
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->stmt_init();
    
    

    $sql = "SELECT doc_name, doc_content FROM document WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $document_id);
    $stmt->execute();
    $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $document = $result->fetch_assoc();

    echo "<div class='doc_content' id='doc_content'>";
    echo "<p class='doc-h'>" . $document['doc_name'] . "</h2>";
    echo "<p class='doc-p'>" . $document['doc_content'] . "</p>";
    echo "</div>";

  } else {
    echo "Document not found!";
  }
} else {
  echo "Invalid access!";
}
?>
<!-- <div class="content"></div> -->
</body>
</html>