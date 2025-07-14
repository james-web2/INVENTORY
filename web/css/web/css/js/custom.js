$(document).ready(function () {
    let isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';

    if (isCollapsed) {
        $('#sidebar').addClass('collapsed');
        $('#topbar').addClass('collapsed');
        $('#mainContent').addClass('collapsed');
        $('#footer').addClass('collapsed');
    }

    $('#toggleSidebar').on('click', function () {
        $('#sidebar').toggleClass('collapsed');
        $('#topbar').toggleClass('collapsed');
        $('#mainContent').toggleClass('collapsed');
        $('#footer').toggleClass('collapsed');

        // Save state to localStorage so it remembers
        const collapsed = $('#sidebar').hasClass('collapsed');
        localStorage.setItem('sidebar-collapsed', collapsed);
    });
});
