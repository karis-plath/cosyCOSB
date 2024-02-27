<html>
 
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>

    <body id ="blur">
        <div>
            <div id ="clear">
                <h1>Login</h1>
                <form method=POST>
                    <div>
                        <input id="user" type="text" name="user" placeholder="Username">
                    </div>
                    <div>
                        <input id="pass" type="password" name="pass" placeholder="Password">
                    </div>
                    <button name="sub" type="submit">Login</button>
                    <button name="submitNew" type="submit">Guest</button>
                </form>
            </div>
        </div>

        <?php
            // Report all error information on the webpage
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // submitting new user and pass
            if (isset($_POST["submitNew"])) {
                // go to the guest page
            }
        
            if (isset($_POST['sub'])) {
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
                $sql = "SELECT * FROM employee";
        
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { // info about query"https://www.w3schools.com/php/php_mysql_select.asp
                        if ($row["Employee_ID"] == $name) {
                            $check = 1;
                            if ($row["Password"] != $pass) {
                                echo '<script>alert("Username does not match password")</script>';
                            } else {
                                echo "connected";
                                session_start();
                                $_SESSION["Username"] = $name;
                                header("Location: ticketSearch.html");
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