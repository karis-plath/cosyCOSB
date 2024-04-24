<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queues</title>
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
      $stmt = $conn->prepare("SELECT * FROM ticket WHERE Status != 'closed'");

      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // We have tickets for this employee
        echo '<div class="title">';
        echo "<h1>Open Tickets</h1>";
        echo '</div>';

        echo'<div class ="doc-bloc">';
        while($row = $result->fetch_assoc()) {
          echo '<a class="ticketDetail" href="ticketDetails.php?id=' . $row['Ticket_ID'] . '"><button>' . 
          '<span style="margin-left: 20px; float: left;">' . $row['Ticket_ID'] . '</span>' . 
          '<span style="margin-right: 20px; float: right;">' . $row["CreateDate"] . '</span>' .
          '<span style="margin-right: 25px; float: right;">' . $row["Importance"] . '</span>' . 
          '<span style="margin-right: 25px; float: right;">' . $row['Status'] . '</span>' . 
          '<span style="margin-right: 25px; float: right;">' . $row["Queue"] . '</span>' . 
           
          '</button></a><br><br>';
        }
      } else {
        echo '<div class="ticketinfo">';
        echo "There are currently no tickets in the queue";
        echo '</div>';
      }
      '</div>';

      $stmt->close(); // Close the ticket retrieval statement
      $conn->close();

    } else {
      header("Location: login.php");
      exit();
    }
  ?>
    
</body>
</html>