<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician</title>
    <link rel="stylesheet" href="style.css">
</head>

<script>
    function updateSearch(){

        var dropdown = document.getElementById("searchFor");
        var selectedIndex = dropdown.selectedIndex;
        var selectedOption = dropdown.options[selectedIndex];

        console.log("Selected text:", selectedOption.text)
        
        if (selectedOption.text == "Ticket") {
            console.log("Dropdown selection changed!")
            document.getElementById('myDropdown').hidden = true;
            document.getElementById('searchbox').placeholder = "Ticket Number";
        }
        else if (selectedOption.text == "People") {
            document.getElementById('myDropdown').hidden = false;
            document.getElementById('searchbox').placeholder = "First Name or Last Name";
        }
     }

</script>

<body>

    <?php include ("menu.php")?>
    <div class="title">
        <h1>Search Tickets or People</h1>
    </div>
    
    <div class="main-content">

        <form method=POST>
            <div class="searchbar">
                <label>Search For:</label>
                <select name="searchFor" id="searchFor" onchange ="updateSearch()">
                    <option value="searchPeople">People</option>
                    <option value="searchTicket">Ticket</option>
                </select>
                <label>Search By:</label>
                <select name="myDropdown" id="myDropdown">
                    <option value="option1">Name</option>
                    <option value="option2">Employee ID</option>
                </select>
                <input type="search" name="searchbox" id="searchbox" size="100"  placeholder="First Name or Last Name">
                <input type="submit" value="Search" name="searchbtn" id="searchbtn">
            </div>
        </form>
    
        <div class="results">
        <?php
                if(isset($_POST['searchbtn'])){
                    $search = $_POST['searchbox'];
                    $selectedOption = $_POST['searchFor'];
                    $selectedsearchby = $_POST['myDropdown'];
                    $searchwithwildcards = "%$search%";
                
                    if (isset($search)) {
                        if ($selectedOption == 'searchPeople') { //by name
                            // Perform search by name

                            if (isset($_SESSION["User_ID"])) {
                                
                                if($selectedsearchby == 'option1'){
                                    $pdo = new PDO("mysql:host=localhost;dbname=cs410_final", "admin", "admin");
                                    $statement = $pdo->prepare("SELECT * FROM user WHERE (Fname LIKE ? OR Lname LIKE ? OR Fname LIKE ? AND Lname LIKE ?)");
                                    $statement->execute([$searchwithwildcards, $searchwithwildcards, $searchwithwildcards, $searchwithwildcards]);
    
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                                    // Process the results (e.g., display first names)
                                    foreach ($results as $row) {
                                        $Fname = $row['Fname'];
                                        $Lname = $row['Lname'];
                                        $Userid = $row['UserID'];
                                        $Usertype = $row['UserType'];
                                    
                                        echo '<a class="ticketDetail"><button>' . 
                                        '<span style="margin-left: 20px; float: left;">' . $row['UserID'] . '</span>' . 
                                        '<span style="margin-right: 20px; float: right;">' . $row["UserType"] . '</span>' .
                                        '<span style="margin-left: 25px; float: left;">' . $row["Fname"] . '</span>' . 
                                        '<span style="margin-left: 25px; float: left;">' . $row['Lname'] . '</span>' .  
                                        '</button></a><br>';
                                    }
                                }
                                else if ($selectedsearchby == 'option2'){
                                    $pdo = new PDO("mysql:host=localhost;dbname=cs410_final", "admin", "admin");
                                    $statement = $pdo->prepare("SELECT * FROM user WHERE UserID LIKE ?");
                                    $statement->execute([$searchwithwildcards]);
    
                                    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($results as $row) {
                                        $Fname = $row['Fname'];
                                        $Lname = $row['Lname'];
                                        $Userid = $row['UserID'];
                                        $Usertype = $row['UserType'];
                                    
                                        echo '<a class="ticketDetail"><button>' . 
                                        '<span style="margin-left: 20px; float: left;">' . $row['UserID'] . '</span>' . 
                                        '<span style="margin-right: 20px; float: right;">' . $row["UserType"] . '</span>' .
                                        '<span style="margin-left: 25px; float: left;">' . $row["Fname"] . '</span>' . 
                                        '<span style="margin-left: 25px; float: left;">' . $row['Lname'] . '</span>' .  
                                        '</button></a><br>';
                                }

                            }

                        } 
                        }
                        else if ($selectedOption == "searchTicket") { //by ticket
                            // Perform search by ticket ID

                            $pdo = new PDO("mysql:host=localhost;dbname=cs410_final", "admin", "admin");
                            $statement = $pdo->prepare("SELECT * FROM ticket WHERE Ticket_ID LIKE ?");
                            $statement->execute([$searchwithwildcards]);

                            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($results as $row) {
                                $TID = $row['Ticket_ID'];
                                $UserID = $row['UserID'];
                                $Importance= $row['Importance'];
                                $Status = $row['Status'];
                                $CreateDate = $row['CreateDate'];
                            
                                echo '<a class="ticketDetail" href="ticketDetails.php?id=' . $row['Ticket_ID'] . '"><button>' . 
                                '<span style="margin-left: 20px; float: left;">' . $row['Ticket_ID'] . '</span>' . 
                                '<span style="margin-right: 20px; float: right;">' . $row["CreateDate"] . '</span>' .
                                '<span style="margin-right: 25px; float: right;">' . $row["Importance"] . '</span>' . 
                                '<span style="margin-right: 25px; float: right;">' . $row['Status'] . '</span>' . 
                                '<span style="margin-right: 25px; float: right;">' . $row["Queue"] . '</span>' . 
                                
                                '</button></a><br><br>';
                            }
                        }
                    }
                }
            ?>
        </div>
        
    </div>

</body>

</html>
