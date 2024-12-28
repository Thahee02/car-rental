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