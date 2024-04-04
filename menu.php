<head>
        <link rel="stylesheet" href="style.css">
        <!-- link to icons -->
        <script src="https://kit.fontawesome.com/cb5760a305.js" crossorigin="anonymous"></script>
    </head>

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