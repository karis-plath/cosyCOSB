<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="sidenav">
            <?php
                session_start();
                if($_SESSION['User_Type'] == 'admin' || $_SESSION['User_Type'] == 'tech'){
                    echo '<a href="techSearch.php">Search</a>';
                    echo '<a href="queue.php">Queue</a>';
                }
            ?>
            <a href="#">Docs</a>
            <a href="ticketSearch.php">Tickets</a>
            <a href="createTicket.php">Create Tickets</a>
    </div>
    
    <div class="main-content">

        <div class="Header">
            <h1><b><u>Search All Tickets</u></b></h1>
        </div>

        <div class="searchbar">
            <label for="myDropdown">Search For:</label>
            <select id="myDropdown">
                <option value="option1">Name</option>
                <option value="option2">ID</option>
                <option value="option3">Status</option>
            <input type="search" name="searchbox" id="searchbox" size="100">
            <input type="button" value="Search" name="searchbtn" id="searchbtn">
        </div>

        <div class="labels">
            <label for="name">Name:</label>
            <label for="ID">ID:</label>
            <label for="Status">Status:</label>
        </div>
        

        <div class="results">
            <p onclick="">This is a testaskldfjhasldkfjhaskldjfhaskljdhfaksjldhfkjsdhlfkjsdhfhfjkhjdkf  dkjfhsajkfdhsakjdfh jksdhfajksdhfsjd fasjfhhdjsakhfskjdf la ajskdfhsdkfjh safjsda fkjshdfjsadhfsakduuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu</p>
            <p onclick="">This is a testaskldfjhasldkfjhaskldjfhaskljdhfaksjldhfkjsdhlfkjsdhfhfjkhjdkf  dkjfhsajkfdhsakjdfh jksdhfajksdhfsjd fasjfhhdjsakhfskjdf la ajskdfhsdkfjh safjsda fkjshdfjsadhfsakduuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu</p>
        </div>
        
    </div>

</body>

</html>
