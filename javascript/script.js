
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

//a_profile
const employmentStatus = document.getElementById('employment-status');
        const subDropdown = document.getElementById('sub-dropdown');
        const employmentType = document.getElementById('employment-type');

        employmentStatus.addEventListener('change', function() {
            const value = this.value;

            if (value === 'employed') {
                subDropdown.style.display = 'block';
                employmentType.innerHTML = `
                    <option value="">Select</option>
                    <option value="wage">Wage Employed</option>
                    <option value="self">Self Employed</option>
                `;
            } else if (value === 'unemployed') {
                subDropdown.style.display = 'block';
                employmentType.innerHTML = `
                    <option value="">Select</option>
                    <option value="resigned">Resigned</option>
                    <option value="retired">Retired</option>
                `;
            } else {
                subDropdown.style.display = 'none';
                employmentType.innerHTML = '<option value="">Select</option>'; // Reset sub-dropdown
            }
        });

        // Hide sub-dropdown on page load if no selection
        window.onload = function() {
            subDropdown.style.display = 'none';
        };
