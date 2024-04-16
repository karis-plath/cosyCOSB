<?php
$servername = "localhost";
$useraccount = "admin"; 
$password = "admin"; 
$dbname = "cs410_final";

$conn = new mysqli($servername, $useraccount, $password, $dbname);

// Check if form is submitted
if (isset($_POST['ticket_id'])) {
  $ticket_id = $_POST['ticket_id'];
  $currentTime = date('Y-m-d H:i:s');


  // Update ticket status to closed
  $sql = "UPDATE ticket SET Status = 'Closed', CloseDate = '$currentTime' WHERE Ticket_ID = '$ticket_id'";
  $result = $conn->query($sql);

  if ($result) {
    echo "Ticket successfully closed!";
  } else {
    echo "Error closing ticket: " . $conn->error;
  }
} else {
  echo "Invalid request.";
}

$conn->close();
header('Location: queue.php');
exit();