// time.js

// Function to update the displayed time
function updateClock() {
    // Fetch the current date and time from the API
    fetch('api.php')
        .then(response => response.json())
        .then(data => {
            // Update the displayed time
            document.getElementById("clock").innerText = "Date and Time: " + data.dateTime;
        })
        .catch(error => console.error('Error fetching current date and time:', error));
}

// Update the clock initially
updateClock();

// Update the clock every second
setInterval(updateClock, 1000);
