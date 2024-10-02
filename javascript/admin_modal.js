const modal = document.getElementById('courseModal');
const openBtn = document.getElementById('openCourseBtn');
const closeBtn = document.querySelector('.closeBtn');

// Open modal and set applicant_id in hidden field
openBtn.addEventListener('click', function() {

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
            const moduleModal = document.getElementById('moduleModal');
            const seccloseModuleBtn = document.querySelector('.seccloseBtn');
        
            // Open profile modal and load data via AJAX
            $(document).on('click', '#moduleBtn', function(e) {
                e.preventDefault();
                const moduleId = $(this).data('module-id');
                
                $.ajax({
                    url: 'upload_modules.php',
                    method: 'GET',
                    data: { module_id: moduleId},
                    success: function(response) {
                        $('#uploadModuleContent').html(response);
                        moduleModal.style.display = 'flex';
                    }
                });
            });
        
            // Close profile modal when 'x' is clicked
            seccloseModuleBtn.addEventListener('click', function() {
                moduleModal.style.display = 'none';
            });
        
            // Close profile modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === moduleModal) {
                    moduleModal.style.display = 'none';
                }
            });
        

    // Module list for file and video
