            // Get modal and button elements for viewing profile
            const moduleModal = document.getElementById('moduleModal');
            const closeModuleBtn = document.querySelector('.closeBtn');
        
            // Open profile modal and load data via AJAX
            $(document).on('click', '#moduleBtn', function(e) {
                e.preventDefault();
                const moduleId = $(this).data('module-id');
                
                $.ajax({
                    url: 'upload_modules.php',
                    method: 'GET',
                    data: { module_id: moduleId },
                    success: function(response) {
                        $('#uploadModuleContent').html(response);
                        moduleModal.style.display = 'flex';
                    }
                });
            });
        
            // Close profile modal when 'x' is clicked
            closeModuleBtn.addEventListener('click', function() {
                moduleModal.style.display = 'none';
            });
        
            // Close profile modal when clicking outside the modal content
            window.addEventListener('click', function(event) {
                if (event.target === moduleModal) {
                    moduleModal.style.display = 'none';
                }
            });
        