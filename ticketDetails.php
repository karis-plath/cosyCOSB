<html>
    <head>
        <title>Ticket-Details</title>
        <link rel="stylesheet" href="style.css">
    </head>

<?php include ("menu.php")?>

<?php
$User_ID = $_SESSION["User_ID"];

$servername = "localhost";
$useraccount = "admin"; 
$password = "admin"; 
$dbname = "cs410_final";

$conn = new mysqli($servername, $useraccount, $password, $dbname);

// Fetch data from the database
$sql = "SELECT Ticket_ID FROM ticket;";
$result = $conn->query($sql);

// Store the result in an associative array
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Get the ID from the query parameter
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    // Fetch additional details based on the ID
    $sql = "SELECT * FROM ticket WHERE ticket.Ticket_ID = '$id'"; 
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_row();
        // Display details
        echo '<div class="ticketDetail">';
        echo "<h1>Details for Ticket: " . $row[0] . "</h1>";
        echo "<p>User: " . $row[1] . "</p>";
        echo "<p>Create: " . $row[5] . "</p>";
        echo "<p>Close: " . $row[6] . "</p>";
        echo "<p>Importance: " . $row[2] . "</p>";
        echo "<p>Queue: " . $row[3] . "</p>";
        echo "<p>Status: " . $row[4] . "</p>";
        echo "<p>Desc: " . $row[7] . "</p>";
        echo "<p>Email: " . $row[8] . "</p>";
        echo '<form action="editTicket.php" method="post">';
        echo '<input type="hidden" name="ticket_id" value="' . $row[0] . '">';
        echo '<button type="submit">Edit Ticket</button>';
        echo '</form>';
        echo '<form action="close_ticket.php" method="post">';
        echo '<input type="hidden" name="ticket_id" value="' . $row[0] . '">';
        echo '<button type="submit">Close Ticket</button>';
        echo '</form>';
        echo '</div>';

        
    } else {
        echo "Ticket not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>

</html>