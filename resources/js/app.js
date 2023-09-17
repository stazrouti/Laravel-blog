import './bootstrap';
/* scroll categoris js */
document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.categories-container');
    const scrollLeftButton = document.querySelector('#scroll-left');
    const scrollRightButton = document.querySelector('#scroll-right');

    // Set the scroll amount in pixels
    const scrollAmount = 200;

    scrollLeftButton.addEventListener('click', function () {
        container.scrollBy(-scrollAmount, 0);
    });

    scrollRightButton.addEventListener('click', function () {
        container.scrollBy(scrollAmount, 0);
    });
});
