// connects editTicket.php and menu
function saveChanges(ticketNumber) {
    var message = "An update has been made to ticket " + ticketNumber;
    var link = "ticketDetails.php?id=" + ticketNumber;
    showNotification(message, link);
}

// Function to show the notification
function showNotification(message, link) {
    // store notifs in session
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || []; 
    notifications.unshift({ message: message, link: link });
    sessionStorage.setItem("notifications", JSON.stringify(notifications));
    updateNotificationsContainer();
}


// Function to update the notifications container
function updateNotificationsContainer() {
    var notificationsContainer = document.getElementById("notificationsContainer");
    notificationsContainer.innerHTML = ""; // Clear the notifications container

    // Retrieve notifications from session storage
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || [];

    // add each notif to container
    notifications.forEach(function(notification) {
        var notificationElement = document.createElement("a");
        notificationElement.href = notification.link;
        notificationElement.classList.add("notification");
        notificationElement.innerHTML = notification.message;
        notificationsContainer.appendChild(notificationElement);
    });
}

// creates pop-up for notifs
function showNotificationsPopup() {
    // Retrieve notifications
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || [];

    // Create the pop-up
    var popup = document.createElement("div");
    popup.classList.add("popup");

    // Create a close button
    var closeButton = document.createElement("span");
    closeButton.classList.add("close");
    closeButton.innerHTML = "&times;";
    closeButton.onclick = function() {
        document.body.removeChild(popup);
    };
    popup.appendChild(closeButton);

    // Create a container for the notifications in the pop-up
    var notificationsContainer = document.createElement("div");
    notificationsContainer.classList.add("notifications-container");

    // Loop through the notifications and add them to the notifications container
    notifications.forEach(function(notification) {
        var notificationElement = document.createElement("a");
        notificationElement.href = notification.link;
        notificationElement.classList.add("notification");
        notificationElement.innerHTML = notification.message;
        notificationsContainer.appendChild(notificationElement);
    });

    // add notifs to container
    popup.appendChild(notificationsContainer);
    document.body.appendChild(popup);
}

// listener for notif button
document.getElementById("notifButton").addEventListener("click", showNotificationsPopup);




