<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tickets</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include ("menu.php")?>
  
  <?php
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);

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

      // New code to fetch tickets for this employee
      $stmt = $conn->prepare("SELECT Ticket_ID, Status FROM ticket WHERE UserID = ?");
      $stmt->bind_param("i", $User_ID);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // We have tickets for this employee
        echo '<div class="ticketinfo">';
        echo "<h2>Your Tickets</h2>";
        echo '</div>';

        while($row = $result->fetch_assoc()) {
            echo '<a class = "ticketDetail" href="ticketDetails.php?id=' . $row['Ticket_ID'] . '"> <button>'. $row['Ticket_ID'] . $row['Status'] .  '</button></a><br><br>';
        }
      } else {
        echo '<div class="ticketinfo">';
        echo "You currently have no tickets.";
        echo '</div>';
      }

      $stmt->close(); // Close the ticket retrieval statement
      $conn->close();

    } else {
      header("Location: login.php");
      exit();
    }
  ?>
</body>
</html>
