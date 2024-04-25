<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include ("menu.php")?>
    <script src="notif.js"></script>
    <div class="createTicket">
        <div>
            <div class="title">
                <h1>Edit Ticket</h1>
        </div>
        <div class="container">
            <form action="editTicket.php" method="post">
                <div class="ep">
                    <div class="">
                        <?php
                            if(isset($_SESSION["User_ID"])) {
                                $User_ID = $_SESSION["User_ID"];
                                $ticket_id = $_SESSION['ticket_id'];
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
                                
                                $stmt = $conn->prepare("SELECT TicketDesc FROM ticket WHERE Ticket_ID = ?");
                                $stmt->bind_param("i", $ticket_id);
                                $stmt->execute();
                                $stmt->bind_result($ticket_desc);

                                // Fetch the result
                                $stmt->fetch();

                                // Close the statement
                                $stmt->close();

                                // Display ticket details in editable textareas
                                echo '<br><br>';
                                echo '<label for="ticket_desc">Ticket Description:</label>';
                                echo '<br> <br>';
                                echo '<textarea id="ticket_desc" name="ticket_desc" required>' . $ticket_desc . '</textarea>';
                                echo '<br>';
                                echo'<button type="submit" name="save_changes" onclick="saveChanges('. $ticket_id . ')">Save Changes</button>';

                                if(isset($_POST['save_changes'])){
                                    $ticket_id = $_SESSION['ticket_id'];
                                    $edited_desc = $_POST['ticket_desc'];

                                    $stmt = $conn->prepare("UPDATE ticket SET TicketDesc = ? WHERE Ticket_ID = ?");
                                    $stmt->bind_param("si", $edited_desc, $ticket_id);

                                    if ($stmt->execute()) {
                                        echo "Ticket description updated successfully!";
                                      } else {
                                        echo "Error updating ticket description: " . $conn->error;
                                      }
                                  
                                      // Close the statement and connection
                                      $stmt->close();
                                      $conn->close();
                                    //   header("Location: queue.php");

                                }
                            }
                            else {
                                header("Location: login.php");
                                exit();
                            }
                        ?>
                </div>
        </div>

    
</body>
</html>