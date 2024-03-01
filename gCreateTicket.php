<!DOCTYPE html>
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
                    <br>
                    <div class="ep">
                        <div>
                            <label for="email">Email address: </label>
                            <input type="email" id="email" placeholder="example@email.com" size="30" required>
                        </div>
                        <br>
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Get information
            $email = $_POST['email'];
            $issue = $_POST['pDrescription'];
                
            echo $employeeID, $issue, $email;
            //Insert into DB
            $sql = "INSERT INTO ticket ( Employee_ID, Importance, Queue, Status, CreateDate, CloseDate, TicketDesc, Email) VALUES ('0000', '1', 'new', 'new', NOW(), NULL, '$issue', '$email')";
                
            if ($conn->query($sql) === TRUE) {
                 // Redirect to a success page or display a success message
                header("Location: ticketSearch.html");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

    
    ?>

    
</body>
</html>