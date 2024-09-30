// Get modal and button elements
const modal = document.getElementById('formModal');
const openBtn = document.getElementById('openFormBtn');
const closeBtn = document.querySelector('.closeBtn');
const applicantIdField = document.getElementById('applicantId');
const anotherIdField = document.getElementById('jobid');

// Open modal and set applicant_id in hidden field
openBtn.addEventListener('click', function() {
  const applicantId = this.getAttribute('data-applicant-id');
  const jobid = this.getAttribute('data-job-id');
  
  // Set the applicant ID in the hidden field
  applicantIdField.value = applicantId;
  anotherIdField.value = jobid;

  // Open the modal
  modal.style.display = 'flex';
});

// Close modal when 'x' is clicked
closeBtn.addEventListener('click', function() {
  modal.style.display = 'none';
});

// Close modal when clicked outside of the modal content
window.addEventListener('click', function(event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

    // Get modal and button elements for viewing profile
    const profileModal = document.getElementById('profileModal');
    const closeProfileBtn = document.querySelector('.closeBtn');

    // Open profile modal and load data via AJAX
    $(document).on('click', '.openProfileBtn', function(e) {
        e.preventDefault();
        const applicantId = $(this).data('applicant-id');
        
        $.ajax({
            url: 'fetch_applicant_profile.php',
            method: 'GET',
            data: { applicant_id: applicantId },
            success: function(response) {
                $('#applicantProfileContent').html(response);
                profileModal.style.display = 'flex';
            }
        });
    });

    // Close profile modal when 'x' is clicked
    closeProfileBtn.addEventListener('click', function() {
        profileModal.style.display = 'none';
    });

    // Close profile modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target === profileModal) {
            profileModal.style.display = 'none';
        }
    });
