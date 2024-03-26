<div class="sidenav">
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
        <input type="submit" class="inputBtn" name="logout" value="Logout">
    </form>
</div>