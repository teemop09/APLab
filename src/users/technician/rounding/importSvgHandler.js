var activeMarker = null;

// Function to handle click events on the imported SVG
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
            openSide(pcId);
            console.log(pcId);
        }
        else {
            closeSide();
        }
        activeMarker = event.target.parentNode;
        /* Get tickets associated with the computer */
        // Define the URL of the PHP script
        var labName = document.getElementById("lab-heading").innerHTML;
        const url = '/src/users/technician/rounding/get_ticket_by_pc_id.php?id=' + pad(pcId, 2) + '&lab=' + labName;

        // Function to create ticket links
        function createTicketLinks(tickets, container) {
            const ticketList = document.createElement("div");

            // Create and append anchor links for each ticket
            tickets.forEach(ticket => {
                const anchor = document.createElement("a");
                anchor.href = "/src/users/technician/ticket/ticket_details.php?ticket_id=" + ticket.id;
                anchor.textContent = ticket.subject;
                ticketList.appendChild(anchor);
            });

            container.innerHTML = ""; // Clear the container
            container.appendChild(ticketList); // Append the new ticket list
        }

        // Variables to store the original elements
        var originalPendingTicket = document.getElementById("pending-ticket");
        var originalPastTicket = document.getElementById("past-ticket");
        var originalPendingTicketList = document.getElementById("pending-ticket-list");
        var originalPastTicketList = document.getElementById("past-ticket-list");
        // Restore the original elements
        originalPastTicket.style.display = "none";
        originalPendingTicket.style.display = "none";
        document.getElementById("no-info").style.display = "none";
        originalPastTicketList.innerHTML = "";
        originalPendingTicketList.innerHTML = "";
        // Make a GET request
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json(); // assuming the response is JSON
            })
            .then(data => {
                console.log(data); // This will log the data returned by your PHP script

                // Check if there are entries in "past" and "open" sections
                if (data.past.length > 0) {
                    // Show the "Past Tickets" h2 element
                    originalPastTicket.style.display = "block";
                    // Create anchor links for "past" tickets
                    createTicketLinks(data.past, originalPastTicketList);
                }

                if (data.open.length > 0) {
                    // Show the "Pending Tickets" h2 element
                    originalPendingTicket.style.display = "block";
                    createTicketLinks(data.open, originalPendingTicketList);
                }

                if (data.past.length == 0 && data.open.length == 0) {
                    // Show the "No Tickets" h2 element
                    document.getElementById("no-info").style.display = "block";

                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });


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
        linkElement.setAttribute("href", "/src/users/technician/rounding/layout.css");
        head.appendChild(linkElement);
        // Attach a click event listener to the SVG document
        svgDoc.addEventListener("click", handleSvgClick);

        // Style the markers based on db
        var labName = document.getElementById("lab-heading").innerHTML;
        const url = '/src/users/technician/rounding/get_tickets.php?lab=' + labName;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json(); // assuming the response is JSON
            })
            .then(json => {
                var markers = svgDoc.getElementsByClassName("computer-marker");
                for (var i = 0; i < markers.length; i++) {
                    var dataId = markers[i].getAttributeNS(null, "data-id");
                    json.sort((a, b) => a["equipment name"].localeCompare(b["equipment name"]));
                    json.forEach(data => {
                        var pcId = data["equipment name"].split("-")[2];
                        var ticketStatus = data["ticket status"];
                        // console.log(dataId, pcId, ticketStatus);
                        // console.log(dataId == pcId);
                        if (pad(dataId, 2) == pcId) {
                            console.log(ticketStatus);


                            if (ticketStatus == "open" || ticketStatus == "Pending")
                                markers[i].classList.add("attention");
                            else if (ticketStatus == "Pending (Taken)")
                                markers[i].classList.add("taken");
                            else if (ticketStatus == "solved")
                                markers[i].classList.add("solved");

                        }
                    })
                    // priority to show the status
                    // attention > taken > solved > required follow up
                    if (markers[i].classList.contains("attention")) {
                        markers[i].classList.remove("taken");
                        markers[i].classList.remove("solved");
                    }
                    else if (markers[i].classList.contains("taken")) {
                        markers[i].classList.remove("solved");

                    }
                    else if (markers[i].classList.contains("solved")) {
                    }
                    // json.forEach(pc => {
                    //     var pcId = pc.pc_id;
                    //     var pcStatus = pc.status;
                    //     var pcElement = svgDoc.getElementById("pc" + pad(pcId, 2));
                    //     if (pcStatus == "1") {
                    //         pcElement.classList.add("active");
                    //         pcElement.setAttribute("transform", "scale(1.2)");
                    //     }
                    // });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
            }
            );


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

function openSide(pcId) {
    console.log("Openside");
    document.getElementById("pcIdDisplay").innerHTML = "PC" + pad(pcId, 2);
    document.getElementById("sidebar").style.width = "250px";
    // document.getElementById("content").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeSide() {
    document.getElementById("sidebar").style.width = "0";
    restore(activeMarker);


    // clear the sidebar 
    // document.getElementById("content").style.marginLeft = "0";
}

function pad(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}

function createTicketLinks(tickets, ticketLinksContainer) {
    // Create anchor links for "past" tickets
    const ticketLinks = tickets.map(ticket => {
        const anchor = document.createElement("a");
        anchor.href = `/ticket-detail.php?id=${ticket.id}`;
        anchor.textContent = ticket.subject;
        anchor.classList.add("ticket-link");
        return anchor;
    });

    ticketLinks.forEach(link => {
        ticketLinksContainer.appendChild(link);
    });
}