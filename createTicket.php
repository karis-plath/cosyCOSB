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
                            <?php
                                if (isset($_SESSION["User_ID"])) {
                                    $User_ID = $_SESSION["User_ID"];
                                
                                    
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

                                    
                                    //Retrieve First Name
                                    $stmt = $conn->prepare("SELECT Fname FROM user WHERE UserID = ?");
                                    $stmt->bind_param("i", $User_ID);
                                    $stmt->execute();
                                    $stmt->bind_result($Fname);

                                    // Fetch the result
                                    $stmt->fetch();

                                    // Close the statement and connection
                                    $stmt->close();

                                    echo '<label for="Fname">First Name: </label>';
                                    echo '<input type="text" id="Fname" name="Fname" value="' . $Fname . '" readonly>';

                                    //Retrieve Last Name
                                    $stmt = $conn->prepare("SELECT Lname FROM user WHERE UserID = ?");
                                    $stmt->bind_param("i", $User_ID);
                                    $stmt->execute();
                                    $stmt->bind_result($Lname);

                                    // Fetch the result
                                    $stmt->fetch();

                                    // Close the statement and connection
                                    $stmt->close();
                                    
                                    echo '<label for="Lname">Last Name: </label>';
                                    echo '<input type="text" id="Lname" name="Lname" value="' . $Lname . '" readonly>';


                                    //Retrieve Phone number
                                    $stmt = $conn->prepare("SELECT phone FROM user WHERE UserID = ?");
                                    $stmt->bind_param("i", $User_ID);
                                    $stmt->execute();
                                    $stmt->bind_result($phone);

                                    // Fetch the result
                                    $stmt->fetch();

                                    // Close the statement and connection
                                    $stmt->close();

                                    
                                    echo '<label for="email">Phone Number: </label>';
                                    echo '<input type="tel" id="phone" name="phone" value="' . $phone . '" readonly>';

                                    // Use prepared statement to retrieve email using Employee ID
                                    $stmt = $conn->prepare("SELECT Email FROM user WHERE UserID = ?");
                                    $stmt->bind_param("i", $User_ID);
                                    $stmt->execute();
                                    $stmt->bind_result($email);

                                    // Fetch the result
                                    $stmt->fetch();

                                    // Close the statement and connection
                                    $stmt->close();
                                    //$conn->close();

                                    echo '<label for="email">Email:</label>';
                                    echo '<input type="email" id="email" name="email" value="' . $email . '" readonly>';
                                }
                            ?>
                        </div>
                    </div>
                    <br>
                    <div>
                    <label for="pDrescription">Enter Problem Description:</label>
                    <br>
                    <br>
                    <textarea id="pDrescription" name="pDrescription" required placeholder="Computer is running slow"></textarea>
            </div>
            <div>
             <label for="Importance">Urgency: </label>
              <select id="importance" name="importance">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>

             <br>
                            
             <label for="Category">Category: </label>
             <select id="category" name="category">
                    <option value="none">None</option>
                    <option value="Placeholder2">Placeholder2</option>
                    <option value="Placeholder3">Placeholder3</option>
                </select>
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

