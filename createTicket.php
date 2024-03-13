<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include ("menu.php")?>

<div class="createTicket">
        <div>
            <div class="title">
                <h1>Submit a ticket!</h1>
            </div>
            <div class="container">
                <form action="createTicket.php" method="post">
                    
                    <div class="ep">
                        <div class="">
                            <label for="phone">Phone number:</label>
                            <input type="tel" id="phone" name="phone" placeholder="507-555-5555" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                        </div>
                    </div>
                    <br>
                    <div>
                    <label for="pDrescription">Enter Problem Description:</label>
                    <br>
                    <br>
                    <textarea id="pDrescription" name="pDrescription" required placeholder="Computer is running slow"></textarea>
            </div>
            <br>
            <input type="submit" class="inputBtn" value="Submit Ticket">
            </form>
            <br>
        </div>
</div>

<?php
// Check if the Employee is logged in
if (isset($_SESSION["User_ID"])) {
    $User_ID = $_SESSION["User_ID"];

    // Now, retrieve the email from the database using the Employee ID
    $servername = "localhost";
    $useraccount = "admin"; 
    $password = "admin"; 
    $dbname = "cs410_final";

    // Create connection
    $conn = new mysqli($servername, $useraccount, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to retrieve email using Employee ID
    $stmt = $conn->prepare("SELECT Email FROM user WHERE UserID = ?");
    $stmt->bind_param("i", $User_ID);
    $stmt->execute();
    $stmt->bind_result($email);

   
    if ($stmt->fetch()) {
       
        $stmt->close();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Get information
                $phone = $_POST['phone'];
                $issue = $_POST['pDrescription'];
            
                echo $User_ID, $issue, $email;
                //Insert into DB
                $sql = "INSERT INTO ticket (UserID, Importance, Queue, Status, CreateDate, CloseDate, TicketDesc, Email) VALUES ('$User_ID', 'Low', 'new', 'new', NOW(), NULL, '$issue', '$email')";
            
                if ($conn->query($sql) === TRUE) {
                    // Redirect to a success page or display a success message
                    header("Location: ticketSearch.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

        // Close the statement and connection
        $conn->close();
    }

} else {
    // Redirect to the login page if the Employee is not logged in
    header("Location: login.php");
    exit();
}

?>


</body>
</html>

