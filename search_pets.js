document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('search-pets');
  const typeFilter = document.getElementById('filter-type');
  const petCards = document.querySelectorAll('.pet-card');

  function filterPets() {
    const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
    const selectedType = typeFilter ? typeFilter.value.toLowerCase() : '';

    petCards.forEach(card => {
      const name = card.getAttribute('data-name') || '';
      const type = card.getAttribute('data-type') || '';
      const description = card.getAttribute('data-description') || '';

      const matchesSearch = name.includes(searchTerm) || description.includes(searchTerm);
      const matchesType = selectedType === '' || type === selectedType;

      if (matchesSearch && matchesType) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  }

  if (searchInput) {
    searchInput.addEventListener('input', filterPets);
  }

  if (typeFilter) {
    typeFilter.addEventListener('change', filterPets);
  }
});
