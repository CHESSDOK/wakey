
document.addEventListener('DOMContentLoaded', function () {
    const burger = document.getElementById('burger');
    const menu = document.querySelector('.menu');

    burger.addEventListener('change', function () {
        if (this.checked) {
            menu.classList.add('active');
        } else {
            menu.classList.remove('active');
        }
    });

    const links = document.querySelectorAll('.menu li a');

    links.forEach(link => {
        link.addEventListener('click', function (event) {
            // Remove 'active' class from all links
            links.forEach(otherLink => {
                otherLink.classList.remove('active');
            });

            // Add 'active' class to the clicked link
            link.classList.add('active');

            // Navigate to the href of the clicked link
            const href = link.getAttribute('href');
            if (href && href !== '#') {
                event.preventDefault(); // Prevent default link behavior
                // Navigate to the href
                window.location.href = href;
            }
        });
    });
});
document.getElementById("loginButton").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default link behavior

    // Change the URL after the transition ends
    setTimeout(function () {
        window.location.href = "html/login.html";
    }, 300); // Adjust the delay according to your transition duration

    // Adding the class to initiate the fade-in and slide-up animation
    document.body.classList.add('fade-in');
});

document.getElementById("signup").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default link behavior

    // Change the URL after the transition ends
    setTimeout(function () {
        window.location.href = "../html/register.html";
    }, 300); // Adjust the delay according to your transition duration

    // Adding the class to initiate the fade-in and slide-up animation
    document.body.classList.add('fade-in');
});

 



