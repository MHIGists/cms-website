import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function loadingScreen(){
    // JavaScript for Loading Screen
    document.addEventListener('DOMContentLoaded', function () {
        // Get the button element
        var buttons = document.getElementsByClassName('loading-button');

        // Add event listener to the button
        Array.from(buttons).forEach(function (button){
            button.addEventListener('click', function () {
                // Show loading screen when the button is clicked
                document.getElementById('loading-screen').style.display = 'flex';

            });
        })
    });
}
function reorderTable() {
    var table = document.getElementById('dataTable');
    var rows = Array.from(table.rows).slice(1); // Exclude the header row

    // Sort the rows based on the third octet of the IP address
    rows.sort(function(a, b) {
        var ipA = getIpAddress(a.cells[6].textContent); // Get IP address from 7th column
        var ipB = getIpAddress(b.cells[6].textContent); // and get the third octet
        return parseInt(ipA[2]) - parseInt(ipB[2]); // Compare third octets as numbers
    });

    // Reorder the rows in the table
    rows.forEach(function(row) {
        table.appendChild(row);
    });
}

// Function to extract IP address from a string and split it into octets
function getIpAddress(ipString) {
    if (ipString.trim() === '') return ['','','','']; // Return empty array if string is empty
    return ipString.split('.');
}
loadingScreen();
reorderTable();
