// Search Form Handler
document.addEventListener('DOMContentLoaded', function() {
    // Handle destination selection
    const destinationOptions = document.querySelectorAll('.option-list-destination li');
    const destinationInput = document.getElementById('selected-destination');
    const destinationDisplay = document.querySelector('.destination-dropdown .input-field-value .destination h6');
    
    destinationOptions.forEach(option => {
        option.addEventListener('click', function() {
            const destinationName = this.querySelector('.destination h6').textContent;
            destinationInput.value = destinationName;
            destinationDisplay.textContent = destinationName;
            
            // Close dropdown
            this.closest('.custom-select-wrap').style.display = 'none';
        });
    });

    // Handle day selection
    const dayOptions = document.querySelectorAll('.option-list .single-item');
    const dayInput = document.getElementById('selected-day');
    const dayDisplay = document.querySelector('.custom-select-dropdown input[readonly][value="1"]');
    
    dayOptions.forEach(option => {
        option.addEventListener('click', function() {
            const dayValue = this.querySelector('h6').textContent;
            dayInput.value = dayValue;
            dayDisplay.value = dayValue;
            
            // Close dropdown
            this.closest('.custom-select-wrap').style.display = 'none';
        });
    });

    // Handle type selection (Private/Sharing/Group)
    const typeOptions = document.querySelectorAll('.option-list .single-item');
    const typeInput = document.getElementById('selected-type');
    const typeDisplay = document.querySelector('.custom-select-dropdown input[readonly][value="Private Tour"]');
    
    // Filter type options (exclude day options)
    const typeOnlyOptions = Array.from(typeOptions).filter(option => {
        const text = option.querySelector('h6').textContent;
        return text.includes('Tour') || text.includes('Private') || text.includes('Sharing');
    });
    
    typeOnlyOptions.forEach(option => {
        option.addEventListener('click', function() {
            const typeName = this.querySelector('h6').textContent;
            let typeValue = 'private';
            
            if (typeName.toLowerCase().includes('sharing')) {
                typeValue = 'sharing';
            } else if (typeName.toLowerCase().includes('group')) {
                typeValue = 'group';
            }
            
            typeInput.value = typeValue;
            if (typeDisplay) {
                typeDisplay.value = typeName;
            }
            
            // Close dropdown
            this.closest('.custom-select-wrap').style.display = 'none';
        });
    });

    // Handle search form submission
    const searchForm = document.querySelector('.filter-input.show');
    const searchButton = searchForm.querySelector('.primary-btn1');
    
    searchButton.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get current values from UI
        const destination = destinationInput.value || destinationDisplay.textContent;
        const day = dayInput.value || '1';
        const type = typeInput.value || 'private';
        
        // Set hidden input values
        if (destination && destination !== 'Where are you going?' && destination !== 'No Destination Yet') {
            destinationInput.value = destination;
        }
        dayInput.value = day;
        typeInput.value = type;
        
        // Submit form
        searchForm.submit();
    });

    // Handle dropdown toggles
    document.querySelectorAll('.custom-select-dropdown').forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            const wrap = this.nextElementSibling;
            if (wrap && wrap.classList.contains('custom-select-wrap')) {
                const isVisible = wrap.style.display === 'block';
                
                // Close all other dropdowns
                document.querySelectorAll('.custom-select-wrap').forEach(w => {
                    w.style.display = 'none';
                });
                
                // Toggle current dropdown
                wrap.style.display = isVisible ? 'none' : 'block';
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.single-search-box')) {
            document.querySelectorAll('.custom-select-wrap').forEach(wrap => {
                wrap.style.display = 'none';
            });
        }
    });
});