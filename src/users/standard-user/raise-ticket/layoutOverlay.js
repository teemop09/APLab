var selectedLabName = null;

// open the overlay and load equipment names
function openOverlay() {
    // Get the selected lab ID
    const selectedLabId = document.getElementById('labSelection').value;
    selectedLabName = document.getElementById('labSelection').options[document.getElementById('labSelection').selectedIndex].text;

    if (selectedLabId) {
        const overlay = document.getElementById('overlay');
        overlay.querySelector('#lab-layout').setAttribute('data', '/src/components/layouts/' + selectedLabName + '.php')
        overlay.querySelector('#lab-layout-name').innerHTML = selectedLabName;
        overlay.style.display = 'block';
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

var activeMarker = null;
function handleSvgClick(event) {
    // Ensure the clicked element is an SVG element
    if (event.target.nodeName === "path" || event.target.nodeName === "circle") {
        // Check if the clicked element has specific attributes (e.g., data attributes)
        var computerNumber = event.target.parentNode.getAttribute("data-id");

        event.target.parentNode.classList.toggle("active");
        toggleScale(event.target.parentNode, 1.2);

        if (activeMarker !== null && activeMarker !== event.target.parentNode) {
            restore(activeMarker);
        }

        var pcId = null;
        // if is active then openSide, if not then closeSide
        if (event.target.parentNode.classList.contains("active")) {
            pcId = event.target.parentNode.getAttributeNS(null, "data-id");
            console.log(pcId);
        }
        activeMarker = event.target.parentNode;
    }
}

var externalSvg = null;
$(document).ready(function () {
    // Get the <object> element
    externalSvg = document.getElementById("lab-layout");
    console.log(externalSvg);
    // Wait for the external SVG to load
    externalSvg.addEventListener("load", function () {
        // Access the imported SVG document
        var svgDoc = externalSvg.contentDocument;
        var head = svgDoc.querySelector("head");
        const linkElement = document.createElement("link");
        linkElement.setAttribute("rel", "stylesheet");
        linkElement.setAttribute("type", "text/css");
        linkElement.setAttribute("href", "/src/users/standard-user/raise-ticket/layout.css");
        head.appendChild(linkElement);
        // Attach a click event listener to the SVG document
        svgDoc.addEventListener("click", handleSvgClick);
    });

    // handle form submission
    document.querySelector('#overlay-cancel').addEventListener('click', function (event) {
        closeOverlay();
        restore(activeMarker);
        activeMarker = null;
        document.querySelector('#markComputerButton').innerHTML = "Mark a Computer";
    });
    document.querySelector('#overlay-confirm').addEventListener('click', function (event) {
        var pcNum = pad(activeMarker.getAttributeNS(null, "data-id"), 2);
        var pcName = selectedLabName + "-" + pcNum;
        document.querySelector('#markComputerButton').innerHTML = pcName;
        computerId.value = pcName;
        closeOverlay();
    });
});



function restore(element) {
    element.classList.remove("active");
    element.setAttribute("transform", "scale(1)");
}
function toggleScale(element, scaleSize) {
    if (element.getAttribute("transform") == "scale(" + scaleSize + ")") {
        element.setAttribute("transform", "scale(1)");
    } else {
        element.setAttribute("transform", "scale(" + scaleSize + ")");
    }
}
function pad(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}