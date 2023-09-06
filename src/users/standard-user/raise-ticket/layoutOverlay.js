// open the overlay and load equipment names
function openOverlay() {
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'block';

    // Get the selected lab ID
    const selectedLabId = document.getElementById('labSelection').value;

    if (selectedLabId) {
        // AJAX request to retrieve equipment names for the selected lab
        fetch(`fetchFilteredEquipment.php?lab_id=${selectedLabId}`)
            .then((response) => response.json())
            .then((data) => {
                console.log('Equipment Data:', data); // DEBUG: log the received data

                const equipmentList = document.getElementById('equipmentList');
                equipmentList.innerHTML = '';

                data.forEach((equipment) => {
                    console.log('Equipment Name:', equipment.equ_name); // DEBUG: Log the entire equipment item
                    const listItem = document.createElement('li');
                    listItem.textContent = equipment.equ_name;
                    listItem.classList.add('equipment-name'); // Add a class for event handling
                    equipmentList.appendChild(listItem);

                    // Handle click events for equipment names
                    listItem.addEventListener('click', () => {
                        // Send AJAX request to retrieve the equ_id based on the selected equ_name
                        fetch(`fetchEquipmentId.php?equ_name=${equipment.equ_name}`)
                            .then((response) => response.json())
                            .then((data) => {
                                // Check if data contains equ_id
                                if (data.equ_id) {
                                    // Set the selected equ_name and equ_id
                                    const selectedEquipmentName = equipment.equ_name;
                                    const selectedEquipmentId = data.equ_id;

                                    // Update the hidden input field with equ_id
                                    document.getElementById('computerId').value = selectedEquipmentId;

                                    // Overwrite the "Mark the Computer" button text
                                    document.getElementById('markComputerButton').textContent = selectedEquipmentName;

                                    closeOverlay();
                                } else {
                                    console.error('Error: Equipment ID not found.');
                                }
                            })
                            .catch((error) => {
                                console.error('Error fetching equipment ID:', error);
                            });
                    });
                });

                // handle form submission
                document.querySelector('form').addEventListener('submit', function (event) {
                    // Check if the equipment name is empty
                    const selectedEquipmentName = document.getElementById('computerId').value;
                    if (!selectedEquipmentName) {
                        event.preventDefault(); // Prevent form submission
                        alert('Please select an equipment name.');
                    }
                });
            })
            .catch((error) => {
                console.error('Error fetching equipment names:', error);
            });
    } else {
        alert('Please select a lab first.');
    }
}



// close the overlay
function closeOverlay() {
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'none';
}
