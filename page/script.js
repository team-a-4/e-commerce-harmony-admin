const categoryDropdown = document.getElementById('category');
        let selectedCategory = null;

        categoryDropdown.addEventListener('change', function () {
            selectedCategory = categoryDropdown.value;
            console.log('Selected Category:', selectedCategory);
});