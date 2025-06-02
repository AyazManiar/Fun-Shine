const adminPanels = document.querySelectorAll('.admin-panel > li');
adminPanels.forEach(li => {
    const adminDropdown = li.querySelector('.admin-dropdown-btn');
    if (adminDropdown) {
        const adminDropdownImage = adminDropdown.querySelector('img');
        const adminDropdownContent = li.querySelector('.admin-dropdown-content')
        adminDropdown.addEventListener('click', () => {
            // Toggle height and rotate arrow
            if (adminDropdownContent.style.maxHeight === '0px' 
                || adminDropdownContent.style.maxHeight === '') 
            {
                adminDropdownContent.style.maxHeight = adminDropdownContent.scrollHeight + 'px';
                adminDropdownImage.style.transform = 'rotate(0deg)';
            } else {
                adminDropdownContent.style.maxHeight = '0px';
                adminDropdownImage.style.transform = 'rotate(90deg)';
            }
            
        });
    }
});
