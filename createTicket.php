<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    <link rel="stylesheet" href="createTicket.css">
</head>
<body>    
    <div class="sidenav">
        <a href="techSearch.html">Search</a>
        <a href="#">Queue</a>
        <a href="#">Docs</a>
        <a href="ticketSearch.html">Tickets</a>

        <div class="userName">

        </div>
    </div>
    <div class="page">
        <div>
            <input type="submit" class="inputBtn" value="Back to home page">
            <div class="title">
                <h1>Submit a ticket!</h1>
            </div>
            <div class="container">
                <form action="createTicket.php" method="post">
                    <!-- <div>
                        <label for="eID">Employee Number</label>
                        <input type="number" id="eID" name="eID" placeholder="0000" required>
                    </div>
                    <br> -->
                    <div class="ep">
                        <!-- <div>
                            <label for="email">Email address: </label>
                            <input type="email" id="email" name="email" placeholder="example@email.com" size="30" required>
                        </div>
                        <br> -->
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
// At the beginning of createTicket.php
session_start();

// Check if the Employee is logged in
if (isset($_SESSION["Employee_ID"])) {
    $employeeID = $_SESSION["Employee_ID"];

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
    $stmt = $conn->prepare("SELECT Email FROM employee WHERE Employee_ID = ?");
    $stmt->bind_param("i", $employeeID);
    $stmt->execute();
    $stmt->bind_result($email);

    // Fetch the result
    if ($stmt->fetch()) {
        // Now, $email contains the retrieved email
        $stmt->close();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Get information
                $phone = $_POST['phone'];
                $issue = $_POST['pDrescription'];
            
                echo $employeeID, $issue, $email;
                //Insert into DB
                // $sql = "INSERT INTO ticket (Employee_ID, email, TicketDesc) VALUES ('$employeeNum', '$email', '$issue')";
                $sql = "INSERT INTO ticket (Employee_ID, Importance, Queue, Status, CreateDate, CloseDate, TicketDesc, Email) VALUES ('$employeeID', 1, 'new', 'new', NOW(), NULL, '$issue', '$email')";
            
                if ($conn->query($sql) === TRUE) {
                    // Redirect to a success page or display a success message
                    header("Location: ticketSearch.html");
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

