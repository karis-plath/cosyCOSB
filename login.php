<html>
 
    <head>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/cb5760a305.js" crossorigin="anonymous"></script>
        <title>Login</title>
    </head>

    <body class ="login">
        <div>
            <div class ="loginBox">
            <h1><i class="fa-solid fa-ticket fa-xl"></i></h1>
                <h1>Tech-It</h1>
                <form method=POST>
                    <input id="user" type="text" name="user" placeholder="Employee ID">
                    <input id="pass" type="password" name="pass" placeholder="Password">
                    <button name="sub" type="submit">Login</button>
                </form>
            </div>
        </div>

        <?php
            // Report all error information on the webpage
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // submitting new user and pass
        
            if (isset($_POST['sub'])) {
                //header("Location: gCreateTicket.php");
                $servername = "localhost";
                $useraccount = "admin"; 
                $password = "admin"; 
                $dbname = "cs410_final";
        
                // Create connection
                $conn = new mysqli($servername, $useraccount, $password, $dbname);
                $check = 0;

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
        
                // Use prepared statement in SQL
                $name = $_POST['user'];
                $pass = $_POST['pass'];
                $sql = "SELECT * FROM user";
        
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { 
                        if ($row["UserID"] == $name) {
                            $check = 1;
                            if ($row["Password"] != $pass) {
                                echo '<script>alert("Username does not match password")</script>';
                            } else {
                                echo "connected";
                                session_start();
                                $_SESSION["User_ID"] = $row["UserID"];
                                $_SESSION["User_Type"] = $row["UserType"];
                                header("Location: ticketSearch.php");
                                exit();
                            }
                        }
                    }
                    if ($check == 0) {
                        echo '<script>alert("Username does not exist")</script>';
                    }
                }
                $result->close();
                $conn->close();
            }
        ?>

    </body>
</html>