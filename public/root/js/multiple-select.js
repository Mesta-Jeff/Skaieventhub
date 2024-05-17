// document.addEventListener('DOMContentLoaded', function () {
//     const selectHeader = document.querySelector('.select-header');
//     const optionsContainer = document.querySelector('.options');
//     const options = document.querySelectorAll('.option');
//     const lastComersInput = document.querySelector('input[name="last_comers"]');
  
//     selectHeader.addEventListener('click', toggleOptions);
//     options.forEach(option => option.addEventListener('click', handleOptionClick));
  
//     // Close the options when clicking outside the custom select
//     document.addEventListener('click', function (e) {
//       const isClickInside = selectHeader.contains(e.target) || optionsContainer.contains(e.target);
//       if (!isClickInside) {
//         optionsContainer.classList.remove('active');
//       }
//     });
  
//     function toggleOptions() {
//       optionsContainer.classList.toggle('active');
//     }
  
//     function handleOptionClick(e) {
//       const selectedOption = e.target;
//       selectedOption.classList.toggle('selected');
//       updateSelectedItems();
//     }
  
//     function updateSelectedItems() {
//       const selectedItems = document.querySelector('.selected-items');
//       const selectedOptions = document.querySelectorAll('.option.selected');
//       const values = Array.from(selectedOptions).map(option => option.textContent);
//       selectedItems.textContent = values.length > 0 ? values.join(', ') : 'Select Items';

//       selectedItems.textContent = selectedItemsText;
//       lastComersInput.value = selectedItemsText;
//     }


//   });



document.addEventListener('DOMContentLoaded', function () {
  const selectHeader = document.querySelector('.select-header');
  const optionsContainer = document.querySelector('.options');
  const options = document.querySelectorAll('.option');
  const lastComersInput = document.querySelector('input[name="last_comers"]'); // Assuming your input has the name "last_comers"

  selectHeader.addEventListener('click', toggleOptions);
  options.forEach(option => option.addEventListener('click', handleOptionClick));

  // Close the options when clicking outside the custom select
  document.addEventListener('click', function (e) {
    const isClickInside = selectHeader.contains(e.target) || optionsContainer.contains(e.target);
    if (!isClickInside) {
      optionsContainer.classList.remove('active');
    }
  });

  function toggleOptions() {
    optionsContainer.classList.toggle('active');
  }

  function handleOptionClick(e) {
    const selectedOption = e.target;
    selectedOption.classList.toggle('selected');
    updateSelectedItems();
  }

  function updateSelectedItems() {
    const selectedItems = document.querySelector('.selected-items');
    const selectedOptions = document.querySelectorAll('.option.selected');
    const values = Array.from(selectedOptions).map(option => option.textContent);
    const selectedItemsText = values.length > 0 ? values.join(', ') : 'Select Items';

    selectedItems.textContent = selectedItemsText;

    // Assign the selected items to the "last_comers" input
    lastComersInput.value = selectedItemsText;
  }
});
