// Function to save changes
function saveChanges(ticketNumber) {
    // Your save changes logic here

    // Example notification message and link
    var message = "An update has been made to ticket " + ticketNumber;
    var link = "ticketDetails.php?id=" + ticketNumber; // Example link to the ticket
    showNotification(message, link);
}

// Function to show the notification
function showNotification(message, link) {
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || []; // Retrieve notifications from session storage or initialize an empty array
    notifications.unshift({ message: message, link: link }); // Add the new notification to the beginning of the array
    sessionStorage.setItem("notifications", JSON.stringify(notifications)); // Store the updated notifications array in session storage

    // Update the notifications container
    updateNotificationsContainer();
}


// Function to update the notifications container
function updateNotificationsContainer() {
    var notificationsContainer = document.getElementById("notificationsContainer");
    notificationsContainer.innerHTML = ""; // Clear the notifications container

    // Retrieve notifications from session storage
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || [];

    // Loop through the notifications and add them to the notifications container
    notifications.forEach(function(notification) {
        var notificationElement = document.createElement("a");
        notificationElement.href = notification.link;
        notificationElement.classList.add("notification");
        notificationElement.innerHTML = notification.message;
        notificationsContainer.appendChild(notificationElement);
    });
}

// Function to show the pop-up with notifications
function showNotificationsPopup() {
    // Retrieve notifications from session storage
    var notifications = JSON.parse(sessionStorage.getItem("notifications")) || [];

    // Create the pop-up element
    var popup = document.createElement("div");
    popup.classList.add("popup");

    // Create a close button for the pop-up
    var closeButton = document.createElement("span");
    closeButton.classList.add("close");
    closeButton.innerHTML = "&times;"; // Display 'x' for the close button
    closeButton.onclick = function() {
        // Close the pop-up when the close button is clicked
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

    // Append the notifications container to the pop-up
    popup.appendChild(notificationsContainer);

    // Append the pop-up to the body
    document.body.appendChild(popup);
}

// Add event listener to the button to show the pop-up
document.getElementById("notifButton").addEventListener("click", showNotificationsPopup);




