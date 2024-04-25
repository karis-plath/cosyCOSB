// Function to save changes
function saveChanges() {
    // Your save changes logic here

    // Example notification message and link
    var ticketNumber = "123"; // Replace this with your actual ticket number
    var message = "An update has been made to ticket " + ticketNumber;
    var link = "ticket.php?id=" + ticketNumber; // Example link to the ticket
    showNotification(message, link);
}

