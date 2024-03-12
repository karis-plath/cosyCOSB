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
  <div>
    
  </div>
  <?php
    session_start();
    if (isset($_SESSION["Employee_ID"])) {
      $employeeID = $_SESSION["Employee_ID"];

      $servername = "localhost";
      $useraccount = "admin"; 
      $password = "admin"; 
      $dbname = "cs410_final";

      $conn = new mysqli($servername, $useraccount, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $stmt = $conn->prepare("SELECT Email FROM employee WHERE Employee_ID = ?");
      $stmt->bind_param("i", $employeeID);
      $stmt->execute();
      $stmt->bind_result($email);

      $stmt->close(); // Close the email retrieval statement

      // New code to fetch tickets for this employee
      $stmt = $conn->prepare("SELECT Ticket_ID, Status FROM ticket WHERE Employee_ID = ?");
      $stmt->bind_param("i", $employeeID);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // We have tickets for this employee
        echo "<h2>Your Tickets</h2>";
        while($row = $result->fetch_assoc()) {
          echo "<p>Ticket ID: " . $row["Ticket_ID"] . "</p>";
          echo "<p>Status: " . $row["Status"] . "</p>";
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
