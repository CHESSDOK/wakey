// Get elements
const burgerToggle = document.getElementById('burgerToggle');
const offcanvasMenu = new bootstrap.Offcanvas(document.getElementById('offcanvasMenu'));

// Toggle burger class and offcanvas menu
burgerToggle.addEventListener('click', function() {
    // Toggle burger active class for animation
    burgerToggle.classList.toggle('active');

    // Open or close the offcanvas menu
    if (offcanvasMenu._isShown) {
        offcanvasMenu.hide();
    } else {
        offcanvasMenu.show();
    }
});

$(document).ready(function(){
    // Initialize popover with multiple links in the content
    $('.profile-icon').popover({
        trigger: 'click', 
        html: true, // Allow HTML content
        animation: true, // Enable animation
        content: function() {
            return `
                <a class="link" href="html/applicant/a_profile.php"  id="emprof">Profile</a><br>
                <a class="link" href="index.html">Logout</a>
            `;
        }
    });
// Close popover when clicking outside
$(document).on('click', function (e) {
    const target = $(e.target);
    if (!target.closest('.profile-icon').length) {
        $('.profile-icon').popover('hide');
    }
});
});


document.getElementById("emprof").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent default link behavior

    // Change the URL after the transition ends
    setTimeout(function () {
      window.location.href = "html/applicant/a_profile.php";
    }, 300); // Adjust the delay according to your transition duration

    // Adding the class to initiate the fade-in and slide-up animation
    document.body.classList.add('fade-in');
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
