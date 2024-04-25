// Function to show the dropdown
function showDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Function to show the notification
function showNotification(message, link) {
    var notificationsContainer = document.getElementById("notificationsContainer");

    // Create a new notification element
    var notification = document.createElement("a");
    notification.href = link; // Set the link for the notification
    notification.classList.add("notification");
    notification.innerHTML = message;

    // Append the notification to the notifications container
    notificationsContainer.appendChild(notification);
}

// Function to save changes
function saveChanges() {
    // Your save changes logic here

    // Example notification message and link
    var ticketNumber = "123"; // Replace this with your actual ticket number
    var message = "An update has been made to ticket " + ticketNumber;
    var link = "ticket.php?id=" + ticketNumber; // Example link to the ticket
    showNotification(message, link);
}

