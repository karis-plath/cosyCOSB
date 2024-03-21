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
        
    ?>    
</body>
</html>