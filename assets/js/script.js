// Function to toggle side menu for small devices
function toggleMenu() {
    const sideMenu = document.getElementById('sideMenu');
    const currentLeft = sideMenu.style.left;
    
    if (currentLeft === '0px') {
        sideMenu.style.left = '-250px';
    } else {
        sideMenu.style.left = '0px';
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

// submenu toggle function
let submenu = false;
let submenuEl = document.querySelector('.submenu');
function toggleSubmenu() {
    submenu = !submenu
    if (submenu) {
        submenuEl.style.display = 'flex'
    }
    else{
        submenuEl.style.display = 'none'
    }

    console.log(submenu);
    
}


// slider 
const track = document.getElementById('slider-track');
const prevButton = document.getElementById('prev-btn');
const nextButton = document.getElementById('next-btn');
let position = 0;

const cardWidth = document.querySelector('.product-card').offsetWidth + 20;

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
        paymentIcons.style.display = "block";  
        cardDetails.style.display = "block";   
        cvvDetails.style.display = "block";    
    } else {
        paymentIcons.style.display = "none";   
        cardDetails.style.display = "none";    
        cvvDetails.style.display = "none";     
    }
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
            idCell.textContent = index + 1; 
        }
    });
});

