<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- <?php include("connectionDB.php")?> -->
    <?php include ("menu.php")?>
    <?php
        if (isset($_SESSION["User_ID"])) {
            $User_ID = $_SESSION["User_ID"];
            
            $servername = "localhost";
            $useraccount = "admin";
            $password = "admin";
            $dbname = "cs410_final";
            
            $conn = new mysqli($servername, $useraccount, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $stmt = $conn->stmt_init();
        }
        else {
            header("Location: login.php");
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM document");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $documents = array();
            while($row = $result->fetch_assoc()) {
              $documents[] = $row;
            }
          } else {
            echo "No documentation found!";
          }
        
    ?>  
    
    
    <?php
        if (isset($documents)) {
            foreach ($documents as $document) {
    ?>
    <div class="doc-button">
        <form action="pullDocuments.php" method="post">
            <button type="submit" name="document_id" value="<?php echo $document['id']; ?>">
            <?php 
            
                echo $document['doc_name'];

                ?>  
            </button>
        </form>
    </div>
    <?php
  }
}
?>

</body>
</html>