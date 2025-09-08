document.addEventListener('DOMContentLoaded', function () {
    const filtersSelect = document.getElementById('profile-add-good-cont-form-filters');
    const selectedFiltersContainer = document.getElementById('selected-filters-container');
    const hiddenFiltersInput = document.getElementById('hidden-filters-input');

    let selectedFilters = [];

    filtersSelect.addEventListener('change', function () {
        const selectedValue = this.value;

        if (selectedValue && selectedValue !== 'choose' && !selectedFilters.includes(selectedValue)) {
            selectedFilters.push(selectedValue);
            updateSelectedFilters();
            this.selectedIndex = 0;
            console.log(selectedFilters);
        }
    });

    function updateSelectedFilters() {
        selectedFiltersContainer.innerHTML = '';
        selectedFilters.forEach(filter => {
            const filterTag = document.createElement('div');
            filterTag.className = 'filter-tag';
            filterTag.textContent = filter;

            const closeBtn = document.createElement("div");
            closeBtn.className = "filter-tag-close";
            
            closeBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
            <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 
            L 6.21875 40.96875 L 9.03125 43.78125 
            L 25 27.84375 L 40.9375 43.78125 
            L 43.78125 40.9375 L 27.84375 25 
            L 43.6875 9.15625 L 40.84375 6.3125 
            L 25 22.15625 Z"/>
            </svg>
            `;
            closeBtn.addEventListener('click', function () {
                selectedFilters = selectedFilters.filter(f => f !== filter); // пересоздание массива
                updateSelectedFilters();
            });


            switch (filterTag.textContent) {
                case 'technique':
                    console.log('22');
                    filterTag.style.backgroundColor = '#FF9999';
                    break;
                case 'rofl':
                    filterTag.style.backgroundColor = '#99CCFF';
                    break;
                case 'clothes':
                    filterTag.style.backgroundColor = '#FF99CC';
                    break;
            }

            filterTag.appendChild(closeBtn);
            selectedFiltersContainer.appendChild(filterTag);
        });

        hiddenFiltersInput.value = selectedFilters.join(',');
        console.log(hiddenFiltersInput);
    }
});
