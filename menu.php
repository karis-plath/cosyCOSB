<head>
    <link rel="stylesheet" href="style.css">
    <!-- link to icons -->
    <script src="https://kit.fontawesome.com/cb5760a305.js" crossorigin="anonymous"></script>
</head>

<div class = "barUp">
    <div class="dropdown">
        <button onclick="showDropdown()" class="dropbtn"><i class="fa-solid fa-bell fa-2xl" style="color: #ffffff;"></i></button>
        <div id="myDropdown" class="dropdown-content">
            <a href="#">Link 1</a>
            <a href="#">Link 2</a>
            <a href="#">Link 3</a>
        </div>
    </div>
</div>

<div class="sidenav">
<h2><i class="fa-solid fa-ticket fa-2xl" style="color: #ffffff;"></i>  Tech-It</h2>
    <?php
        session_start();
        if($_SESSION['User_Type'] == 'admin' || $_SESSION['User_Type'] == 'tech'){
            echo '<a href="techSearch.php">Search</a>';
            echo '<a href="queue.php">Queue</a>';
            
        }
    ?>
    
    <a href="docs.php">Docs</a>
    <a href="ticketSearch.php">Tickets</a>
    <a href="createTicket.php">Create Tickets</a>
    <form action="logout.php" method="post">
        <input type="submit" class="logoutBtn" name="logout" value="Logout"></input>
    </form>
</div>

<script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    function showDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
    }
</script>