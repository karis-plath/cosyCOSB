<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tickets</title>
  <link rel="stylesheet" href="ticketSearch.css">
</head>
<body>
  <div class="sidenav">
    <a href="techSearch.html">Search</a>
    <a href="#">Queue</a>
    <a href="#">Docs</a>
    <a href="ticketSearch.php">Tickets</a>
    <a href="createTicket.php">Create Tickets</a>

    <div class="userName">

    </div>
  </div>
  <?php
    session_start();
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
            echo '<div class="ticketinfo">';
            echo "<p>Ticket ID: " . $row["Ticket_ID"] . " Status: " . $row["Status"] .  "</p>";
            echo '</div>';
            
        }
      } else {
        echo "You currently have no tickets.";
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
