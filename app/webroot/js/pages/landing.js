$(document).ready(function() {
    // This command is used to initialize some elements and make them work properly
    $('#sidebar').simpleSidebar({
        opener: '.sidebar-button',
        wrapper: '#wrapper',
        sidebar: {
            align: 'left', //or 'right' - This option can be ignored, the sidebar will automatically align to right.
            closingLinks: '.close-sidebar'
        }
    });
});
