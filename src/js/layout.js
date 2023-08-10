$(document).ready(function () {
    var markers = document.getElementsByClassName("map-marker");
    for (var marker of markers) {
        console.log(marker);
        marker.addEventListener("click", function (e) {
            marker.classList.toggle("active");
            // if is active then openSide, if not then closeSide
            if (marker.classList.contains("active")) {
                var pcId = e.target.parentNode.getAttributeNS(null, "data-id");
                openSide(pcId);
                console.log(pcId);
            }
            else {
                closeSide();
            }
        });
    }
});


function openSide(pcId) {
    console.log("Openside");
    document.getElementById("pcIdDisplay").innerHTML = "PC" + pad(pcId, 2);
    document.getElementById("sidebar").style.width = "250px";
    // document.getElementById("content").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeSide() {
    document.getElementById("sidebar").style.width = "0";
    // document.getElementById("content").style.marginLeft = "0";
}

function pad(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}