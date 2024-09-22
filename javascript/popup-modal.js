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
