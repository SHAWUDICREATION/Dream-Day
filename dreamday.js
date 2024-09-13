// Function to toggle between Login and Register form
function toggleForm(formType) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    if (formType === 'login') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    }
}

// Function for slider logic
document.addEventListener('DOMContentLoaded', () => {
    let slider = document.querySelector('.slider .list');
    let items = document.querySelectorAll('.slider .list .item');
    let next = document.getElementById('next');
    let prev = document.getElementById('prev');
    let dots = document.querySelectorAll('.slider .dots li');

    if (!next || !prev) {
        console.error('Next or Prev button not found!');
        return;
    }

    let lengthItems = items.length - 1;
    let active = 0;

    function reloadSlider() {
        slider.style.left = -items[active].offsetLeft + 'px';

        let last_active_dot = document.querySelector('.slider .dots li.active');
        if (last_active_dot) {
            last_active_dot.classList.remove('active');
        }
        if (dots[active]) {
            dots[active].classList.add('active');
        }

        clearInterval(refreshInterval);
        refreshInterval = setInterval(() => { next.click() }, 3000);
    }

    next.onclick = function () {
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    }

    prev.onclick = function () {
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    }

    let refreshInterval = setInterval(() => { next.click() }, 3000);

    dots.forEach((li, key) => {
        li.addEventListener('click', () => {
            active = key;
            reloadSlider();
        });
    });

    // Debounce resize event
    let resizeTimeout;
    window.onresize = function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            reloadSlider();
        }, 250); // Adjust debounce delay as needed
    };

    // Add event listener to the login form
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        
        const username = loginForm.querySelector('input[type="text"]').value;
        const password = loginForm.querySelector('input[type="password"]').value;

        if (username && password) {
            window.location.href = 'homepage.html'; 
        } else {
            alert("Please enter valid credentials");
        }
    });
});
