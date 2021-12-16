document.addEventListener('DOMContentLoaded', (e) => {
    window.onscroll = function(e) {
        let header = document.getElementById('header');
        console.log(window.scrollY);
        if (window.scrollY > 60) {
            header.classList.add('transparent');
            header.style.padding = '10px';
            console.log('Маленькоке');
        } else if (window.scrollY <= 40) {
            header.classList.remove('transparent');
            header.style.padding = '20px';
            console.log('Большое');
        }
    }
});