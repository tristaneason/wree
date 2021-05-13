document.querySelector('#mobileNavIcon').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('body').classList.toggle('mobile-nav-active');
    document.querySelector('#mobileNavContainer').classList.toggle('hidden');
    document.querySelector('#mobileNavIcon .fa-bars').classList.toggle('hidden');
    document.querySelector('#mobileNavIcon .fa-times').classList.toggle('hidden');
});
