<head>
    <link rel="stylesheet" href="style.css">
    <!-- link to icons -->
    <script src="https://kit.fontawesome.com/cb5760a305.js" crossorigin="anonymous"></script>
        <!-- Include the notification.js file -->
    <!-- <script src="notif.js"></script> -->
    <!-- // Call updateNotificationsContainer when the page loads -->
    <!-- <script> window.addEventListener("load", updateNotificationsContainer);</script> -->

</head>

<div class = "barUp">
<button class = "notifButton" id="notifButton">Show Notifications</button>
</div>
<script src="notif.js"></script>
<script> window.addEventListener("load", updateNotificationsContainer);</script>
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

    <!-- <div  id="notificationsContainer"> -->
    <!-- Notifications will be displayed here -->
    <!-- </div> -->
</div>