// Function to toggle side menu for small devices
function toggleMenu() {
    const sideMenu = document.getElementById('sideMenu');
    const currentLeft = sideMenu.style.left;
    
    if (currentLeft === '0px') {
        sideMenu.style.left = '-250px'; // Hide the menu
    } else {
        sideMenu.style.left = '0px'; // Show the menu
    }
}

// Function to highlight the active menu item
const menuItems = document.querySelectorAll('.menu-item, .side-menu-item');

menuItems.forEach(item => {
    item.addEventListener('click', () => {
        // Remove active class from all menu items
        menuItems.forEach(menuItem => menuItem.classList.remove('active'));
        
        // Add active class to the clicked menu item
        item.classList.add('active');
    });
});

const track = document.getElementById('slider-track');
const prevButton = document.getElementById('prev-btn');
const nextButton = document.getElementById('next-btn');
let position = 0;

const cardWidth = document.querySelector('.product-card').offsetWidth + 20; // Including margin

prevButton.addEventListener('click', () => {
    position += cardWidth;
    if (position > 0) position = 0;
    track.style.transform = `translateX(${position}px)`;
});

nextButton.addEventListener('click', () => {
    const maxScroll = -(track.scrollWidth - track.parentElement.offsetWidth);
    position -= cardWidth;
    if (position < maxScroll) position = maxScroll;
    track.style.transform = `translateX(${position}px)`;
});

function showCardFields() {
    var paymentMethod = document.getElementById("payment-method").value;
    var cardDetails = document.getElementById("card-details");
    var cvvDetails = document.getElementById("cvv-details");
    var paymentIcons = document.getElementById("payment-icons");

    // Show/hide card fields based on payment method selection
    if (paymentMethod === "credit-card" || paymentMethod === "debit-card") {
        paymentIcons.style.display = "block";  // Show Visa/MasterCard options
        cardDetails.style.display = "block";   // Show card number input
        cvvDetails.style.display = "block";    // Show CVV input
    } else {
        paymentIcons.style.display = "none";   // Hide Visa/MasterCard options
        cardDetails.style.display = "none";    // Hide card number input
        cvvDetails.style.display = "none";     // Hide CVV input
    }
}

// toggle submenu
function toggleSubmenu() {
    const submenu = document.getElementById('submenu');
    submenu.classList.toggle('hidden');
}

// Placeholder functionality for buttons
document.getElementById('save-info').addEventListener('click', () => alert('Personal information saved!'));
document.getElementById('cancel-info').addEventListener('click', () => alert('Changes canceled!'));
document.querySelectorAll('.cancel-order').forEach(button => {
    button.addEventListener('click', (e) => {
        e.target.parentElement.remove();
        alert('Order canceled!');
    });
});
document.getElementById('change-password-form').addEventListener('submit', (e) => {
    e.preventDefault();
    alert('Password changed successfully!');
});

// admin users table auto increment id
document.addEventListener("DOMContentLoaded", () => {
    const rows = document.querySelectorAll(".admin-users-display-section tbody tr");
    rows.forEach((row, index) => {
        const idCell = row.querySelector("td#rowId");
        if (idCell) {
            idCell.textContent = index + 1; // Set row number
        }
    });
});

