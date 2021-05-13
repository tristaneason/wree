var navIcon = document.querySelector('#mobileNavIcon');
var navContainer = document.querySelector('#mobileNavContainer');

navIcon.addEventListener('click', function(e) {
    e.preventDefault();
    navContainer.classList.toggle('hidden');
    document.querySelector('body').classList.toggle('mobile-nav-active');
});
